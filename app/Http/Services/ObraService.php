<?php

namespace App\Http\Services;
use App\Http\Repositories\ObraRepository;

class ObraService extends BaseService{
    public function __construct(ObraRepository $repository){
        parent::__construct($repository);
    }
}
