<?php

namespace App\Http\Repositories;

use App\Models\Acessorio;
use App\Models\Historico;

class RelatorioRepository extends BaseRepository{
    public function __construct(Historico $model){
        parent::__construct($model);
    }

    public function estoque(){
        return Acessorio::when($filtros['codigo'] ?? null, function ($q, $codigo){
            $q->where('codigo', $codigo);
        })
        ->orderBy('created_at', 'DESC')
        ->get();
    }

    // Relatório de movimentações
    public function movimentacoes(){
        return Historico::with('acessorio')
            ->when($filtros['data_inicio'] ?? null, function($q, $data){
                $q->whereDate('created_at', '>=', $data);
            })
            ->when($filtros['data_fim'] ?? null, function($q, $data){
                $q->whereDate('created_at', '<=', $data);
            })
            ->when($filtros['tipo'] ?? null, function($q, $tipo){
                if ($tipo !== 'todos'){
                    $q->where('tipo', $tipo);
                }
            })
            ->when($filtros['codigo'] ?? null, function ($q, $codigo){
                $q->whereHas('acessorio', function ($sub) use ($codigo){
                    $sub->where('codigo', $codigo);
                });
            })
            ->orderBy('created_at', 'DESC')
            ->get();
    }

}
