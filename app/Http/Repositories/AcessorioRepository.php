<?php

namespace App\Http\Repositories;

use App\Models\Acessorio;

class AcessorioRepository extends BaseRepository{
    public function __construct(Acessorio $model){
        parent::__construct($model);
        
    }

    public function retirar(Acessorio $acessorio, int $quantidade, int $obra_id){ 
        $acessorio->quantidade -= $quantidade;
        $acessorio->save(); 
        
        return $acessorio;
    }
}