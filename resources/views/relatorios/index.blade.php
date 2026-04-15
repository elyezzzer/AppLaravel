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
               class="inline-flex items-center gap-1.5 px-4 py-2 bg-gray-900 text-white text-xs font-medium rounded-lg hover:bg-gray-700 transition-colors">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" viewBox="0 0 16 16">
                    <line x1="8" y1="2" x2="8" y2="14"/>
                    <line x1="2" y1="8" x2="14" y2="8"/>
                </svg>
                Gerar relatório
            </a>
        </div>

        {{-- Último relatório --}}
        @if($ultimoRelatorio)
        <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm mb-6">

            <div class="flex items-center justify-between mb-4">
                <span class="text-lg font-medium text-gray-800">
                    Último relatório gerado
                </span>

                <div class="flex gap-2">
                    {{-- Visualizar --}}
                    <a href="{{ route('relatorios.view', $ultimoRelatorio->id) }}"
                       target="_blank"
                       class="px-3 py-1.5 bg-gray-800 text-white text-xs rounded-lg hover:bg-gray-900 transition">
                        Visualizar
                    </a>

                    {{-- Download --}}
                    <a href="{{ route('relatorios.download', $ultimoRelatorio->id) }}"
                       class="px-3 py-1.5 bg-red-600 text-white text-xs rounded-lg hover:bg-red-700 transition">
                        Baixar PDF
                    </a>
                </div>
            </div>

            <div class="text-sm text-gray-600 space-y-1">
                <p>
                    <span class="font-medium text-gray-800">Gerado em:</span>
                    {{ $ultimoRelatorio->created_at->format('d/m/Y H:i') }}
                </p>

                <p>
                    <span class="font-medium text-gray-800">Tipo:</span>
                    {{ ucfirst($ultimoRelatorio->tipo ?? 'Todos') }}
                </p>

                <p>
                    <span class="font-medium text-gray-800">Período:</span>
                    @if($ultimoRelatorio->data_inicio && $ultimoRelatorio->data_fim)
                        {{ \Carbon\Carbon::parse($ultimoRelatorio->data_inicio)->format('d/m/Y') }}
                        até
                        {{ \Carbon\Carbon::parse($ultimoRelatorio->data_fim)->format('d/m/Y') }}
                    @else
                        -
                    @endif
                </p>
            </div>

        </div>
        @endif

        {{-- Lista --}}
        <div class="bg-white border border-gray-200 rounded-xl overflow-hidden shadow-sm">

            <div class="px-5 py-4 border-b border-gray-100">
                <span class="text-lg font-medium text-gray-800">
                    Relatórios anteriores
                </span>
            </div>

            @if($relatoriosAnteriores->count())

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
                    @foreach($relatoriosAnteriores as $relatorio)
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

                                    {{-- Delete --}}
                                    <x-tooltip text="Excluir">
                                        <form action="{{ route('relatorios.destroy', $relatorio->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('Tem certeza que deseja deletar este relatório?')">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
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
                                        </form>
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

        </div>

    </div>
</div>
@endsection
