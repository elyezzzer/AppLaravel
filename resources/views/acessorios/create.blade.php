@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Novo Acessório
    </h2>
@endsection

@section('slot')
    <div class="py-12">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white p-6 rounded shadow">
                <form action="{{ route('acessorios.store') }}" method="POST">
                    @csrf

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label>Código</label>
                            <input type="text" name="codigo" class="border rounded w-full">
                        </div>

                        <div>
                            <label>Descrição</label>
                            <input type="text" name="descricao" class="border rounded w-full">
                        </div>

                        <div>
                            <label>Cor</label>
                            <select name="cor" class="border rounded w-full">
                                <option value="todas">TODAS</option>
                                <option value="preto">PRETO</option>
                                <option value="branco">BRANCO</option>
                                <option value="natural">NATURAL</option>
                            </select>
                        </div>

                        <div>
                            <label>Estoque mínimo</label>
                            <input type="number" name="estoque_minimo" class="border rounded w-full">
                        </div>

                        <div>
                            <label>Preço</label>
                            <input type="number" step="0.01" name="preco" class="border rounded w-full">
                        </div>
                    </div>

                    <button class="bg-green-600 text-white px-4 py-2 mt-4 rounded">
                        Salvar
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection