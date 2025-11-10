@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Adicionar Acessório ao Estoque') }}
    </h2>
@endsection

@section('slot')
<div class="py-12">
    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

        <div class="mb-6 text-left">
            <span class="text-2xl font-semibold text-gray-800 tracking-wide">
                Adicionar Acessório ao Estoque
            </span>
        </div>

        <div class="bg-white shadow-sm sm:rounded-lg p-6">

            <form action="{{ route('estoque.store') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Acessório</label>
                    <select name="acessorio_id" class="w-full border rounded px-3 py-2" required>
                        <option value="">Selecione...</option>
                        @foreach($acessorios as $acessorio)
                            <option value="{{ $acessorio->id }}">{{ $acessorio->codigo }} - {{ $acessorio->descricao }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Cor</label>
                    <input type="text" name="cor" class="w-full border rounded px-3 py-2" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Quantidade</label>
                    <input type="number" name="quantidade" class="w-full border rounded px-3 py-2" min="1" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Preço</label>
                    <input type="number" step="0.01" name="preco" class="w-full border rounded px-3 py-2" min="0" required>
                </div>

                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Adicionar</button>
                <a href="{{ route('estoque.index') }}" class="px-4 py-2 bg-gray-400 text-white rounded hover:bg-gray-500">Cancelar</a>
            </form>
        </div>
    </div>
</div>
@endsection
