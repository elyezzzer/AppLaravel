<?php

namespace App\Http\Repositories;

use App\Models\Acessorio;
use App\Models\Historico;

class RelatorioRepository extends BaseRepository{
    public function __construct(Historico $model){
        parent::__construct($model);
    }

    public function estoque(){
        return Acessorio::orderBy('descricao')->get();
    }

    public function movimentacoes(){
        return Historico::with('acessorio')
            ->orderBy('created_at', 'DESC')
            ->get();
    }

}
