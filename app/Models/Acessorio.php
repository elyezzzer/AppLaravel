<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Acessorio extends Model{
    use SoftDeletes;

    protected $table = 'acessorios';

    protected $fillable = [
        'user_id',
        'codigo',
        'descricao',
        'cor',
        'preco',
        'estoque_minimo'
    ];

    public function historicos(){
        return $this->hasMany(Historico::class);
    }

    public function estoque(){
        return $this->hasMany(Estoque::class);
    }
}