<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\ObraService;
use App\Models\Obra;
use App\Http\Requests\StoreObraRequest;
use App\Http\Requests\UpdateObraRequest;

class ObraController extends Controller{

    protected ObraService $service;

    public function __construct(ObraService $service){
        $this->service = $service;

    }

    public function index(){
        $obras = $this->service->index();
        return view('obras.index', compact('obras'));

    }

    public function create(){
        return view('obras.create');
        
    }

    public function edit(Obra $obra){
        return view('obra.edit', compact('obra'));

    }

    public function store(Request $request){
        $this->service->store($request->all());
        return redirect()->route('obras.index');

    }

    public function update(UpdateObraRequest $request, Obra $obra){
       $this->service->update($request->validated(), $obra->id);
        return redirect()->route('obras.index');

    }
 

    public function destroy(Obra $obra){
        $this->service->destroy($obra->id);
        return redirect()->route('obras.index');

    }
}
