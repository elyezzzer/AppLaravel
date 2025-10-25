<?php

namespace App\Http\Services;
use App\Http\Repositories\AcessorioRepository;
use App\Models\Acessorio;
use App\Models\Historico;   

class AcessorioService extends BaseService{
    public function __construct(AcessorioRepository $repository){
        parent::__construct($repository);
    }

    public function retirar(Acessorio $acessorio, int $quantidade, int $obra_id){
        if ($quantidade > $acessorio->quantidade) {
            throw new \Exception('Quantidade insuficiente em estoque.');
        }   

        $acessorio->quantidade -= $quantidade;
        $acessorio->save();

        Historico::create([
            'acessorio_id' => $acessorio->id,
            'obra_id' => $obra_id,
            'quantidade' => $quantidade,
        ]);

        return $acessorio;

    }
}


