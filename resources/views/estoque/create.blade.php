@extends('layouts.app')

@section('slot')
<div class="py-10">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

        {{-- Header --}}
        <div class="mb-7">
            <h1 class="text-2xl font-medium text-gray-900 leading-tight">Adicionar ao Estoque</h1>
            <p class="text-sm text-gray-400 mt-0.5">Cadastre novos itens no estoque</p>
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

        <div id="erroCodigoTopo"
            class="hidden mb-2 p-4 border border-red-200 bg-red-50 rounded-xl">

            <p class="text-sm font-medium text-red-700">
                Código inválido
            </p>

            <p class="text-xs text-red-600 mt-1">
                Selecione um código da lista ou cadastre um novo acessório.
            </p>
        </div>

        <a href="{{ route('acessorios.create') }}"
            class="hidden mb-4 inline-flex items-center justify-center px-3 py-1.5 text-xs font-medium text-white bg-blue-500 rounded-lg hover:bg-gray-600 transition-colors"
            id="btnCadastrarAcessorio">
            Cadastrar novo acessório
        </a>

        {{-- Card --}}
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6">

            <form action="{{ route('estoque.store') }}" method="POST" class="space-y-5" novalidate>
                @csrf

                {{-- GRID PRINCIPAL --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    {{-- Código --}}
                    <div class="relative" id="autocomplete">
                        <label class="block text-xs font-medium text-gray-500 mb-1">
                            Código
                        </label>

                        <input type="text"
                            id="search"
                            value="{{ old('codigo_digitado', old('codigo')) }}"
                            name="codigo_digitado"
                            placeholder="Digite o código..."
                            autocomplete="off"
                            class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:border-gray-400">

                        <input type="hidden" name="acessorio_id" id="acessorio_id" value="{{ old('acessorio_id') }}">

                        <div id="dropdown"
                            class="absolute z-50 w-full bg-white border border-gray-200 rounded-lg mt-0.5 shadow max-h-48 overflow-y-auto hidden">
                        </div>
                        @error('acessorio_id')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Descrição --}}
                    <div>
                        <label class="pl-10 block text-xs font-medium text-gray-500 mb-1">
                            Descrição
                        </label>

                        <div class="pl-10 text-sm text-gray-800 font-medium py-2">
                            <span id="infoDescricao">{{ old('descricao') }}</span>
                            <input type="hidden"
                                name="descricao"
                                id="descricao_hidden"
                                value="{{ old('descricao') }}">
                            
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

                    {{-- Preço --}}
                    <div>
                        <label class="pl-10 block text-xs font-medium text-gray-500 mb-1">
                            Preço
                        </label>

                        <div class="pl-10 text-sm text-gray-800 font-semibold py-2">
                            <span id="infoPreco">{{ old('preco') }}</span>
                            <input type="hidden"
                                name="preco"
                                id="preco_hidden"
                                value="{{ old('preco') }}">

                        </div>  
                    </div>

                    {{-- Quantidade --}}
                    <div>
                        <label class="block text-xs font-medium text-gray-500 mb-1">
                            Quantidade
                        </label>

                        <input type="number"
                               name="quantidade"
                               value="{{ old('quantidade') }}"
                               min="1"
                               class="w-full px-3 py-2 border rounded-lg text-sm outline-none transition-colors
                               {{ $errors->has('quantidade') ? 'border-red-300 focus:border-red-400' : 'border-gray-200 focus:border-gray-400' }}">
                        @error('quantidade')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Estoque mínimo --}}
                    <div>
                        <label class="pl-10 block text-xs font-medium text-gray-500 mb-1">
                            Estoque mínimo
                        </label>

                        <div class="pl-10 text-sm text-gray-800 font-medium py-2">
                            <span id="infoMinimo">{{ old('estoque_minimo') }}</span>
                            <input type="hidden"
                                name="estoque_minimo"
                                id="estoque_minimo_hidden"
                                value="{{ old('estoque_minimo') }}">

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
                </div>  
            </form>
        </div>
    </div>
</div>

{{-- Script de autocomplete e validação --}}
<script>
    const acessorios = @json($acessorios);

    const btnCadastrar = document.getElementById('btnCadastrarAcessorio');
    const erroTopo = document.getElementById('erroCodigoTopo');
    const input = document.getElementById('search');
    const dropdown = document.getElementById('dropdown');
    const hidden = document.getElementById('acessorio_id');

    // Fecha ao clicar fora
    document.addEventListener('click', (e) => {
        if (!document.getElementById('autocomplete').contains(e.target)) {
            dropdown.classList.add('hidden');
        }
    });

    // Atualiza os campos
    function atualizarInfos(a) {
        const descricao = a.descricao.toUpperCase();

        const preco =
            'R$ ' + Number(a.preco).toLocaleString('pt-BR', {
                minimumFractionDigits: 2
            });

        document.getElementById('infoDescricao').textContent = descricao;
        document.getElementById('infoPreco').textContent = preco;
        document.getElementById('infoMinimo').textContent = a.estoque_minimo;

        document.getElementById('descricao_hidden').value = descricao;
        document.getElementById('preco_hidden').value = preco;
        document.getElementById('estoque_minimo_hidden').value = a.estoque_minimo;

        const campoCor = document.getElementById('campoCor');
        campoCor.style.display = (a.cor === 'todas') ? 'block' : 'none';
    }

    // Valida ao perder o foco
    input.addEventListener('blur', () => {
        setTimeout(() => {
            const existe = acessorios.some(a =>
                a.codigo.toLowerCase() === input.value.toLowerCase()
            );

            if (!input.value) {
                erroTopo.classList.add('hidden');
                btnCadastrar.classList.add('hidden');
                hidden.value = '';
                return;
            }

            if (!existe) {
                erroTopo.classList.remove('hidden');
                btnCadastrar.classList.remove('hidden');
                hidden.value = '';
            }
        }, 150);
    });

    // Filtra e mostra dropdown
    input.addEventListener('input', () => {
        const value = input.value.toLowerCase().trim();

        dropdown.innerHTML = '';

        if (!value) {

            dropdown.classList.add('hidden');
            erroTopo.classList.add('hidden');
            btnCadastrar.classList.add('hidden');

            hidden.value = '';

            return;
        }

        const filtrados = acessorios.filter(a =>
            a.codigo.toLowerCase().includes(value)
        );

        // limpa seleção antiga
        hidden.value = '';

        if (filtrados.length === 0) {

            dropdown.innerHTML =
                `<div class="px-3 py-2 text-sm text-gray-400">Nenhum resultado</div>`;

            erroTopo.classList.remove('hidden');
            btnCadastrar.classList.remove('hidden');

        } else {

            erroTopo.classList.add('hidden');
            btnCadastrar.classList.add('hidden');

            filtrados.forEach(a => {

                const item = document.createElement('div');

                item.className =
                    "px-3 py-2 text-sm cursor-pointer hover:bg-gray-100";

                item.textContent = a.codigo.toUpperCase();

                item.onclick = () => {

                    input.value = a.codigo.toUpperCase();
                    hidden.value = a.id;

                    dropdown.classList.add('hidden');
                    erroTopo.classList.add('hidden');
                    btnCadastrar.classList.add('hidden');

                    atualizarInfos(a);
                };

                dropdown.appendChild(item);
            });
        }

        dropdown.classList.remove('hidden');
    });

    // Valida antes de enviar
    const form = document.querySelector('form');
    form.addEventListener('submit', (e) => {
        if (!hidden.value) {
            e.preventDefault();
            erroTopo.classList.remove('hidden');
            btnCadastrar.classList.remove('hidden');
            input.focus();
        }
    });

</script>


@endsection
