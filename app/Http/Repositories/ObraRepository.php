<?php

namespace App\Http\Repositories;

use App\Models\Obra;

class ObraRepository extends BaseRepository{
    public function __construct(Obra $model){
        parent::__construct($model);
        
    }

    public function paginate($perPage = 10){
        return Obra::where('user_id', auth()->id())
            ->paginate($perPage);
    }
}