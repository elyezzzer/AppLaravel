<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Historico;
use App\Models\Estoque;
use App\Models\Acessorio;
use App\Models\Obra;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller{

    public function index(Request $request){

        $dataInicio = $request->data_inicio ?? now()->subDays(6)->format('Y-m-d');
        $dataFim = $request->data_fim ?? now()->format('Y-m-d');

        // CARDS
        $totalEstoque = Estoque::whereHas('acessorio', fn($q) => $q->where('user_id', auth()->id()))->sum('quantidade');

        $valorTotal = Estoque::whereHas('acessorio', fn($q) => $q->where('user_id', auth()->id()))
            ->select(DB::raw('SUM(quantidade * preco) as total'))
            ->value('total');

        $retiradasHoje = Historico::whereHas('acessorio', fn($q) => $q->where('user_id', auth()->id()))
            ->where('tipo', 'saida')
            ->whereDate('created_at', now())
            ->sum('quantidade');

        $entradasHoje = Historico::whereHas('acessorio', fn($q) => $q->where('user_id', auth()->id()))
            ->where('tipo', 'entrada')
            ->whereDate('created_at', now())
            ->sum('quantidade');

        $totalAcessorios = Acessorio::count();
        $totalObras = Obra::where('user_id', auth()->id())->count();

        // ESTOQUE BAIXO
        $estoqueBaixo = Estoque::with('acessorio')
            ->whereHas('acessorio', fn($q) => $q->where('user_id', auth()->id()))
            ->where('quantidade', '>', 0)
            ->whereHas('acessorio', function ($q) {
                $q->whereColumn('estoque.quantidade', '<=', 'acessorios.estoque_minimo')
                  ->where('user_id', auth()->id());
            })
            ->get();

        // ÚLTIMAS MOVIMENTAÇÕES
        $ultimasMovimentacoes = Historico::with('acessorio')
            ->whereHas('acessorio', fn($q) => $q->where('user_id', auth()->id()))
            ->whereBetween('created_at', [$dataInicio, $dataFim])
            ->latest()
            ->limit(10)
            ->get();

        // GRÁFICO
        $graficoLabels = [];
        $graficoEntradas = [];
        $graficoSaidas = [];

        for ($i = 4; $i >= 0; $i--) {
            $data = now()->subDays($i);
            $graficoLabels[] = $data->format('d/m');

            $graficoEntradas[] = Historico::whereHas('acessorio', fn($q) => $q->where('user_id', auth()->id()))
                ->whereDate('created_at', $data)
                ->where('tipo', 'entrada')
                ->sum('quantidade');

            $graficoSaidas[] = Historico::whereHas('acessorio', fn($q) => $q->where('user_id', auth()->id()))
                ->whereDate('created_at', $data)
                ->where('tipo', 'saida')
                ->sum('quantidade');
        }

        // RANKING
        $ranking = Historico::select('acessorio_id', DB::raw('SUM(quantidade) as total'))
            ->whereHas('acessorio', fn($q) => $q->where('user_id', auth()->id()))
            ->where('tipo', 'saida')
            ->whereBetween('created_at', [$dataInicio, $dataFim])
            ->groupBy('acessorio_id')
            ->with('acessorio')
            ->orderByDesc('total')
            ->limit(5)
            ->get();

        return view('home', compact(
            'totalEstoque',
            'valorTotal',
            'retiradasHoje',
            'entradasHoje',
            'totalAcessorios',
            'totalObras',
            'estoqueBaixo',
            'ultimasMovimentacoes',
            'graficoLabels',
            'graficoEntradas',
            'graficoSaidas',
            'ranking',
            'dataInicio',
            'dataFim'
        ));
    }
}