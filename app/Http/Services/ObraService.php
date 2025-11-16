<?php

namespace App\Http\Services;
use App\Http\Repositories\ObraRepository;
use App\Models\Obra;

class ObraService extends BaseService{
    public function __construct(ObraRepository $repository){
        parent::__construct($repository);

    }

    public function store(array $data){
    if (Obra::where('nome', $data['nome'])->exists()) {
        return ['error' => 'Já existe uma obra cadastrada com esse nome.'];
    }

        return parent::store($data);
    }

    public function paginate($perPage = 10){
        return $this->repository->paginate($perPage);
        
    }
}
