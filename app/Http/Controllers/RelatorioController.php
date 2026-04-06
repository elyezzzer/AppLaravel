<?php

namespace App\Http\Controllers;

use App\Http\Services\RelatorioService;
use App\Models\Relatorio;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class RelatorioController extends Controller{
    protected $relatorioService;

    public function __construct(RelatorioService $relatorioService){
        $this->relatorioService = $relatorioService;

    }

    public function index(){
        $relatorios = Relatorio::orderBy('created_at', 'DESC')->get();

        $ultimoRelatorio = $relatorios->first();
        $relatoriosAnteriores = $relatorios->skip(1);

        return view('relatorios.index',compact('ultimoRelatorio', 'relatoriosAnteriores'));

    }

    public function create(){
        return view('relatorios.create');

    }

    public function gerar(Request $request){
        $filtros = [
            'data_inicio' => $request->data_inicio,
            'data_fim' => $request->data_fim,   
            'tipo' => $request->tipo ?? 'todos',
            'codigo' =>$request->codigo,
        ];

        if ($request->tipo === 'estoque'){
            $dados = $this->relatorioService->getEstoque($filtros);
            $totalQuantidade = $dados->sum('quantidade');

            $totais = [
                'quantidade' => $totalQuantidade
            ];

            $nome = 'Relatório de estoque';
            $view = 'relatorios.pdf.estoque';
        } else {
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

        $pdf = Pdf::loadView($view, compact('dados', 'totais'));

        $nomeArquivo = 'relatorio_' . time() . '.pdf';
        $arquivo = 'relatorios/' . $nomeArquivo;

        Storage::put($arquivo, $pdf->output());

        Relatorio::create([
            'nome' => $nome,
            'tipo' => $filtros['tipo'],
            'arquivo' => $arquivo,
            'data_inicio' => $request->tipo === 'estoque' ? null : $request->data_inicio,
            'data_fim' => $request->tipo === 'estoque' ? null : $request->data_fim,

        ]);

        return response()->download(storage_path('app/' . $arquivo));
    }

    public function download($id){
        $relatorio = Relatorio::findOrFail($id);

        return response()->download(storage_path('app/' . $relatorio->arquivo));
    }

    
}
