@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Relatórios
    </h2>
@endsection

@section('slot')
<div class="py-10">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        {{-- Header --}}
        <div class="flex items-end justify-between mb-7 flex-wrap gap-4">
            <div>
                <h1 class="text-2xl font-medium text-gray-900 leading-tight">
                    Relatórios
                </h1>
                <p class="text-sm text-gray-400 mt-0.5">
                    Gere e acompanhe relatórios do sistema
                </p>
            </div>

            <a href="{{ route('relatorios.create') }}"
               class="inline-flex items-center gap-1.5 px-4 py-2 bg-[#1565ff] text-white text-xs font-medium rounded-lg hover:bg-[#0f4ed1] transition-colors">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" viewBox="0 0 16 16">
                    <line x1="8" y1="2" x2="8" y2="14"/>
                    <line x1="2" y1="8" x2="14" y2="8"/>
                </svg>
                Gerar relatório
            </a>
        </div>

        {{-- Cards métricas --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4 mb-6">

            {{-- Relatórios --}}
            <div class="bg-white border border-gray-200 rounded-2xl px-5 py-4 shadow-sm">
                <div class="flex items-center gap-3">

                    <div class="w-11 h-11 rounded-xl bg-blue-50 flex items-center justify-center text-blue-600 shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="2"
                            stroke="currentColor"
                            class="w-5 h-5">
                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5A3.375 3.375 0 0 0 10.125 2.25H6.75A2.25 2.25 0 0 0 4.5 4.5v15A2.25 2.25 0 0 0 6.75 21.75h10.5A2.25 2.25 0 0 0 19.5 19.5V14.25Z" />
                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M13.5 3v4.125c0 .621.504 1.125 1.125 1.125H18" />
                        </svg>
                    </div>

                    <div>
                        <h3 class="text-2xl font-bold text-gray-900">
                            {{ $relatorios->count() }}
                        </h3>

                        <p class="text-xs text-gray-500 mt-0.5">
                            Relatórios disponíveis
                        </p>
                    </div>

                </div>
            </div>

           {{-- Relatórios este mês --}}
            <div class="bg-white border border-gray-200 rounded-2xl px-5 py-4 shadow-sm">
                <div class="flex items-center gap-3">

                    <div class="w-11 h-11 rounded-xl bg-green-50 flex items-center justify-center text-green-600 shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="2"
                            stroke="currentColor"
                            class="w-5 h-5">
                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2Z" />
                        </svg>
                    </div>

                    <div>
                        <h3 class="text-2xl font-bold text-gray-900">
                            {{ \App\Models\Relatorio::withTrashed()
                                ->where('created_at', '>=', now()->startOfMonth())
                                ->count() }}
                        </h3>

                        <p class="text-xs text-gray-500 mt-0.5">
                            Este mês
                        </p>
                    </div>

                </div>
            </div>

            {{-- Tipos --}}
            <div class="bg-white border border-gray-200 rounded-2xl px-5 py-4 shadow-sm">
                <div class="flex items-center gap-3">

                    <div class="w-11 h-11 rounded-xl bg-purple-50 flex items-center justify-center text-purple-600 shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="2"
                            stroke="currentColor"
                            class="w-5 h-5">
                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M8.25 6.75h7.5M8.25 12h7.5m-7.5 5.25h7.5" />
                        </svg>
                    </div>

                    <div>
                        <h3 class="text-2xl font-bold text-gray-900">
                            5
                        </h3>


                        <p class="text-xs text-gray-500 mt-0.5">
                            Tipos disponíveis
                        </p>
                    </div>

                </div>
            </div>

            {{-- Último relatório --}}
            <div class="bg-white border border-gray-200 rounded-2xl px-5 py-4 shadow-sm">
                <div class="flex items-center gap-3">

                    <div class="w-11 h-11 rounded-xl bg-orange-50 flex items-center justify-center text-orange-500 shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="2"
                            stroke="currentColor"
                            class="w-5 h-5">
                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M12 6v6l4 2" />
                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                    </div>

                    <div>
                        <h3 class="text-sm font-semibold text-gray-900">
                            {{ $relatorios->first()?->created_at->format('d/m/Y') ?? '-' }}
                        </h3>

                        <p class="text-xs text-gray-500 mt-0.5">
                            Última geração
                        </p>
                    </div>
                </div>
            </div>
        </div>


        {{-- Lista --}}
        <div class="bg-white border border-gray-200 rounded-xl overflow-hidden shadow-sm">

            <div class="px-5 py-4 border-b border-gray-100">
                <span class="text-lg font-medium text-gray-800">
                    Relatórios gerados
                </span>
            </div>

            @if($relatorios->count())

            <table class="min-w-full divide-y divide-gray-100">

                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-5 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-widest">
                            Data
                        </th>
                        <th class="px-5 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-widest">
                            Tipo
                        </th>
                        <th class="px-5 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-widest">
                            Período
                        </th>
                        <th class="px-5 py-3 text-center text-xs font-medium text-gray-400 uppercase tracking-widest">
                            Ações
                        </th>
                    </tr>
                </thead>

                <tbody class="bg-white divide-y divide-gray-50">
                    @foreach($relatorios as $relatorio)
                        <tr class="hover:bg-gray-50 transition-colors">

                            <td class="px-5 py-3.5 text-sm text-gray-700">
                                {{ $relatorio->created_at->format('d/m/Y H:i') }}
                            </td>

                            <td class="px-5 py-3.5 text-sm text-gray-700 uppercase font-medium">
                                {{ $relatorio->tipo ?? 'Todos' }}
                            </td>

                            <td class="px-5 py-3.5 text-sm text-gray-700">
                                @if($relatorio->data_inicio && $relatorio->data_fim)
                                    {{ \Carbon\Carbon::parse($relatorio->data_inicio)->format('d/m/Y') }}
                                    até
                                    {{ \Carbon\Carbon::parse($relatorio->data_fim)->format('d/m/Y') }}
                                @else
                                    -
                                @endif
                            </td>

                            <td class="px-5 py-3.5">
                                <div class="flex items-center justify-center gap-2">

                                    {{-- Visualizar --}}
                                    <x-tooltip text="Visualizar">
                                        <a href="{{ route('relatorios.view', $relatorio->id) }}"
                                        target="_blank"
                                        class="p-2 bg-gray-100 text-gray-600 rounded-lg
                                                border border-gray-200
                                                hover:bg-gray-900 hover:text-white hover:border-gray-900
                                                transition">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                            </svg>
                                        </a>
                                    </x-tooltip>

                                    {{-- Download --}}
                                    <x-tooltip text="Download">
                                        <a href="{{ route('relatorios.download', $relatorio->id) }}"
                                        class="p-2 bg-blue-50 text-blue-600 rounded-lg
                                                border border-blue-100
                                                hover:bg-blue-600 hover:text-white hover:border-blue-600
                                                transition">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                                            </svg>
                                        </a>
                                    </x-tooltip>

                                    {{-- Deletar --}} 
                                    <x-tooltip text="Excluir">
                                
                                        @csrf
                                        @method('DELETE')

                                        <button type="button"
                                                x-on:click="$dispatch('open-modal', 'confirm-delete-{{ $relatorio->id }}')"
                                                class="p-2 bg-red-50 text-red-600 rounded-lg
                                                    border border-red-100
                                                    hover:bg-red-600 hover:text-white hover:border-red-600
                                                    transition">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="size-5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                            </svg>
                                        </button>

                                        {{-- Modal de confirmação --}}
                                        <x-modal name="confirm-delete-{{ $relatorio->id }}">
                                            <div class="p-6">

                                                <h2 class="text-lg font-semibold text-gray-800 mb-4">
                                                    Confirmar exclusão
                                                </h2>

                                                <p class="text-gray-600 mb-6">
                                                    Tem certeza que deseja excluir o relatório?
                                                </p>

                                                <div class="flex justify-end gap-3">
                                    
                                                    <button
                                                        x-on:click="$dispatch('close-modal', 'confirm-delete-{{ $relatorio->id }}')"
                                                        class="px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300">
                                                        Cancelar
                                                    </button>

                                                    <form method="POST" action="{{ route('relatorios.destroy', $relatorio->id) }}">
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
                                    </x-tooltip>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            @else
                <div class="px-5 py-6 text-sm text-gray-400">
                    Nenhum relatório gerado ainda.
                </div>
            @endif

            {{-- Paginação --}}
            <div class="px-5 py-4 bg-gray-50 border-t border-gray-100 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                <span class="text-sm text-gray-500">
                    Mostrando {{ $relatorios->firstItem() ?? 0 }}–{{ $relatorios->lastItem() ?? 0 }} de {{ $relatorios->total() }} resultados
                </span>

                {{ $relatorios->appends(request()->query())->links('components.pagination') }}
            </div>
        </div>
    </div>
</div>
@endsection
