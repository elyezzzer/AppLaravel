<?php

namespace App\Http\Services;
use App\Http\Repositories\ObraRepository;
use App\Models\Obra;

class ObraService extends BaseService{
    public function __construct(ObraRepository $repository){
        parent::__construct($repository);

    }

    public function paginate($perPage = 10){
        return $this->repository->paginate($perPage);
        
    }
}
