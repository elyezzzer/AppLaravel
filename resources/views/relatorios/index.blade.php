@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Relatórios
    </h2>
@endsection

@section('slot')

<div class="py-12">
<div class="max-w-6xl mx-auto sm:px-6 lg:px-8">

    {{-- BOTÃO GERAR --}}
    <div class="mb-6">
        <a href="{{ route('relatorios.create') }}"
           class="px-4 py-2 bg-gray-800 text-white rounded text-xs uppercase hover:bg-gray-900">
            Gerar novo relatório
        </a>
    </div>

    {{-- ÚLTIMO RELATÓRIO --}}
    @if($ultimoRelatorio)
    <div class="mb-8 bg-white shadow-sm sm:rounded-lg p-6">

        <div class="flex justify-between items-center mb-4">
            <span class="text-xl font-semibold text-gray-800">
                Último relatório gerado
            </span>

            <a href="{{ route('relatorios.download', $ultimoRelatorio->id) }}"
               class="px-4 py-2 bg-red-600 text-white text-xs rounded hover:bg-red-700">
                Baixar PDF
            </a>
        </div>

        <div class="text-sm text-gray-700">
            <p>
                <strong>Gerado em:</strong>
                {{ $ultimoRelatorio->created_at->format('d/m/Y H:i') }}
            </p>

            <p>
                <strong>Tipo:</strong>
                {{ ucfirst($ultimoRelatorio->tipo ?? 'Todos') }}
            </p>

            @if($ultimoRelatorio->data_inicio && $ultimoRelatorio->data_fim)
            <p>
                <strong>Período:</strong>
                {{ $ultimoRelatorio->data_inicio }} até {{ $ultimoRelatorio->data_fim }}
            </p>
            @endif
        </div>

    </div>
    @endif

    {{-- RELATÓRIOS ANTERIORES --}}
    <div class="bg-white shadow-sm sm:rounded-lg">

        <div class="p-6">
            <span class="text-xl font-semibold text-gray-800">
                Relatórios anteriores
            </span>
        </div>

        @if($relatoriosAnteriores->count())

        <table class="min-w-full divide-y divide-gray-200">

            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                        Data
                    </th>

                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                        Tipo
                    </th>

                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                        Período
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
                        {{ ucfirst($relatorio->tipo ?? 'Todos') }}
                    </td>

                    <td class="px-6 py-4 text-sm text-gray-700">
                        @if($relatorio->data_inicio && $relatorio->data_fim)
                            {{ $relatorio->data_inicio }} até {{ $relatorio->data_fim }}
                        @else
                            -
                        @endif
                    </td>

                    <td class="px-6 py-4 text-sm flex items-center gap-2">

                    <a href="{{ route('relatorios.download', $relatorio->id) }}"
                    class="px-3 py-1 bg-blue-600 text-white text-xs rounded hover:bg-blue-700">
                        Baixar PDF
                    </a>

                    <form action="{{ route('relatorios.destroy', $relatorio->id) }}"
                        method="POST"
                        onsubmit="return confirm('Tem certeza que deseja deletar este relatório?')"
                        class="inline">
                        @csrf
                        @method('DELETE')

                        <button type="submit"
                                class="px-3 py-1 bg-red-600 text-white text-xs rounded hover:bg-red-700">
                            Deletar
                        </button>
                    </form>
                </td>

                </tr>
                @endforeach

            </tbody>

        </table>

        @else

        <div class="p-6 text-gray-600">
            Nenhum relatório gerado ainda.
        </div>

        @endif

    </div>

</div>
</div>

@endsection
