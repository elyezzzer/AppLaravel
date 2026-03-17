<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Acessorio extends Model{
    use SoftDeletes;

    protected $table = 'acessorios';

    protected $fillable = [
        'codigo',
        'descricao',
        'cor',
        'preco'
    ];

    public function historicos(){
        return $this->hasMany(Historico::class);
    }

    public function estoque(){
        return $this->hasOne(Estoque::class);
    }
}