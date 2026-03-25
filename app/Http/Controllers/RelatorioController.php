<?php

namespace App\Http\Controllers;

use App\Http\Services\RelatorioService;

class RelatorioController extends Controller{
    protected $relatorioService;

    public function __construct(RelatorioService $relatorioService){
        $this->relatorioService = $relatorioService;
    }

    public function index(){
        return view('relatorios.index');
    }

    public function estoque(){
        $acessorios = $this->relatorioService->getEstoque();

        return view('relatorios.estoque', compact('acessorios'));
    }

    public function movimentacoes(){
        $historico = $this->relatorioService->getMovimentacoes();

        return view('relatorios.movimentacoes', compact('historico'));
    }
}
