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

    public function paginate(int $perPage = 10, $search = null, $filtro = null){
        return $this->repository->paginate($perPage, $search, $filtro);
    }

    // Adiciona uma nova entrada no estoque, verificando se já existe um registro para o acessório e cor
    public function adicionar(array $data){
        if ($estoque){
            $estoque->quantidade += $data['quantidade'];
            $estoque->preco = $data['preco'];
            $estoque->save();

        } else {
            $estoque = $this->repository->store($data);

        }

        Historico::create([
            'acessorio_id' => $data['acessorio_id'],
            'quantidade' => $data['quantidade'],
            'tipo' => 'entrada'
        ]);

        return $estoque;
    }

    // Processa a retirada do estoque, verificando se a quantidade solicitada é menor ou igual à disponível
    public function retirar($estoque, int $quantidade, int $obra_id){
        if ($quantidade > $estoque->quantidade) {
            throw new \Exception(
                "Quantidade a retirar maior que disponível no estoque."
            );
        }

        $estoque->quantidade -= $quantidade;
        $estoque->save();

        Historico::create([
            'acessorio_id' => $estoque->acessorio_id,
            'obra_id' => $obra_id,
            'quantidade' => $quantidade,
            'tipo' => 'saida'
        ]);
    }
}