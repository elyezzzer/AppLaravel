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

    // Armazena um novo acessório, verificando se o código já existe
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

    // Atualiza um acessório e o preço correspondente no estoque
    public function update(UpdateAcessorioRequest $request, Acessorio $acessorio){
        $this->service->update($request->validated(), $acessorio->id);

        return redirect()
            ->route('acessorios.index')
            ->with('success', 'Acessório atualizado com sucesso!');
    }

    // Exclui um acessório, verificando se há estoque antes de permitir a exclusão
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