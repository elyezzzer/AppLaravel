@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Estoque de Acessórios') }}
    </h2>
@endsection

@section('slot')
<div class="py-10">
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">

        {{-- Header --}}
        <div class="flex items-end justify-between mb-7 flex-wrap gap-4">
            <div>
                <h1 class="text-2xl font-medium text-gray-900 leading-tight">Estoque</h1>
                <p class="text-sm text-gray-400 mt-0.5">Gerencie o estoque de acessórios</p>
            </div>

            <a href="{{ route('estoque.create') }}"
               class="inline-flex items-center gap-1.5 px-4 py-2 bg-[#1565ff] text-white text-xs font-medium rounded-lg hover:bg-[#0f4ed1] transition-colors duration-150">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" viewBox="0 0 16 16">
                    <line x1="8" y1="2" x2="8" y2="14"/>
                    <line x1="2" y1="8" x2="14" y2="8"/>
                </svg>
                Adicionar ao estoque
            </a>
        </div>

        {{-- Toolbar --}}
        <form method="GET" action="{{ route('estoque.index') }}"
              class="flex items-center gap-2.5 mb-5 flex-wrap">

            <span class="text-sm text-gray-500 font-medium whitespace-nowrap">Filtrar por</span>

            <select name="filtro"
                    class="px-3 pr-8 py-1.5 border border-gray-200 rounded-lg bg-white text-gray-700 text-sm outline-none focus:border-gray-400 transition-colors">
                <option value="tudo" {{ request('filtro','tudo') == 'tudo' ? 'selected' : '' }}>Tudo</option>
                <option value="codigo" {{ request('filtro') == 'codigo' ? 'selected' : '' }}>Código</option>
                <option value="descricao" {{ request('filtro') == 'descricao' ? 'selected' : '' }}>Descrição</option>
                <option value="cor" {{ request('filtro') == 'cor' ? 'selected' : '' }}>Cor</option>
                <option value="preco" {{ request('filtro') == 'preco' ? 'selected' : '' }}>Preço</option>
            </select>

            <div class="relative flex-1 min-w-44 max-w-xs">
                <svg class="absolute left-2.5 top-1/2 -translate-y-1/2 w-3.5 h-3.5 text-gray-400 pointer-events-none"
                     fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" viewBox="0 0 16 16">
                    <circle cx="6.5" cy="6.5" r="4.5"/>
                    <line x1="10" y1="10" x2="14" y2="14"/>
                </svg>

                <input type="text"
                       name="search"
                       value="{{ request('search') }}"
                       placeholder="Buscar no estoque..."
                       class="w-full pl-8 pr-3 py-1.5 border border-gray-200 rounded-lg bg-white text-sm text-gray-700 placeholder-gray-400 outline-none focus:border-gray-400 transition-colors">
            </div>

            <button type="submit"
                    class="px-4 py-1.5 border border-gray-200 rounded-lg bg-gray-50 text-gray-600 text-xs font-medium hover:bg-gray-100 transition-colors">
                Buscar
            </button>
        </form>

        {{-- Mensagem de sucesso --}}
        @if(session('success'))
            <div class="flex items-start gap-2 px-4 py-2.5 bg-green-50 border border-green-200 rounded-lg text-sm text-green-700 mb-5">
                <ul class="list-disc pl-4 space-y-0.5">
                    <li>{{ session('success') }}</li>
                </ul>
            </div>
        @endif

        {{-- Tabela --}}
        <div class="bg-white border border-gray-200 rounded-xl overflow-hidden shadow-sm">
            <table class="min-w-full divide-y divide-gray-100">

                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-5 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-widest">Código</th>
                        <th class="px-5 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-widest">Descrição</th>
                        <th class="px-5 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-widest">Cor</th>
                        <th class="px-5 py-3 text-center text-xs font-medium text-gray-400 uppercase tracking-widest">Quantidade</th>
                        <th class="px-5 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-widest">Preço</th>
                        <th class="px-5 py-3 text-center text-xs font-medium text-gray-400 uppercase tracking-widest">Est. mínimo</th>
                        <th class="px-5 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-widest">Ações</th>
                    </tr>
                </thead>

                <tbody class="bg-white divide-y divide-gray-50">
                    @foreach($estoques as $estoque)

                        @php
                            $quantidade = $estoque->quantidade;
                            $minimo = $estoque->acessorio->estoque_minimo;
                        @endphp

                        <tr class="hover:bg-gray-50 transition-colors duration-100">

                            <td class="px-5 py-3.5 text-sm text-gray-700 uppercase">
                                {{ $estoque->acessorio->codigo }}
                            </td>

                            <td class="px-5 py-3.5 text-sm text-gray-700 uppercase">
                                {{ $estoque->acessorio->descricao }}
                            </td>

                            <td class="px-5 py-3.5 text-sm text-gray-700 uppercase">
                                {{ $estoque->cor }}
                            </td>

                            <td class="px-5 py-3.5 text-sm text-gray-700 text-center">
                                <div class="flex items-center justify-center gap-2">

                                    @if($quantidade < $minimo)
                                        <span class="w-2.5 h-2.5 rounded-full bg-yellow-400"></span>
                                    @else
                                        <span class="w-2.5 h-2.5 rounded-full bg-green-500"></span>
                                    @endif

                                    <span>{{ $quantidade }}</span>
                                </div>
                            </td>

                            <td class="px-5 py-3.5 text-sm text-gray-700 tabular-nums">
                                R$ {{ number_format($estoque->preco, 2, ',', '.') }}
                            </td>

                            <td class="px-5 py-3.5 text-sm text-gray-700 text-center">
                                {{ $minimo }}
                            </td>

                            <td class="px-5 py-3.5">
                                <div class="flex items-center gap-2">

                                    <x-tooltip text="Retirar">
                                        <a href="{{ route('estoque.retirar', $estoque->id) }}"
                                           class="p-2 py-2 bg-green-100 text-green-600 rounded-lg
                                                  border border-green-150
                                                  hover:bg-green-600 hover:text-white hover:border-green-600
                                                  hover:scale-105 active:scale-95
                                                  transition-all duration-150">
                                            
                                            {{-- Ícone saída --}}
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                                            </svg>
                                        </a>
                                    </x-tooltip>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>

            {{-- Paginação --}}
            <div class="flex items-center justify-between px-5 py-3 border-t border-gray-100">
                <span class="text-xs text-gray-400">
                    Mostrando {{ $estoques->firstItem() }}–{{ $estoques->lastItem() }} de {{ $estoques->total() }} resultados
                </span>

                {{ $estoques->appends(request()->query())->links('components.pagination') }}
            </div>
        </div>

    </div>
</div>
@endsection
