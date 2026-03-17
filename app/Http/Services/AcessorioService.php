<?php

namespace App\Http\Services;

use App\Http\Repositories\AcessorioRepository;
use App\Models\Acessorio;
use App\Models\Estoque;

class AcessorioService extends BaseService{

    public function __construct(AcessorioRepository $repository){
        parent::__construct($repository);
    }

    public function store(array $data){
        $existe = $this->repository->findByCodigo($data['codigo']);

        if ($existe) {
            return ['error' => 'Já existe um acessório com esse código.'];
        }

        return parent::store($data);
    }

    public function paginate($perPage = 10){
        return $this->repository->paginate($perPage);
    }

    public function update(array $data, $id){

        $acessorio = parent::update($data, $id);

        Estoque::where('acessorio_id', $id)
            ->update([
                'preco' => $data['preco']
            ]);

        return $acessorio;
    }

}
