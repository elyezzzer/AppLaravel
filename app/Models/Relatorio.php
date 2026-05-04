<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Relatorio extends Model{
    use SoftDeletes;

    protected $fillable = [
        'nome',
        'tipo',
        'arquivo',
        'data_inicio',
        'data_fim'
    ];
    
    protected $casts = [
        'data_inicio' => 'date',
        'data_fim' => 'date',
    ];
}