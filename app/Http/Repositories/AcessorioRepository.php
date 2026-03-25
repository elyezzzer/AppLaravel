<?php

namespace App\Http\Repositories;

use App\Models\Acessorio;

class AcessorioRepository extends BaseRepository{

    public function __construct(Acessorio $model){
        parent::__construct($model);
        
    }

    // Verifica se já existe um acessório com o mesmo código
    public function findByCodigo(string $codigo){
        return $this->model->where('codigo', $codigo)->first();
        
    }

    // Paginação com busca e filtro
    public function paginate($perPage = 10, $search = null, $filtro = null){
        $query = $this->model->orderBy('id', 'DESC');

        if ($search) {
            if ($filtro === 'tudo') {
                $query->where(function ($q) use ($search) {
                    $q->where('codigo', 'like', "%{$search}%")
                    ->orWhere('descricao', 'like', "%{$search}%")
                    ->orWhere('cor', 'like', "%{$search}%")
                    ->orWhere('preco', 'like', "%{$search}%");
                });
            } elseif ($filtro === 'codigo') {
                $query->where('codigo', 'like', "%{$search}%");

            } elseif ($filtro === 'descricao') {
                $query->where('descricao', 'like', "%{$search}%");

            } elseif ($filtro === 'cor') {
                $query->where('cor', 'like', "%{$search}%");

            } elseif ($filtro === 'preco') {
                $query->where('preco', 'like', "%{$search}%");
            }
        }
        return $query->paginate($perPage);
    }
    
}