<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Obra extends Model{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'nome',
        'cidade',
        'bairro',
        'rua',
        'numero',
        'telefone',
        'data_inicio'
    ];
   
    protected static function booted(): void{
        static::creating(function ($model) {
            $model->user_id = auth()->id();
        });
    }

}
