@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Retirar do Estoque') }}
    </h2>
@endsection

@section('slot')
<div class="py-12">
    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

        <div class="mb-6 text-left">
            <span class="text-2xl font-semibold text-gray-800 tracking-wide">
                Retirar do Estoque
            </span>
        </div>

        <div class="bg-white shadow-sm sm:rounded-lg p-6">

            <h3 class="text-lg font-semibold mb-4">Acessório: {{ $estoque->acessorio->codigo }} - {{ $estoque->acessorio->descricao }}</h3>
            <p class="mb-2">Cor: {{ $estoque->cor }}</p>
            <p class="mb-4">Quantidade disponível: {{ $estoque->quantidade }}</p>

            <form action="{{ route('estoque.processarRetirada', $estoque->id) }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Quantidade a retirar</label>
                    <input type="number" name="quantidade" class="w-full border rounded px-3 py-2" min="1" max="{{ $estoque->quantidade }}" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Selecionar Obra</label>
                    <select name="obra_id" class="w-full border rounded px-3 py-2" required>
                        <option value="">Selecione...</option>
                        @foreach($obras as $obra)
                            <option value="{{ $obra->id }}">{{ $obra->nome }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">Confirmar Retirada</button>
                <a href="{{ route('estoque.index') }}" class="px-4 py-2 bg-gray-400 text-white rounded hover:bg-gray-500">Cancelar</a>
            </form>

        </div>
    </div>
</div>
@endsection
