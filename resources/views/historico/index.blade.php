@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Histórico de Movimentações
    </h2>
@endsection

@section('slot')
<div class="py-10">
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">

        {{-- Header --}}
        <div class="flex items-end justify-between mb-7 flex-wrap gap-4">
            <div>
                <h1 class="text-2xl font-medium text-gray-900 leading-tight">Histórico</h1>
                <p class="text-sm text-gray-400 mt-0.5">Movimentações de entrada e saída</p>
            </div>
        </div>

        {{-- Toolbar --}}
        <form method="GET" action="{{ route('historico.index') }}"
              class="flex items-center gap-2.5 mb-5 flex-wrap">

            <span class="text-sm text-gray-500 font-medium whitespace-nowrap">Filtrar por</span>

            <select name="filtro"
                    class="px-3 py-1.5 border border-gray-200 rounded-lg bg-white text-gray-700 text-sm outline-none focus:border-gray-400 transition-colors">
                <option value="tudo" {{ request('filtro', 'tudo') == 'tudo' ? 'selected' : '' }}>Tudo</option>
                <option value="acessorio" {{ request('filtro') == 'acessorio' ? 'selected' : '' }}>Acessório</option>
                <option value="obra" {{ request('filtro') == 'obra' ? 'selected' : '' }}>Obra</option>
                <option value="tipo" {{ request('filtro') == 'tipo' ? 'selected' : '' }}>Tipo</option>
                <option value="cor" {{ request('filtro') == 'cor' ? 'selected' : '' }}>Cor</option>
            </select>

            <div class="relative flex-1 min-w-44 max-w-xs">
                <svg class="absolute left-2.5 top-1/2 -translate-y-1/2 w-3.5 h-3.5 text-gray-400"
                     fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 16 16">
                    <circle cx="6.5" cy="6.5" r="4.5"/>
                    <line x1="10" y1="10" x2="14" y2="14"/>
                </svg>

                <input type="text"
                       name="search"
                       value="{{ request('search') }}"
                       placeholder="Buscar..."
                       class="w-full pl-8 pr-3 py-1.5 border border-gray-200 rounded-lg text-sm outline-none focus:border-gray-400">
            </div>

            <button type="submit"
                    class="px-4 py-1.5 border border-gray-200 rounded-lg bg-gray-50 text-gray-600 text-xs font-medium hover:bg-gray-100">
                Buscar
            </button>

            @if(request('search'))
                <a href="{{ route('historico.index') }}"
                   class="px-4 py-1.5 border border-gray-200 rounded-lg bg-gray-50 text-gray-600 text-xs font-medium hover:bg-gray-100">
                    Limpar
                </a>
            @endif
        </form>

        {{-- Table --}}
        <div class="bg-white border border-gray-200 rounded-xl overflow-hidden shadow-sm">
            <table class="min-w-full divide-y divide-gray-100">

                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-5 py-3 text-left text-xs text-gray-400 uppercase">Tipo</th>
                        <th class="px-5 py-3 text-left text-xs text-gray-400 uppercase">Código</th>
                        <th class="px-5 py-3 text-left text-xs text-gray-400 uppercase">Descrição</th>
                        <th class="px-5 py-3 text-left text-xs text-gray-400 uppercase">Cor</th>
                        <th class="px-5 py-3 text-left text-xs text-gray-400 uppercase">Obra</th>
                        <th class="px-5 py-3 text-left text-xs text-gray-400 uppercase">Qtd</th>
                        <th class="px-5 py-3 text-left text-xs text-gray-400 uppercase">Data</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-50">
                    @forelse($historico as $h)
                    <tr class="hover:bg-gray-50 transition">

                        {{-- Tipo --}}
                        <td class="px-5 py-3.5">
                            @if($h->tipo === 'entrada')
                                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-md text-xs font-semibold bg-green-50 text-green-700 border border-green-100">
                                    Entrada
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-md text-xs font-semibold bg-red-50 text-red-700 border border-red-100">
                                    Saída
                                </span>
                            @endif
                        </td>

                        {{-- Código --}}
                        <td class="px-5 py-3.5 text-sm text-gray-800 uppercase">
                            {{ $h->acessorio->codigo ?? '-' }}
                        </td>

                        {{-- Descrição --}}
                        <td class="px-5 py-3.5 text-sm text-gray-600">
                            {{ $h->acessorio->descricao ?? 'Acessório removido' }}
                        </td>

                        {{-- Cor --}}
                        <td class="px-5 py-3.5 text-sm text-gray-700 uppercase">
                            {{ $h->cor ?? '-' }}
                        </td>

                        {{-- Obra --}}
                        <td class="px-5 py-3.5 text-sm text-gray-700 uppercase">
                            {{ $h->obra->nome ?? '-' }}
                        </td>

                        {{-- Quantidade --}}
                        <td class="px-5 py-3.5 text-sm text-gray-700">
                            {{ $h->quantidade }}
                        </td>

                        {{-- Data --}}
                        <td class="px-5 py-3.5 text-sm text-gray-500">
                            {{ $h->created_at->format('d/m/Y H:i') }}
                        </td>

                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-10 text-gray-400 text-sm">
                            Nenhuma movimentação encontrada
                        </td>
                    </tr>
                    @endforelse
                </tbody>

            </table>

            {{-- Pagination --}}
            <div class="flex items-center justify-between px-5 py-3 border-t border-gray-100">
                <span class="text-xs text-gray-400">
                    Mostrando {{ $historico->firstItem() ?? 0 }}–{{ $historico->lastItem() ?? 0 }} de {{ $historico->total() }}
                </span>

                {{ $historico->appends(request()->query())->links('components.pagination') }}
            </div>
        </div>

    </div>
</div>
@endsection
