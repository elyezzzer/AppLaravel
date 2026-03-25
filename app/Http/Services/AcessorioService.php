<?php

namespace App\Http\Services;

use App\Http\Repositories\AcessorioRepository;
use App\Http\Repositories\EstoqueRepository;
use App\Models\Acessorio;
use App\Models\Estoque;

class AcessorioService extends BaseService{

    protected $estoqueRepository;

    public function __construct(AcessorioRepository $repository, EstoqueRepository $estoqueRepository){
        parent::__construct($repository);

        $this->estoqueRepository = $estoqueRepository;
    }

    // Sobrescreve o método de armazenamento para verificar se já existe um acessório com o mesmo código
    public function store(array $data){
        $existe = $this->repository->findByCodigo($data['codigo']);

        if ($existe) {
            return ['error' => 'Já existe um acessório com esse código.'];
        }

        return parent::store($data);
    }

    public function update(array $data, $id){
        $acessorio = parent::update($data, $id);

        $this->estoqueRepository->updatePrecoPorAcessorio(
            $id,
            $data['preco']
        );

        return $acessorio;
    }

    public function paginate($perPage = 10, $search = null, $filtro = null){
        return $this->repository->paginate($perPage, $search, $filtro);
    }

}
