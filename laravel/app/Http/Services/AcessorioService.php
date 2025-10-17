<?php

namespace App\Http\Repositories;
use App\Http\Repositories\BaseRepository;

class AcessorioRepository extends BaseRepository{
    public function __construct(Acessorio $model){
        parent::__construct($model);
        
    }
}