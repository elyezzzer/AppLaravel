@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Editar Acessório
    </h2>
@endsection

@section('slot')
<div class="py-10">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

        {{-- Header --}}
        <div class="mb-7">
            <h1 class="text-2xl font-medium text-gray-900 leading-tight">Editar acessório</h1>
            <p class="text-sm text-gray-400 mt-0.5">Atualize as informações do acessório</p>
        </div>

        {{-- Card --}}
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6">

            <form action="{{ route('acessorios.update', $acessorio->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                    {{-- Código --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1">Código</label>
                        <input
                            type="text"
                            name="codigo"
                            value="{{ old('codigo', $acessorio->codigo) }}"
                            class="uppercase w-full px-3 py-2 border border-gray-200 rounded-lg text-sm text-gray-700 outline-none focus:border-gray-400 transition-colors"
                        >
                    </div>

                    {{-- Descrição --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1">Descrição</label>
                        <input
                            type="text"
                            name="descricao"
                            value="{{ old('descricao', $acessorio->descricao) }}"
                            class="uppercase w-full px-3 py-2 border border-gray-200 rounded-lg text-sm text-gray-700 outline-none focus:border-gray-400 transition-colors"
                        >
                    </div>

                    {{-- Estoque mínimo --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1">Estoque mínimo</label>
                        <input
                            type="number"
                            name="estoque_minimo"
                            value="{{ old('estoque_minimo', $acessorio->estoque_minimo) }}"
                            class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm text-gray-700 outline-none focus:border-gray-400 transition-colors"
                        >
                    </div>

                    {{-- Cor --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1">Cor</label>
                        <select
                            name="cor"
                            class="w-full px-3 py-2 border border-gray-200 rounded-lg bg-white text-sm text-gray-700 outline-none focus:border-gray-400 transition-colors"
                        >
                            <option value="todas" {{ $acessorio->cor == 'todas' ? 'selected' : '' }}>TODAS</option>
                            <option value="preto" {{ $acessorio->cor == 'preto' ? 'selected' : '' }}>PRETO</option>
                            <option value="branco" {{ $acessorio->cor == 'branco' ? 'selected' : '' }}>BRANCO</option>
                            <option value="natural" {{ $acessorio->cor == 'natural' ? 'selected' : '' }}>NATURAL</option>
                        </select>
                    </div>

                    {{-- Preço --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1">Preço (R$)</label>
                        <input
                            type="number"
                            step="1.00"
                            name="preco"
                            value="{{ old('preco', $acessorio->preco) }}"
                            class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm text-gray-700 outline-none focus:border-gray-400 transition-colors"
                        >
                    </div>

                </div>

                {{-- Actions --}}
                <div class="mt-6 flex items-center gap-2">

                    <button
                        type="submit"
                        class="px-4 py-2 bg-gray-900 text-white text-xs font-medium rounded-lg hover:bg-gray-700 transition-colors"
                    >
                        Atualizar
                    </button>

                    <a href="{{ route('acessorios.index') }}"
                       class="px-4 py-2 border border-gray-200 rounded-lg text-xs font-medium text-gray-600 hover:bg-gray-100 transition-colors">
                        Voltar
                    </a>

                </div>

            </form>

        </div>

    </div>
</div>
@endsection
