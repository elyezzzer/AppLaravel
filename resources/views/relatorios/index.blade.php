@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Relatórios') }}
    </h2>
@endsection

@section('slot')

<div class="py-12">
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">


        {{-- GERAR RELATÓRIO --}}
        <div class="mb-8 bg-white shadow-sm sm:rounded-lg p-6">

            <div class="mb-4">
                <span class="text-xl font-semibold text-gray-800">
                    Gerar novo relatório
                </span>
            </div>

            <form method="GET" action="{{ route('relatorios.index') }}" class="grid grid-cols-1 md:grid-cols-5 gap-4 items-end">

                <div>
                    <label class="text-sm text-gray-700 font-semibold">
                        Data inicial
                    </label>

                    <input
                        type="date"
                        name="data_inicio"
                        value="{{ request('data_inicio') }}"
                        class="border rounded px-3 py-2 w-full"
                    >
                </div>

                <div>
                    <label class="text-sm text-gray-700 font-semibold">
                        Data final
                    </label>

                    <input
                        type="date"
                        name="data_fim"
                        value="{{ request('data_fim') }}"
                        class="border rounded px-3 py-2 w-full"
                    >
                </div>

                <div>
                    <label class="text-sm text-gray-700 font-semibold">
                        Tipo
                    </label>

                    <select name="tipo" class="border rounded px-3 py-2 w-full">

                        <option value="">
                            Todos
                        </option>

                        <option value="entrada" {{ request('tipo') == 'entrada' ? 'selected' : '' }}>
                            Entrada
                        </option>

                        <option value="saida" {{ request('tipo') == 'saida' ? 'selected' : '' }}>
                            Saída
                        </option>

                    </select>
                </div>

                <div>
                    <label class="text-sm text-gray-700 font-semibold">
                        Código
                    </label>

                    <input
                        type="text"
                        name="codigo"
                        value="{{ request('codigo') }}"
                        placeholder="Código do acessório"
                        class="border rounded px-3 py-2 w-full"
                    >
                </div>

                <div>
                    <button
                        type="submit"
                        class="w-full px-4 py-2 bg-gray-800 text-white rounded hover:bg-gray-900 text-xs uppercase"
                    >
                        Gerar relatório
                    </button>
                </div>

            </form>

        </div>


        {{-- ÚLTIMO RELATÓRIO --}}
        @if(isset($ultimoRelatorio))

        <div class="mb-8 bg-white shadow-sm sm:rounded-lg p-6">

            <div class="flex justify-between items-center mb-4">

                <span class="text-xl font-semibold text-gray-800">
                    Último relatório gerado
                </span>

                <a
                    href="{{ route('relatorios.download', $ultimoRelatorio->id) }}"
                    class="px-4 py-2 bg-red-600 text-white text-xs rounded hover:bg-red-700"
                >
                    BAIXAR PDF
                </a>

            </div>

            <div class="text-sm text-gray-700">

                <p>
                    <strong>Gerado em:</strong>
                    {{ $ultimoRelatorio->created_at->format('d/m/Y H:i') }}
                </p>

                <p>
                    <strong>Período:</strong>
                    {{ $ultimoRelatorio->data_inicio }} até {{ $ultimoRelatorio->data_fim }}
                </p>

            </div>

        </div>

        @endif


        {{-- RELATÓRIOS ANTERIORES --}}
        @if(isset($relatoriosAnteriores) && $relatoriosAnteriores->count())

        <div class="bg-white shadow-sm sm:rounded-lg">

            <div class="p-6">
                <span class="text-xl font-semibold text-gray-800">
                    Relatórios anteriores
                </span>
            </div>

            <table class="min-w-full divide-y divide-gray-200">

                <thead class="bg-gray-50">

                    <tr>

                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                            Data
                        </th>

                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                            Período
                        </th>

                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                            Tipo
                        </th>

                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                            Ações
                        </th>

                    </tr>

                </thead>

                <tbody class="bg-white divide-y divide-gray-200">

                    @foreach($relatoriosAnteriores as $relatorio)

                    <tr>

                        <td class="px-6 py-4 text-sm text-gray-700">
                            {{ $relatorio->created_at->format('d/m/Y H:i') }}
                        </td>

                        <td class="px-6 py-4 text-sm text-gray-700">
                            {{ $relatorio->data_inicio }} até {{ $relatorio->data_fim }}
                        </td>

                        <td class="px-6 py-4 text-sm text-gray-700">
                            {{ ucfirst($relatorio->tipo ?? 'Todos') }}
                        </td>

                        <td class="px-6 py-4 text-sm">

                            <a
                                href="{{ route('relatorios.download', $relatorio->id) }}"
                                class="px-3 py-1 bg-blue-600 text-white text-xs rounded hover:bg-blue-700"
                            >
                                Baixar PDF
                            </a>

                        </td>

                    </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

        @endif


    </div>
</div>

@endsection
