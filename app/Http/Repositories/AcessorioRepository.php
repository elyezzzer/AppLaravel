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

    public function paginate($perPage = 10, $filtro = null, $search = null){
    $query = $this->model->orderBy('id', 'DESC');

        if ($filtro && $search){

            if ($filtro == 'descricao') {
                $query->where('descricao', 'like', "%{$search}%");
            }
            if ($filtro == 'codigo') {
                $query->where('codigo', 'like', "%{$search}%");
            }
            if ($filtro == 'preco') {
                $query->where('preco', $search);
            }
            if ($filtro == 'cor') {
                $query->where('cor', 'like', "%{$search}%");
            }
        }

        return $query->paginate($perPage);
    }
    
}