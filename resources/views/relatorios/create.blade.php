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

            <form method="POST" action="{{ route('relatorios.gerar') }}" class="space-y-6" id="form-relatorio">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                    {{-- Tipo --}}
                    <div class="md:col-span-2">
                        <label class="block text-xs font-medium text-gray-500 uppercase">
                            Tipo de relatório
                        </label>

                        <select id="tipo_relatorio" name="tipo"
                                class="mt-1 w-full rounded-lg border-gray-200 text-sm focus:border-gray-900 focus:ring-gray-900">
                            <option value="todos" {{ old('tipo') == 'todos' ? 'selected' : '' }}>
                                Entrada/Saída
                            </option>
                            <option value="entrada" {{ old('tipo') == 'entrada' ? 'selected' : '' }}>
                                Entrada
                            </option>
                            <option value="saida" {{ old('tipo') == 'saida' ? 'selected' : '' }}>
                                Saída
                            </option>
                            <option value="estoque" {{ old('tipo') == 'estoque' ? 'selected' : '' }}>
                                Estoque Atual
                            </option>
                            <option value="obra" {{ old('tipo') == 'obra' ? 'selected' : '' }}>
                                Obra
                            </option>
                        </select>
                    </div>

                    {{-- Obra --}}
                    <div class="md:col-span-2 hidden" id="campo_obra">
                        <label class="block text-xs font-medium text-gray-500 uppercase">
                            Selecione a obra
                        </label>

                        <select name="obra_id" id="obra_id"
                                class="mt-1 w-full rounded-lg border-gray-200 text-sm focus:border-gray-900 focus:ring-gray-900">

                            <option value="">Selecione uma obra</option>

                            @foreach ($obras as $obra)
                                <option value="{{ $obra->id }}"
                                    {{ old('obra_id') == $obra->id ? 'selected' : '' }}>
                                    {{ $obra->nome }}
                                </option>
                            @endforeach

                        </select>

                        @error('obra_id')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Data início --}}
                    <div class="campo_datas">
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
                    <div class="campo_datas">
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
                        class="inline-flex items-center px-4 py-2 bg-[#1565ff] text-white text-xs font-medium rounded-lg hover:bg-[#0f4ed1] transition">
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

{{-- Script de validação e atualização de campos --}}
<script>
    const dataInicio = document.getElementById('data_inicio');
    const dataFim = document.getElementById('data_fim');
    const tipoRelatorio = document.getElementById('tipo_relatorio');
    const obraId = document.getElementById('obra_id');
    const submitBtn = document.querySelector('button[type="submit"]');
    const campoObra = document.getElementById('campo_obra');
    const camposDatas = document.querySelectorAll('.campo_datas');

    function atualizarCampos() {
        const tipo = tipoRelatorio.value;
        if (tipo === 'obra') {
            campoObra.classList.remove('hidden');
        } else {
            campoObra.classList.add('hidden');
        }

        camposDatas.forEach(campo => {
            if (tipo === 'estoque') {
                campo.classList.add('hidden');
            } else {
                campo.classList.remove('hidden');
            }
        });
        atualizarValidacao();
    }

    dataInicio.addEventListener('change', function() {
        dataFim.min = this.value;

        if (dataFim.value && dataFim.value < this.value) {
            dataFim.value = this.value;
        }
    });
    
    tipoRelatorio.addEventListener('change', atualizarCampos);
    atualizarCampos();
</script>

@endsection