<?php

namespace App\Http\Services;

use App\Http\Repositories\RelatorioRepository;

class RelatorioService extends BaseService{

    protected $relatorioRepository;

    public function __construct(RelatorioRepository $relatorioRepository){
        $this->relatorioRepository = $relatorioRepository;
    }

    public function getEstoque(){
        return $this->relatorioRepository->estoque();
    }

    public function getMovimentacoes(){
        return $this->relatorioRepository->movimentacoes();
    }

}
