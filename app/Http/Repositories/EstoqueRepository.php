<?php

namespace App\Http\Repositories;

use App\Models\Estoque;

class EstoqueRepository extends BaseRepository
{
    public function __construct(Estoque $model){
        parent::__construct($model);

    }

    public function paginate($perPage = 10, $search = null, $filtro = null){
        $query = $this->model
            ->with('acessorio')
            ->where('quantidade', '>', 0)
            ->orderBy('id', 'DESC');

        if ($search){
            if ($filtro === 'tudo') {
                $query->where(function ($q) use ($search) {
                    $q->where('cor', 'like', "%{$search}%")
                    ->orWhere('preco', 'like', "%{$search}%")
                    ->orWhereHas('acessorio', function ($qa) use ($search) {
                        $qa->where('codigo', 'like', "%{$search}%")
                            ->orWhere('descricao', 'like', "%{$search}%");
                    });
                });
            }elseif ($filtro === 'codigo'){
                $query->whereHas('acessorio', function ($q) use ($search) {
                    $q->where('codigo', 'like', "%{$search}%");
                });

            }elseif ($filtro === 'descricao'){
                $query->whereHas('acessorio', function ($q) use ($search) {
                    $q->where('descricao', 'like', "%{$search}%");
                });

            }elseif ($filtro === 'cor'){
                $query->where('cor', 'like', "%{$search}%");

            }elseif ($filtro === 'preco'){
                $query->where('preco', 'like', "%{$search}%");

            }
        }

        return $query->paginate($perPage)->withQueryString();
    }

}
