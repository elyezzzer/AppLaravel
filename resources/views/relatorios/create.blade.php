@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Gerar Relatório
    </h2>
@endsection

@section('slot')
<div class="py-10">
    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

        {{-- Header --}}
        <div class="mb-7">
            <h1 class="text-2xl font-medium text-gray-900 leading-tight">
                Gerar Relatório
            </h1>
            <p class="text-sm text-gray-400 mt-0.5">
                Configure os filtros para gerar um novo relatório
            </p>
        </div>

        {{-- Card --}}
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6">

            <form method="POST" action="{{ route('relatorios.gerar') }}" class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                    {{-- Data início --}}
                    <div>
                        <label class="block text-xs font-medium text-gray-500 uppercase">
                            Data início
                        </label>
                        <input type="date" id="data_inicio" name="data_inicio"
                               value="{{ old('data_inicio') }}"
                               class="mt-1 w-full rounded-lg border-gray-200 text-sm focus:border-gray-900 focus:ring-gray-900">

                        @error('data_inicio')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Data fim --}}
                    <div>
                        <label class="block text-xs font-medium text-gray-500 uppercase">
                            Data fim
                        </label>
                        <input type="date" id="data_fim" name="data_fim"
                               value="{{ old('data_fim', now()->format('Y-m-d')) }}"
                               class="mt-1 w-full rounded-lg border-gray-200 text-sm focus:border-gray-900 focus:ring-gray-900">

                        @error('data_fim')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Tipo --}}
                    <div class="md:col-span-2">
                        <label class="block text-xs font-medium text-gray-500 uppercase">
                            Tipo de relatório
                        </label>
                        <select name="tipo"
                                class="mt-1 w-full rounded-lg border-gray-200 text-sm focus:border-gray-900 focus:ring-gray-900">
                            <option value="todos">Todos</option>
                            <option value="entrada">Entrada</option>
                            <option value="saida">Saída</option>
                            <option value="estoque">Estoque Atual</option>
                        </select>
                    </div>

                    {{-- Código --}}
                    <div class="md:col-span-2">
                        <label class="block text-xs font-medium text-gray-500 uppercase">
                            Código do acessório
                        </label>
                        <input
                            type="text"
                            name="codigo"
                            value="{{ old('codigo') }}"
                            placeholder="Opcional"
                            class="mt-1 w-full rounded-lg border-gray-200 text-sm focus:border-gray-900 focus:ring-gray-900"
                        >
                    </div>

                </div>

                {{-- Botões --}}
                <div class="flex justify-center gap-3 pt-4">

                    <button type="submit"
                        class="inline-flex items-center px-4 py-2 bg-gray-900 text-white text-xs font-medium rounded-lg hover:bg-gray-700 transition">
                        Gerar relatório
                    </button>

                    <a href="{{ route('relatorios.index') }}"
                        class="inline-flex items-center px-4 py-2 bg-gray-500 text-white text-xs font-medium rounded-lg hover:bg-gray-600 transition">
                        Voltar
                    </a>

                </div>

            </form>
        </div>

    </div>
</div>

{{-- Script de validação frontend --}}
<script>
    const dataInicio = document.getElementById('data_inicio');
    const dataFim = document.getElementById('data_fim');

    dataInicio.addEventListener('change', function() {
        dataFim.min = this.value;

        if (dataFim.value && dataFim.value < this.value) {
            dataFim.value = this.value;
        }
    });
</script>

@endsection
