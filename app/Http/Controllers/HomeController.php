<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Historico;
use App\Models\Estoque;
use App\Models\Acessorio;
use App\Models\Obra;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $totalEstoque = Estoque::sum('quantidade');

        $valorTotal = Estoque::select(
            DB::raw('SUM(quantidade * preco) as total')
        )->value('total');

        $retiradasHoje = Historico::where('tipo','saida')
            ->whereDate('created_at', now())
            ->sum('quantidade');

        $totalAcessorios = Acessorio::count();
        $totalObras = Obra::count();

        $dataInicial = $request->data_inicial ?? now()->format('Y-m-d');
        $dataFinal   = $request->data_final ?? now()->format('Y-m-d');
        $tipo        = $request->tipo ?? 'ambos';

        $query = Historico::query();

        $query->whereDate('created_at','>=',$dataInicial);
        $query->whereDate('created_at','<=',$dataFinal);

        if($tipo == 'entrada'){
            $query->where('tipo','entrada');
        }

        if($tipo == 'saida'){
            $query->where('tipo','saida');
        }

        $grafico = $query
            ->selectRaw("
                DATE(created_at) as data,
                SUM(CASE WHEN tipo='entrada' THEN quantidade ELSE 0 END) as entradas,
                SUM(CASE WHEN tipo='saida' THEN quantidade ELSE 0 END) as saidas
            ")
            ->groupBy('data')
            ->orderBy('data')
            ->get();

        return view('home', compact(
            'totalEstoque',
            'valorTotal',
            'retiradasHoje',
            'totalAcessorios',
            'totalObras',
            'grafico',
            'dataInicial',
            'dataFinal',
            'tipo'
        ));
    }
}