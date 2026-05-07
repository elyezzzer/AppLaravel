@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Lista de Acessórios') }}
    </h2>
@endsection

@section('slot')
<div class="py-10" >
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">

        {{-- Header --}}
        <div class="flex items-end justify-between mb-7 flex-wrap gap-4">
            <div>
                <h1 class="text-2xl font-medium text-gray-900 leading-tight">Acessórios</h1>
                <p class="text-sm text-gray-400 mt-0.5">Gerencie o catálogo de acessórios</p>
            </div>
            <a href="{{ route('acessorios.create') }}"
               class="inline-flex items-center gap-1.5 px-4 py-2 bg-[#1565ff] text-white text-xs font-medium rounded-lg hover:bg-[#0f4ed1] transition-colors duration-150">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" viewBox="0 0 16 16">
                    <line x1="8" y1="2" x2="8" y2="14"/><line x1="2" y1="8" x2="14" y2="8"/>
                </svg>
                Novo acessório
            </a>
        </div>

        {{-- Toolbar --}}
        <form method="GET" action="{{ route('acessorios.index') }}"
              class="flex items-center gap-2.5 mb-5 flex-wrap">

            <span class="text-sm text-gray-500 font-medium whitespace-nowrap">Filtrar por</span>

            <select name="filtro"
                    class="px-3 pr-8 py-1.5 border border-gray-200 rounded-lg bg-white text-gray-700 text-sm outline-none focus:border-gray-400 transition-colors">
                <option value="tudo"      {{ request('filtro', 'tudo') == 'tudo'      ? 'selected' : '' }}>Tudo</option>
                <option value="codigo"    {{ request('filtro') == 'codigo'    ? 'selected' : '' }}>Código</option>
                <option value="descricao" {{ request('filtro') == 'descricao' ? 'selected' : '' }}>Descrição</option>
                <option value="cor"       {{ request('filtro') == 'cor'       ? 'selected' : '' }}>Cor</option>
                <option value="preco"     {{ request('filtro') == 'preco'     ? 'selected' : '' }}>Preço</option>
            </select>

            <div class="relative flex-1 min-w-44 max-w-xs">
                <svg class="absolute left-2.5 top-1/2 -translate-y-1/2 w-3.5 h-3.5 text-gray-400 pointer-events-none"
                     fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" viewBox="0 0 16 16">
                    <circle cx="6.5" cy="6.5" r="4.5"/><line x1="10" y1="10" x2="14" y2="14"/>
                </svg>
                <input type="text"
                       name="search"
                       value="{{ request('search') }}"
                       placeholder="Buscar acessório..."
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

        {{-- Mensagem de erro --}}
        @if($errors->any())
            <div class="flex items-start gap-2 px-4 py-2.5 bg-red-50 border border-red-200 rounded-lg text-sm text-red-700 mb-5">
                <ul class="list-disc pl-4 space-y-0.5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @elseif(session('error'))
            <div class="flex items-start gap-2 px-4 py-2.5 bg-red-50 border border-red-200 rounded-lg text-sm text-red-700 mb-5">
                <ul class="list-disc pl-4 space-y-0.5">
                    <li>{{ session('error') }}</li>
                </ul>
            </div>
        @endif

        {{-- Card de tabela --}}
        <div class="bg-white border border-gray-200 rounded-xl overflow-hidden shadow-sm">
            <table class="min-w-full divide-y divide-gray-100">

                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-5 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-widest">Código</th>
                        <th class="px-5 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-widest">Descrição</th>
                        <th class="px-5 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-widest">Cor</th>
                        <th class="px-5 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-widest">Est. mínimo</th>
                        <th class="px-5 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-widest">Preço</th>
                        <th class="px-5 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-widest">Ações</th>
                    </tr>
                </thead>

                <tbody class="bg-white divide-y divide-gray-50">
                    @foreach($acessorios as $acessorio)
                    <tr class="hover:bg-gray-50 transition-colors duration-100">

                        <td class="px-5 py-3.5 whitespace-nowrap text-sm text-gray-700 uppercase">
                            {{ $acessorio->codigo }}
                        </td>

                        <td class="px-5 py-3.5 whitespace-nowrap text-sm text-gray-700 uppercase">
                            {{ $acessorio->descricao }}
                        </td>

                        <td class="px-5 py-3.5 whitespace-nowrap text-sm text-gray-700 uppercase">
                            {{ $acessorio->cor }}
                        </td>

                        <td class="px-5 py-3.5 whitespace-nowrap text-sm text-gray-700 uppercase">
                            {{ $acessorio->estoque_minimo }}
                        </td>

                        <td class="px-5 py-3.5 whitespace-nowrap text-sm text-gray-700 uppercase tabular-nums">
                            R$ {{ number_format($acessorio->preco, 2, ',', '.') }}
                        </td>

                        <td class="px-5 py-3.5 whitespace-nowrap">
                            <div class="flex items-center gap-2">

                                {{-- Editar --}}
                                <x-tooltip text="Editar">
                                <a href="{{ route('acessorios.edit', $acessorio->id) }}"
                                    class="p-2 bg-blue-50 text-blue-600 rounded-lg
                                        border border-blue-100
                                        hover:bg-blue-600 hover:text-white hover:border-blue-600
                                        hover:scale-105 active:scale-95
                                        transition-all duration-150">

                                    {{-- Ícone lápis --}}
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                    </svg>
                                </a>
                                </x-tooltip>

                                {{-- Excluir --}}
                                <x-tooltip text="Excluir">
    
                                    @csrf
                                    @method('DELETE')

                                    <button type="button"
                                            x-on:click="$dispatch('open-modal', 'confirm-delete-{{ $acessorio->id }}')"
                                            class="p-2 bg-red-50 text-red-600 rounded-lg
                                                border border-red-100
                                                hover:bg-red-600 hover:text-white hover:border-red-600
                                                hover:scale-105 active:scale-95
                                                transition-all duration-150">

                                        {{-- Ícone lixeira --}}
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="size-5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                        </svg>
                                    </button>

                                    {{-- Modal de confirmação --}}
                                    <x-modal name="confirm-delete-{{ $acessorio->id }}">
                                        <div class="p-6">

                                            <h2 class="text-lg font-semibold text-gray-800 mb-4">
                                                Confirmar exclusão
                                            </h2>

                                            <p class="text-gray-600 mb-6">
                                                Tem certeza que deseja excluir o acessório <strong>{{ mb_strtoupper($acessorio->codigo, 'UTF-8') }}</strong>?
                                            </p>

                                            <div class="flex justify-end gap-3">
                                
                                                <button
                                                    x-on:click="$dispatch('close-modal', 'confirm-delete-{{ $acessorio->id }}')"
                                                    class="px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300">
                                                    Cancelar
                                                </button>

                                                <form method="POST" action="{{ route('acessorios.destroy', $acessorio->id) }}">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button 
                                                        type="submit"
                                                        class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
                                                        Excluir
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </x-modal>
                                </form>
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
                    Mostrando {{ $acessorios->firstItem() }}–{{ $acessorios->lastItem() }} de {{ $acessorios->total() }} resultados
                </span>
                {{ $acessorios->appends(request()->query())->links('components.pagination') }}
            </div>
        </div>
    </div>
</div>
@endsection