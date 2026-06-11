<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estoque;
use App\Models\Acessorio;
use App\Models\Obra;
use App\Http\Services\EstoqueService;
use App\Http\Requests\StoreEstoqueRequest;
use App\Http\Requests\RetiradaEstoqueRequest;
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
        $acessorios = Acessorio::where('user_id', auth()->id())
            ->orderBy('codigo')
            ->get();
        return view('estoque.create', compact('acessorios'));
    }

    // Processa a adição ao estoque, atualizando ou criando o registro e registrando no histórico
    public function store(StoreEstoqueRequest $request){
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
            'cor' => $corFinal, 
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect()->route('estoque.index')
        ->with('success', 'Estoque atualizado com sucesso!');
    }

    // Exibe o formulário para retirar do estoque, passando as obras para seleção
    public function retirar(Estoque $estoque){
        $obras = Obra::where('user_id', auth()->id())
            ->orderBy('nome')
            ->get();
        return view('estoque.retirar', compact('estoque', 'obras'));
    }

    // Processa a retirada do estoque, atualizando a quantidade e registrando no histórico
    public function processarRetirada(RetiradaEstoqueRequest $request, Estoque $estoque){
        DB::transaction(function () use ($request, $estoque) {

            $estoque->quantidade -= $request->quantidade;
            $estoque->save();

            DB::table('historico')->insert([
                'acessorio_id' => $estoque->acessorio_id,
                'obra_id' => $request->obra_id,
                'tipo' => 'saida',
                'quantidade' => $request->quantidade,
                'cor' => $estoque->cor,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        });

        return redirect()->route('estoque.index')
        ->with('success', 'Retirada realizada!');
    }
}