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

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    {{-- Acessório --}}
                    <div>
                        <label class="block text-xs font-medium text-gray-500 mb-1">
                            Código  
                        </label>

                        <select name="acessorio_id"
                                id="acessorio"
                                class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm
                                       bg-white text-gray-700
                                       focus:outline-none focus:border-gray-400 transition-colors">

                            @foreach($acessorios as $a)
                                <option value="{{ $a->id }}" data-cor="{{ $a->cor }}">
                                    {{ $a->codigo }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Cor --}}
                    <div id="campoCor">
                        <label class="block text-xs font-medium text-gray-500 mb-1">
                            Cor
                        </label>

                        <select name="cor"
                                class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm
                                       bg-white text-gray-700
                                       focus:outline-none focus:border-gray-400 transition-colors">

                            <option value="branco">Branco</option>
                            <option value="preto">Preto</option>
                            <option value="natural">Natural</option>
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
                               class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm
                                      focus:outline-none focus:border-gray-400 transition-colors">
                    </div>

                </div>

                {{-- Actions --}}
                <div class="flex items-center justify-end gap-2 pt-4 border-gray-100">

                    <a href="{{ route('estoque.index') }}"
                       class="px-4 py-2 text-xs font-medium text-gray-600 bg-gray-100 rounded-lg
                              hover:bg-gray-200 transition-colors">
                        Cancelar
                    </a>

                    <button type="submit"
                            class="px-4 py-2 text-xs font-medium text-white bg-gray-900 rounded-lg
                                   hover:bg-gray-700 transition-colors">
                        Adicionar ao estoque
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

<script>
    const selectAcessorio = document.getElementById('acessorio');
    const campoCor = document.getElementById('campoCor');

    function verificar() {
        if (!selectAcessorio) return;

        const selected = selectAcessorio.options[selectAcessorio.selectedIndex];
        const cor = selected?.dataset.cor;

        if (cor === 'todas') {
            campoCor.style.display = 'block';
        } else {
            campoCor.style.display = 'none';
        }
    }

    selectAcessorio.addEventListener('change', verificar);
    window.addEventListener('load', verificar);
</script>

@endsection
