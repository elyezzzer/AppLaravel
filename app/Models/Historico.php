<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Historico extends Model
{
    protected $table = 'historico';

    protected $fillable = [
        'acessorio_id',
        'obra_id',
        'quantidade',
        'tipo',
        'preco',
        'cor',
    ];

    public function acessorio()
    {
        return $this->belongsTo(Acessorio::class)->withTrashed();
    }

    public function obra()
    {
        return $this->belongsTo(Obra::class)->withTrashed();
    }
}