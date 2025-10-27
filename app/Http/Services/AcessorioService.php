<?php

namespace App\Http\Services;
use App\Http\Repositories\AcessorioRepository;
use App\Models\Acessorio;

class AcessorioService extends BaseService{
    public function __construct(AcessorioRepository $repository){
        parent::__construct($repository);
    }

   
}


