<?php

namespace App\Http\Repositories;

use App\Models\Acessorio;

class AcessorioRepository extends BaseRepository{
    public function __construct(Acessorio $model){
        parent::__construct($model);
        
    }

    public function findByCodigo(string $codigo){
        return $this->model->where('codigo', $codigo)->first();
        
    }

    public function paginate($perPage = 10){
        return $this->model->orderBy('id', 'DESC')->paginate($perPage);
        
    }
    
}