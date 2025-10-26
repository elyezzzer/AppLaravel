@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Retirar Acessório') }}
    </h2>
@endsection

@section('slot')
<div class="py-12">
    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white p-6 shadow-sm sm:rounded-lg mb-6">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-gray-700">
                <div>
                    <strong>Código:</strong> {{ $acessorio->codigo }}
                </div>
                <div>
                    <strong>Descrição:</strong> {{ $acessorio->descricao }}
                </div>
                <div>
                    <strong>Cor:</strong> {{ $acessorio->cor }}
                </div>
                <div>
                    <strong>Quantidade disponível:</strong> {{ $acessorio->quantidade }}
                </div>
            </div>
        </div>

        <div class="bg-white p-6 shadow-sm sm:rounded-lg">
            <form action="{{ route('acessorios.retirar', $acessorio->id) }}" method="POST" class="space-y-6">
                @csrf

                <div class="flex flex-col sm:flex-row sm:space-x-4 gap-4">
                    <div class="sm:w-1/3">
                        <label class="block text-sm font-medium text-gray-700">Quantidade a retirar</label>
                        <input type="number" name="quantidade" min="1" max="{{ $acessorio->quantidade }}" required
                            class="mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>

                    <div class="sm:flex-1">
                        <label class="block text-sm font-medium text-gray-700">Selecionar Obra</label>
                        <select name="obra_id" required
                            class="mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">Selecione...</option>
                            @foreach($obras as $obra)
                                <option value="{{ $obra->id }}">{{ $obra->nome }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="flex justify-center gap-4 mt-4">
                    <button type="submit"
                        class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent 
                        rounded-md font-semibold text-xs text-white uppercase tracking-widest 
                        hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 
                        focus:ring-offset-2 transition ease-in-out duration-150">
                        Confirmar Retirada
                    </button>

                    <a href="{{ route('acessorios.index') }}"
                        class="inline-flex items-center px-4 py-2 bg-gray-500 border border-transparent 
                        rounded-md font-semibold text-xs text-white uppercase tracking-widest 
                        hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-400 
                        focus:ring-offset-2 transition ease-in-out duration-150">
                        Cancelar
                    </a>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
