<?php

namespace App\Http\Services;
use App\Http\Repositories\AcessorioRepository;

class AcessorioService extends BaseService{
    public function __construct(AcessorioRepository $repository){
        parent::__construct($repository);
    }
}
