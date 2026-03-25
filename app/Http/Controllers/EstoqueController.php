<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estoque;
use App\Models\Acessorio;
use App\Models\Obra;
use App\Http\Services\EstoqueService;
use Illuminate\Support\Facades\DB;

class EstoqueController extends Controller{

    protected EstoqueService $service;

    public function __construct(EstoqueService $service){
        $this->service = $service;

    }

    public function index(Request $request){
        $estoques = $this->service->paginate(10, $request->search, $request->filtro);
        return view('estoque.index', compact('estoques'));
    }

    public function create(){
        $acessorios = Acessorio::orderBy('codigo')->get();
        return view('estoque.create', compact('acessorios'));
    }

    // Armazena um novo estoque, verificando se já existe um registro para o acessório e cor
    public function store(Request $request){
        $request->validate([
            'acessorio_id' => 'required',
            'quantidade' => 'required|integer|min:1',
        ]);

        $acessorio = Acessorio::findOrFail($request->acessorio_id);

        $corFinal = $acessorio->cor == 'todas'
            ? $request->cor
            : $acessorio->cor;

        $estoque = Estoque::where('acessorio_id', $acessorio->id)
            ->where('cor', $corFinal)
            ->first();

        if ($estoque) {
            $estoque->quantidade += $request->quantidade;
            $estoque->save();
        } else {
            Estoque::create([
                'acessorio_id' => $acessorio->id,
                'cor' => $corFinal,
                'quantidade' => $request->quantidade,
                'preco' => $acessorio->preco
            ]);
        }

        DB::table('historico')->insert([
            'acessorio_id' => $acessorio->id,
            'obra_id' => null,
            'tipo' => 'entrada',
            'quantidade' => $request->quantidade,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect()->route('estoque.index')
        ->with('success', 'Estoque atualizado com sucesso');
    }

    public function retirar(Estoque $estoque){
        $obras = Obra::orderBy('nome')->get();
        return view('estoque.retirar', compact('estoque', 'obras'));
    }

    // Processa a retirada do estoque, verificando se a quantidade solicitada é menor ou igual à disponível
    public function processarRetirada(Request $request, Estoque $estoque){
        $request->validate([
            'quantidade' => 'required|integer|min:1',
            'obra_id' => 'required'
        ]);

        if ($request->quantidade > $estoque->quantidade) {
            return back()->with('error', 'Quantidade maior que o estoque');
        }

        DB::transaction(function () use ($request, $estoque) {

            $estoque->quantidade -= $request->quantidade;
            $estoque->save();

            DB::table('historico')->insert([
                'acessorio_id' => $estoque->acessorio_id,
                'obra_id' => $request->obra_id,
                'tipo' => 'saida',
                'quantidade' => $request->quantidade,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        });

        return redirect()->route('estoque.index')
        ->with('success', 'Retirada realizada');
    }
}