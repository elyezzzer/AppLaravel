<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Historico;

class HistoricoController extends Controller{
    public function index(Request $request){
        $search = $request->input('search');
        $filtro = $request->input('filtro', 'tudo');

        $query = Historico::with(['acessorio', 'obra'])->latest();

        if ($search) {
            if ($filtro === 'tudo') {
                $query->where(function ($q) use ($search) {
                    $q->whereHas('acessorio', function ($qa) use ($search) {
                            $qa->where('codigo', 'like', "%{$search}%")
                               ->orWhere('descricao', 'like', "%{$search}%");
                        })
                        ->orWhereHas('obra', function ($qo) use ($search) {
                            $qo->where('nome', 'like', "%{$search}%");
                        })
                        ->orWhere('tipo', 'like', "%{$search}%")
                        ->orWhere('cor', 'like', "%{$search}%");
                });

            } elseif ($filtro === 'acessorio') {
                $query->whereHas('acessorio', function ($q) use ($search) {
                    $q->where('codigo', 'like', "%{$search}%")
                      ->orWhere('descricao', 'like', "%{$search}%");
                });

            } elseif ($filtro === 'obra') {
                $query->whereHas('obra', function ($q) use ($search) {
                    $q->where('nome', 'like', "%{$search}%");
                });

            } elseif ($filtro === 'tipo') {
                $query->where('tipo', 'like', "%{$search}%");

            } elseif ($filtro === 'cor') {
                $query->where('cor', 'like', "%{$search}%");
            }
        }

        $historico = $query->paginate(15)->withQueryString();

        return view('historico.index', compact('historico'));
    }
}
