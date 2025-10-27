<?php

namespace App\Http\Controllers;

use App\Models\Estoque;
use App\Models\Obra;
use App\Http\Requests\StoreEstoqueRequest;
use App\Http\Requests\RetiradaEstoqueRequest;
use App\Http\Services\EstoqueService;

class EstoqueController extends Controller
{
    protected EstoqueService $service;

    public function __construct(EstoqueService $service){
        $this->service = $service;
    }

    public function index(){
        $estoques = $this->service->getAvailable(10); 
        return view('estoque.index', compact('estoques'));
    }

    public function create(){
        $acessorios = $this->service->getAcessorios();
        return view('estoque.create', compact('acessorios'));
    }

 
    public function store(StoreEstoqueRequest $request){
        $this->service->adicionar($request->validated());
        return redirect()->route('estoque.index')->with('success', 'Acessório adicionado ao estoque.');
    }

    public function retirar(Estoque $estoque){
        $obras = Obra::all();
        return view('estoque.retirar', compact('estoque', 'obras'));
    }


    public function processarRetirada(RetiradaEstoqueRequest $request, Estoque $estoque){
        $this->service->retirar($estoque, $request->quantidade, $request->obra_id);
        return redirect()->route('estoque.index')->with('success', 'Retirada realizada com sucesso.');
    }
}
