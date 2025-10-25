<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Historico;
use App\Models\Acessorio;
use App\Models\Obra;

class HistoricoController extends Controller
{
    public function index(){
        $historico = Historico::with(['acessorio', 'obra'])->latest()->get();
        return view('historico.index', compact('historico'));
    }
}
