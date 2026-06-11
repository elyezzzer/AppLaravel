<?php

namespace App\Http\Services;

use App\Http\Repositories\AcessorioRepository;
use App\Http\Repositories\EstoqueRepository;
use App\Models\Acessorio;
use App\Models\Estoque;

class AcessorioService extends BaseService{

    protected $estoqueRepository;

    public function __construct(AcessorioRepository $repository, EstoqueRepository $estoqueRepository){
        parent::__construct($repository);

        $this->estoqueRepository = $estoqueRepository;
    }

    // Sobrescreve o método store para verificar se o código já existe,
    // mesmo que o acessório esteja excluído, e para restaurar o acessório excluído se necessário
    public function store(array $data){
        $acessorio = Acessorio::withTrashed()
            ->where('user_id', auth()->id())
            ->where('codigo', $data['codigo'])
            ->first();

        if ($acessorio && !$acessorio->trashed()) {
            return ['error' => 'Já existe um acessório com esse código.'];
        }

        if ($acessorio && $acessorio->trashed()) {

            $acessorio->restore();

            $acessorio->update([
                'descricao' => $data['descricao'],
                'cor' => $data['cor'],
                'preco' => $data['preco'],
                'estoque_minimo' => $data['estoque_minimo'],
            ]);

            return ['success' => true];
        }

        $data['user_id'] = auth()->id();
        return parent::store($data);
    }

    // Sobrescreve o método destroy para verificar se há estoque antes de permitir a exclusão
    public function destroy($id){
        $temEstoque = Estoque::where('acessorio_id', $id)
            ->where('quantidade', '>', 0)
            ->exists();

        if ($temEstoque) {
            return ['error' => 'Não é possível excluir: ainda existe estoque deste item.'];
        }

        parent::destroy($id);

        return ['success' => true];
    }

    // Sobrescreve o método update para atualizar o preço do acessório no estoque
    public function update(array $data, $id){
        $acessorio = parent::update($data, $id);

        $this->estoqueRepository->updatePrecoPorAcessorio(
            $id,
            $data['preco']
        );

        return $acessorio;
    }

    public function paginate($perPage = 10, $search = null, $filtro = null){
        return $this->repository->paginate($perPage, $search, $filtro);
    }

}
