@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Retirar do Estoque') }}
    </h2>
@endsection

@section('slot')
<div class="py-10">
    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

        {{-- Header --}}
        <div class="mb-7">
            <h1 class="text-2xl font-medium text-gray-900 leading-tight">Retirada de Estoque</h1>
            <p class="text-sm text-gray-400 mt-0.5">Registre a saída de um acessório</p>
        </div>

        {{-- Mensagem de erro --}}
        @if($errors->any())
            <div class="flex items-start gap-2 px-4 py-2.5 bg-red-50 border border-red-200 rounded-lg text-sm text-red-700 mb-5">
                <ul class="list-disc pl-4 space-y-0.5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Card --}}
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6">

            @php
                $quantidade = $estoque->quantidade;
                $minimo = $estoque->acessorio->estoque_minimo;
            @endphp

            {{-- Info do item --}}
            <div class="mb-6">
                <div class="mt-3 grid grid-cols-2 gap-4 text-sm text-gray-600">
                    <p>
                        <span class="font-medium text-gray-500">Código:</span>
                        {{ strtoupper($estoque->acessorio->codigo) }}
                    </p>

                    <p>
                        <span class="font-medium text-gray-500">Descrição:</span>
                        {{ strtoupper($estoque->acessorio->descricao) }}
                    </p>
                    
                    <p>
                        <span class="font-medium text-gray-500">Cor:</span>
                        {{ strtoupper($estoque->cor) }}
                    </p>

                    <p>
                        <span class="font-medium text-gray-500">Preço:</span>
                        R$ {{ number_format($estoque->preco, 2, ',', '.') }}
                    </p>

                    <p>
                        <span class="font-medium text-gray-500">Estoque mínimo:</span>
                        {{ $minimo }}
                    </p>

                    <div class="flex items-center gap-2">
                        <span class="font-medium text-gray-500">Disponível:</span>

                        @if($quantidade < $minimo)
                            <span class="w-2.5 h-2.5 rounded-full bg-yellow-400"></span>
                        @else
                            <span class="w-2.5 h-2.5 rounded-full bg-green-500"></span>
                        @endif

                        <span>{{ $quantidade }}</span>
                    </div>
                </div>
            </div>

            {{-- Alerta --}}
            @if($quantidade < $minimo)
                <div class="mb-5 text-xs text-yellow-700 bg-yellow-50 border border-yellow-200 px-3 py-2 rounded-lg">
                    Atenção: estoque abaixo do mínimo recomendado.
                </div>
            @endif

            {{-- Form --}}
            <form action="{{ route('estoque.processarRetirada', $estoque->id) }}" method="POST" class="space-y-5" novalidate>
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    {{-- Quantidade --}}
                    <div>
                        <label class="block text-xs font-medium text-gray-500 mb-1">
                            Quantidade a retirar
                        </label>

                        <input type="number"
                               name="quantidade"
                               min="1"
                               max="{{ $estoque->quantidade }}"
                               value="{{ old('quantidade') }}"
                               class="w-full px-3 py-2 border rounded-lg text-sm outline-none transition-colors
                               {{ $errors->has('quantidade') ? 'border-red-300 focus:border-red-400' : 'border-gray-200 focus:border-gray-400' }}">
                        @error('quantidade')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Obra --}}
                    <div>
                        <label class="block text-xs font-medium text-gray-500 mb-1">
                            Selecionar obra
                        </label>
                        <select name="obra_id"
                                class="w-full px-3 py-2 border rounded-lg text-sm bg-white text-gray-700 outline-none transition-colors
                                {{ $errors->has('obra_id') ? 'border-red-300 focus:border-red-400' : 'border-gray-200 focus:border-gray-400' }}">

                            <option value="">Selecione...</option>

                            @foreach($obras as $obra)
                                <option value="{{ $obra->id }}" {{ old('obra_id') == $obra->id ? 'selected' : '' }}>{{ $obra->nome }}</option>
                            @endforeach
                        </select>
                        @error('obra_id')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Ações --}}
                <div class="flex items-center justify-end gap-2 pt-4 border-gray-100">

                    <a href="{{ route('estoque.index') }}"
                       class="px-4 py-2 text-xs font-medium text-gray-600 bg-gray-100 rounded-lg
                              hover:bg-gray-200 transition-colors">
                        Cancelar
                    </a>

                    <button type="submit"
                            class="px-4 py-2 text-xs font-medium text-white bg-green-600 rounded-lg
                                   hover:bg-green-700 transition-colors">
                        Confirmar retirada
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
