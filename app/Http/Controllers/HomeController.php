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
    public function index(){
        $totalEstoque = Estoque::sum('quantidade');
        $valorTotal = Estoque::select(
            DB::raw('SUM(quantidade * preco) as total'))->value('total');
        $retiradasHoje = Historico::where('tipo','saida')->whereDate('created_at', now())->sum('quantidade');
        $totalAcessorios = Acessorio::count();
        $totalObras = Obra::count();

        return view('home', compact(
            'totalEstoque',
            'valorTotal',
            'retiradasHoje',
            'totalAcessorios',
            'totalObras'
        ));
    }
}
