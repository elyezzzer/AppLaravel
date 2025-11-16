<?php

namespace App\Http\Repositories;

use App\Models\Estoque;

class EstoqueRepository extends BaseRepository
{
    public function __construct(Estoque $model)
    {
        parent::__construct($model);
    }

    public function findByAcessorioAndCor(int $acessorio_id, string $cor)
    {
        return $this->model
                    ->where('acessorio_id', $acessorio_id)
                    ->where('cor', $cor)
                    ->first();
    }

    public function allAvailable(int $perPage = 10){
        return $this->model->where('quantidade', '>', 0)->paginate($perPage);

    }

    public function paginate($perPage = 10){
        return $this->model->orderBy('id', 'DESC')->paginate($perPage);
        
    }

}
