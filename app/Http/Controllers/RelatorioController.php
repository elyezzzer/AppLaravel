<?php

namespace App\Http\Controllers;

use App\Http\Services\RelatorioService;
use App\Models\Relatorio;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\GerarRelatorioRequest;
use App\Models\Obra;

class RelatorioController extends Controller{
    protected $relatorioService;

    public function __construct(RelatorioService $relatorioService){
        $this->relatorioService = $relatorioService;

    }

    public function index(){
        $relatorios = Relatorio::where('user_id', auth()->id())
            ->orderBy('created_at', 'DESC')
            ->paginate(10);

        $totalRelatorios = Relatorio::where('user_id', auth()->id())
            ->withTrashed()
            ->count();

        $relatorioMaisRecente = Relatorio::where('user_id', auth()->id())
            ->withTrashed()
            ->orderBy('created_at', 'DESC')
            ->first();

        return view('relatorios.index', compact('relatorios', 'totalRelatorios', 'relatorioMaisRecente'));
    }

    public function create(){
        $obras = Obra::orderBy('nome')->get();
        return view('relatorios.create', compact('obras'));
    }


    public function destroy($id){
        $relatorio = Relatorio::findOrFail($id);

        if ($relatorio->arquivo && \Storage::exists($relatorio->arquivo)) {
            \Storage::delete($relatorio->arquivo);
        }

        $relatorio->delete();

        return redirect()->route('relatorios.index')->with('success', 'Relatório deletado com sucesso!');
    }

    public function gerar(GerarRelatorioRequest $request){
        $filtros = $request->validated();
        $mostrarPeriodo = true;

        if ($filtros['tipo'] === 'estoque') {

            $mostrarPeriodo = false;

            $dados = $this->relatorioService->getEstoque($filtros);
            $totalQuantidade = $dados->sum('quantidade');

            $totais = [
                'quantidade' => $totalQuantidade
            ];

            $nome = 'Relatório de estoque';
            $view = 'relatorios.pdf.estoque';
        
        } elseif ($filtros['tipo'] === 'obra') {

            $mostrarPeriodo = true;

            if (empty($filtros['obra_id'])) {
                return back()->with('erro', 'Selecione uma obra.');
            }

            $obra = Obra::findOrFail($filtros['obra_id']);

            $dados = $this->relatorioService->getItensObra($filtros);

            $totais = [
                'quantidade' => $dados->sum('quantidade')
            ];

            $nome = 'Relatório da obra';
            $view = 'relatorios.pdf.obra';
    
        } else {

            $mostrarPeriodo = true;

            $dados = $this->relatorioService->getMovimentacoes($filtros);

            $totalEntradas = $dados->where('tipo', 'entrada')->sum('quantidade');
            $totalSaidas = $dados->where('tipo', 'saida')->sum('quantidade');
            $saldo = $totalEntradas - $totalSaidas;

            $totais = [
                'total_entradas' => $totalEntradas,
                'total_saidas' => $totalSaidas,
                'saldo' => $saldo
            ];

            $nome = 'Relatório de movimentações';
            $view = 'relatorios.pdf.movimentacoes';
        }

        $pdf = Pdf::loadView($view, [ 
            'dados' => $dados,
            'totais' => $totais,
            'obra' => $obra ?? null,
            'filtros' => $filtros,
            'gerado_em' => now(),
            'titulo' => $nome,
            'mostrarPeriodo' => $mostrarPeriodo,
            'empresa' => [
                'nome' => 'InventoryPlus',
                'endereco' => 'Rua Exemplo, 123 - Centro',
                'telefone' => '(00) 0000-0000',
                'email' => 'contato@empresa.com',
            ]
        ])->setOptions([
            'isPhpEnabled' => true,
        ]);

        $nomeArquivo = 'relatorio_' . time() . '.pdf';
        $arquivo = 'relatorios/' . $nomeArquivo;

        $caminhoPasta = storage_path('app/relatorios');

        if (!file_exists($caminhoPasta)) {
            mkdir($caminhoPasta, 0755, true);
        }

        $caminhoCompleto = storage_path('app/' . $arquivo);
        file_put_contents($caminhoCompleto, $pdf->output());

        if (!file_exists($caminhoCompleto)) {
            return back()->with('erro', 'Erro ao gerar o relatório.');
        }

        Relatorio::create([
            'nome' => $nome,
            'tipo' => $filtros['tipo'],
            'arquivo' => $arquivo,
            'data_inicio' => $filtros['tipo'] === 'estoque' ? null : ($filtros['data_inicio'] ?? null),
            'data_fim' => $filtros['tipo'] === 'estoque' ? null : ($filtros['data_fim'] ?? null),
        ]);

       return redirect()->route('relatorios.index')->with('success', 'Relatório gerado com sucesso!');

    }

    public function download($id){
        $relatorio = Relatorio::findOrFail($id);

        $caminho = storage_path('app/' . $relatorio->arquivo);

        if (!file_exists($caminho)) {
            return back()->with('erro', 'Arquivo não encontrado.');
        }

        return response()->download(storage_path('app/' . $relatorio->arquivo));
    }

    public function view($id){
        $relatorio = Relatorio::findOrFail($id);

        $caminho = storage_path('app/' . $relatorio->arquivo);

        return response()->file($caminho, [
            'Content-Disposition' => 'inline; filename="relatorio.pdf"'
        ]);
    }



    
}
