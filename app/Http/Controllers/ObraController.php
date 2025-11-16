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
        $obras = $this->service->paginate(10);
        return view('obras.index', compact('obras'));

    }

    public function create(){
        return view('obras.create');
        
    }

    public function edit(Obra $obra){
        return view('obras.edit', compact('obra'));

    }

    public function store(Request $request){
        $result = $this->service->store($request->all());

        if (isset($result['error'])) {
            return back()
            ->withErrors(['nome' => $result['error']])
            ->withInput();
        }

        return redirect()
        ->route('obras.index')
        ->with('success', 'Obra cadastrada com sucesso!');
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
