<?php

namespace App\Http\Repositories;

use App\Models\Acessorio;
use App\Models\Historico;

class RelatorioRepository extends BaseRepository{
    public function __construct(Historico $model){
        parent::__construct($model);
    }

    public function estoque($filtros = []){
        return Acessorio::with('estoque')
            ->where('user_id', auth()->id())
            ->when($filtros['codigo'] ?? null, function ($q, $codigo){
            $q->where('codigo', $codigo);
        })
        ->orderBy('created_at', 'DESC')
        ->get();
    }

    public function movimentacoes($filtros = []){
        return Historico::with('acessorio')
            ->whereHas('acessorio', fn($q) => $q->where('user_id', auth()->id()))
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

    public function itensObra($filtros = []){
        return Historico::with(['acessorio', 'obra'])
            ->whereHas('acessorio', fn($q) => $q->where('user_id', auth()->id()))
            ->where('tipo', 'saida')

            ->when($filtros['obra_id'] ?? null, function ($q, $obraId){
                $q->where('obra_id', $obraId);
            })

            ->when($filtros['data_inicio'] ?? null, function($q, $data){
                $q->whereDate('created_at', '>=', $data);
            })

            ->when($filtros['data_fim'] ?? null, function($q, $data){
                $q->whereDate('created_at', '<=', $data);
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
