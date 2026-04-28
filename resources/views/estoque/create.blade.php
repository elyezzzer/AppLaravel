@extends('layouts.app')

@section('slot')
<div class="py-10">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

        {{-- Header --}}
        <div class="mb-7">
            <h1 class="text-2xl font-medium text-gray-900 leading-tight">Adicionar ao Estoque</h1>
            <p class="text-sm text-gray-400 mt-0.5">Cadastre novos itens no estoque</p>
        </div>

        {{-- Card --}}
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6">

            <form action="{{ route('estoque.store') }}" method="POST" class="space-y-5">
                @csrf

                {{-- GRID PRINCIPAL --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    {{-- Código --}}
                    <div>
                        <label class="block text-xs font-medium text-gray-500 mb-1">
                            Código
                        </label>

                        <select name="acessorio_id"
                                id="acessorio"
                                class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm bg-white text-gray-700 focus:outline-none focus:border-gray-400">

                            <option value="">Selecione um acessório</option>

                            @foreach($acessorios as $a)
                                <option value="{{ $a->id }}"
                                        data-descricao="{{ $a->descricao }}"
                                        data-preco="{{ $a->preco }}"
                                        data-minimo="{{ $a->estoque_minimo }}"
                                        data-cor="{{ $a->cor }}">
                                    {{ strtoupper($a->codigo) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Descrição --}}
                    <div>
                        <label class="block text-xs font-medium text-gray-500 mb-1">
                            Descrição
                        </label>

                        <div class="text-sm text-gray-800 font-medium py-2">
                            <span id="infoDescricao"></span>
                        </div>

                    </div>

                    {{-- Cor --}}
                    <div id="campoCor">
                        <label class="block text-xs font-medium text-gray-500 mb-1">
                            Cor
                        </label>

                        <select name="cor"
                                class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm bg-white text-gray-700">

                            <option value="branco">BRANCO</option>
                            <option value="preto">PRETO</option>
                            <option value="natural">NATURAL</option>
                        </select>
                    </div>

                    {{-- Quantidade --}}
                    <div>
                        <label class="block text-xs font-medium text-gray-500 mb-1">
                            Quantidade
                        </label>

                        <input type="number"
                               name="quantidade"
                               min="1"
                               required
                               class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:border-gray-400">
                    </div>

                </div>

                {{-- INFO EXTRA --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">

                    {{-- Preço --}}
                    <div>
                        <label class="block text-xs font-medium text-gray-500 mb-1">
                            Preço
                        </label>

                        <div class="text-sm text-gray-800 font-semibold py-2">
                            <span id="infoPreco"></span>
                        </div>  

                    </div>

                    {{-- Estoque mínimo --}}
                    <div>
                        <label class="block text-xs font-medium text-gray-500 mb-1">
                            Estoque mínimo
                        </label>

                        <div class="text-sm text-gray-800 font-medium py-2">
                            <span id="infoMinimo"></span>
                        </div>

                    </div>

                </div>

                {{-- Actions --}}
                <div class="flex items-center justify-center gap-2 pt-4">
                    <button type="submit"
                            class="px-4 py-2 text-xs font-medium text-white bg-[#1565ff] rounded-lg hover:bg-[#0f4ed1] transition-colors">
                        Adicionar ao estoque
                    </button>

                    <a href="{{ route('estoque.index') }}"
                       class="px-4 py-2 text-xs font-medium text-white bg-gray-500 rounded-lg hover:bg-gray-600 transition-colors">
                        Cancelar
                    </a>
                </div>

            </form>

        </div>
    </div>
</div>

{{-- SCRIPT --}}
<script>
    const select = document.getElementById('acessorio');
    const descricao = document.getElementById('infoDescricao');
    const preco = document.getElementById('infoPreco');
    const minimo = document.getElementById('infoMinimo');
    const campoCor = document.getElementById('campoCor');

    select.addEventListener('change', () => {
        const selected = select.options[select.selectedIndex];

        if (!selected.value) {
            descricao.textContent = '-';
            preco.textContent = '-';
            minimo.textContent = '-';
            return;
        }

        descricao.textContent = selected.dataset.descricao.toUpperCase();

        preco.textContent = 'R$ ' + Number(selected.dataset.preco)
            .toLocaleString('pt-BR', { minimumFractionDigits: 2 });

        minimo.textContent = selected.dataset.minimo;

        if (selected.dataset.cor === 'todas') {
            campoCor.style.display = 'block';
        } else {
            campoCor.style.display = 'none';
        }
    });
</script>

@endsection
