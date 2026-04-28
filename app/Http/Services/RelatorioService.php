<?php

namespace App\Http\Services;

use App\Http\Repositories\RelatorioRepository;

class RelatorioService extends BaseService{

    protected $relatorioRepository;

    public function __construct(RelatorioRepository $relatorioRepository){
        $this->relatorioRepository = $relatorioRepository;
    }

    public function getEstoque($filtros = []){
        return $this->relatorioRepository->estoque($filtros);   
    }

    public function getMovimentacoes($filtros = []){
        return $this->relatorioRepository->movimentacoes($filtros);
    }

    public function getItensObra($filtros = []){
        return $this->relatorioRepository->itensObra($filtros);
    }

}
