<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Obra extends Model
{
    protected $fillable = [
    'nome',
    'cidade',
    'bairro',
    'rua',
    'numero',
    'telefone',
    'data_inicio'
    ];
    use SoftDeletes;
}
