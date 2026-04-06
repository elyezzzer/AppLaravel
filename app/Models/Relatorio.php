<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Relatorio extends Model{

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