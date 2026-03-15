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
    public function index()
    {
        $totalEstoque = Estoque::sum('quantidade');
        $valorTotal = Estoque::select(DB::raw('SUM(quantidade * preco) as total'))->value('total');
        $retiradasHoje = Historico::where('tipo','saida')->whereDate('created_at', now())->sum('quantidade');
        $totalAcessorios = Acessorio::count();
        $totalObras = Obra::count();

        $grafico = Historico::select(
            DB::raw('DATE(created_at) as data'),
            DB::raw("SUM(CASE WHEN tipo='entrada' THEN quantidade ELSE 0 END) as entradas"),
            DB::raw("SUM(CASE WHEN tipo='saida' THEN quantidade ELSE 0 END) as saidas")
        )
        ->whereDate('created_at','>=', now()->subDays(7))
        ->groupBy('data')
        ->orderBy('data')
        ->get();

        return view('home', compact(
            'totalEstoque','valorTotal','retiradasHoje','totalAcessorios','totalObras','grafico'
        ));
    }

    public function grafico(Request $request)
    {
        $tipo = $request->tipo ?? 'ambos';
        $query = Historico::select(DB::raw('DATE(created_at) as data'));

        if ($tipo == 'entrada') {
            $query->selectRaw("SUM(quantidade) as entradas");
        } elseif ($tipo == 'saida') {
            $query->selectRaw("SUM(quantidade) as saidas");
        } else {
            $query->selectRaw("SUM(CASE WHEN tipo='entrada' THEN quantidade ELSE 0 END) as entradas")
                  ->selectRaw("SUM(CASE WHEN tipo='saida' THEN quantidade ELSE 0 END) as saidas");
        }

        if ($request->data_inicial) $query->whereDate('created_at','>=',$request->data_inicial);
        if ($request->data_final) $query->whereDate('created_at','<=',$request->data_final);
        if ($tipo != 'ambos') $query->where('tipo',$tipo);

        $grafico = $query->groupBy('data')->orderBy('data')->get();

        return response()->json([
            'tipo' => $tipo,
            'dados' => $grafico
        ]);
    }
}