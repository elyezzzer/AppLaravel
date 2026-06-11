<?php

namespace App\Http\Controllers;

use App\Models\Acessorio;
use Illuminate\Http\Request;
use App\Http\Services\AcessorioService;
use App\Http\Requests\UpdateAcessorioRequest;
use App\Http\Requests\StoreAcessorioRequest;

class AcessorioController extends Controller
{
    protected AcessorioService $service;

    public function __construct(AcessorioService $service){
        $this->service = $service;

    }

    public function index(Request $request){
        $acessorios = $this->service->paginate(10,$request->search,$request->filtro);
        return view('acessorios.index', compact('acessorios'));

    }

    public function create(){
        return view('acessorios.create');
        
    }

    public function edit(Acessorio $acessorio){
        return view('acessorios.edit', compact('acessorio'));

    }

    // Processa a criação de um novo acessório,
    // verificando se o código já existe e retornando um erro se necessário
    public function store(StoreAcessorioRequest $request){
        $result = $this->service->store($request->validated());
        if (isset($result['error'])) {
            return back()
            ->withErrors(['codigo' => $result['error']])
            ->withInput();
        }
        return redirect()
            ->route('acessorios.index')
            ->with('success', 'Acessório cadastrado com sucesso!');
    }

    // Processa a atualização de um acessório,
    // verificando se o código já existe para outro acessório e retornando um erro se necessário
    public function update(UpdateAcessorioRequest $request, Acessorio $acessorio){
        $this->service->update($request->validated(), $acessorio->id);

        return redirect()
            ->route('acessorios.index')
            ->with('success', 'Acessório atualizado com sucesso!');
    }

    // Processa a exclusão de um acessório,
    // verificando se ele está presente em algum estoque ou obra e retornando um erro se necessário
    public function destroy(Acessorio $acessorio){
        $result = $this->service->destroy($acessorio->id);

        if (isset($result['error'])) {
            return back()->with('error', $result['error']);
        }

        return redirect()
            ->route('acessorios.index')
            ->with('success', 'Acessório excluído com sucesso!');
    }

}