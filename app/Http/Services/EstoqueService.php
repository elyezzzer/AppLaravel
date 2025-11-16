<?php

namespace App\Http\Services;

use App\Http\Repositories\EstoqueRepository;
use App\Models\Acessorio;
use App\Models\Historico;

class EstoqueService extends BaseService
{
    public function __construct(EstoqueRepository $repository){
        parent::__construct($repository);

    }

    public function getAcessorios(){
        return Acessorio::all();

    }

    public function paginate(int $perPage = 10){
        return $this->repository->allAvailable($perPage);

    }

    public function adicionar(array $data){
        $estoque = $this->repository->findByAcessorioAndCor($data['acessorio_id'], $data['cor']);

        if ($estoque) {
            $estoque->quantidade += $data['quantidade'];
            $estoque->preco = $data['preco'];
            $estoque->save();
            return $estoque;
        }

        return $this->repository->store($data);
    }


    public function retirar($estoque, int $quantidade, int $obra_id){
        if ($quantidade > $estoque->quantidade) {
            throw new \Exception("Quantidade a retirar maior que disponível no estoque.");
        }

        $estoque->quantidade -= $quantidade;
        $estoque->save();


        Historico::create([
            'acessorio_id' => $estoque->acessorio_id,
            'obra_id' => $obra_id,
            'quantidade' => $quantidade,
        ]);
    }
}
