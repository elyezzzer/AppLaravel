<?php

namespace App\Http\Controllers;

use App\Models\Acessorio;
use Illuminate\Http\Request;
use App\Http\Services\AcessorioService;
use App\Http\Requests\UpdateAcessorioRequest;
use App\Http\Requests\StoreAcessorioRequest;
use App\Models\Obra;

class AcessorioController extends Controller
{
    protected AcessorioService $service;

    public function __construct(AcessorioService $service){
        $this->service = $service;

    }

    public function index(){
        $acessorios = $this->service->index();
        return view('acessorios.index', compact('acessorios'));

    }

    public function create(){
        return view('acessorios.create');
        
    }

    public function edit(Acessorio $acessorio){
        return view('acessorios.edit', compact('acessorio'));

    }

    public function store(Request $request){
        $this->service->store($request->all());
        return redirect()->route('acessorios.index');

    }

    public function update(UpdateAcessorioRequest $request, Acessorio $acessorio){
       $this->service->update($request->validated(), $acessorio->id);
        return redirect()->route('acessorios.index');

    }
 

    public function destroy(Acessorio $acessorio){
        $this->service->destroy($acessorio->id);
        return redirect()->route('acessorios.index');

    }

    public function retirar(Acessorio $acessorio){
        $obras = Obra::all();   
        return view('acessorios.retirar', compact('acessorio', 'obras'));
    }

    public function processarRetirada(Request $request, Acessorio $acessorio){
        $request->validate([
            'quantidade' => ['required', 'integer', 'min:1', 'max:' . $acessorio->quantidade],
            'obra_id' => ['required', 'exists:obras,id'],
        ]);

        $quantidadeRetirada = $request->quantidade;
        $obra_id = $request->obra_id;

        $this->service->retirar($acessorio, $quantidadeRetirada, $obra_id);

        return redirect()->route('acessorios.index')->with('success', 'Retirada realizada com sucesso!');
    }

}
