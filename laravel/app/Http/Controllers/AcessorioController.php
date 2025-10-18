<?php

namespace App\Http\Controllers;

use App\Models\Acessorio;
use Illuminate\Http\Request;
use App\Http\Services\AcessorioService;

class AcessorioController extends Controller
{
    protected AcessorioService $service;

    public function __construct(AcessorioService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $acessorios = $this->service->index();
        return view('acessorios.index', compact('acessorios'));
    }

    public function store(Request $request)
    {
        $this->service->store($request->all());
        return redirect()->route('acessorios.index');
    }

    public function update(Request $request, Acessorio $acessorio)
    {
        $this->service->update($acessorio, $request->all());
        return redirect()->route('acessorios.index');
    }

    public function destroy(Acessorio $acessorio)
    {
        $this->service->destroy($acessorio);
        return redirect()->route('acessorios.index');
    }
}
