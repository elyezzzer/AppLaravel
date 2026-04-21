@extends('layouts.app')

@section('header')
<h2 class="font-semibold text-xl text-gray-800 leading-tight">
    Dashboard
</h2>
@endsection

@section('slot')
<div class="py-10">
<div class="max-w-6xl mx-auto sm:px-6 lg:px-8">

    {{-- HEADER --}}
    <div class="mb-7">
        <h1 class="text-2xl font-medium text-gray-900">Dashboard</h1>
        <p class="text-sm text-gray-400">Visão geral do sistema</p>
    </div>

    {{-- CARDS --}}
    <div class="grid grid-cols-2 md:grid-cols-5 gap-4 mb-4">
        <div class="bg-white border rounded-xl p-4 text-center">
            <p class="text-xs text-gray-400">Valor total do estoque</p>
            <p class="text-xl font-semibold text-green-600">
                R$ {{ number_format($valorTotal,2,',','.') }}
            </p>
        </div>

        <div class="bg-white border rounded-xl p-4 text-center">
            <p class="text-xs text-gray-400">Acessórios Cadastrados</p>
            <p class="text-xl font-semibold">{{ $totalAcessorios }}</p>
        </div>

        <div class="bg-white border rounded-xl p-4 text-center">
            <p class="text-xs text-gray-400">Itens em Estoque</p>
            <p class="text-xl font-semibold">{{ $totalEstoque }}</p>
        </div>

        <div class="bg-white border rounded-xl p-4 text-center">
            <p class="text-xs text-gray-400">Entradas Hoje</p>
            <p class="text-xl font-semibold text-green-600">
                {{ $entradasHoje }}
            </p>
        </div>

        <div class="bg-white border rounded-xl p-4 text-center">
            <p class="text-xs text-gray-400">Saídas Hoje</p>
            <p class="text-xl font-semibold text-red-500">{{ $retiradasHoje }}</p>
        </div>
    </div>

    {{-- GRID PRINCIPAL --}}
    <div class="grid md:grid-cols-3 gap-6">

        {{-- GRAFICO --}}
        <div class="md:col-span-2 bg-white border rounded-xl p-5">
            <h3 class="text-sm text-gray-500 mb-3">Movimentações (últimos 5 dias)</h3>
            <canvas id="grafico"></canvas>
        </div>

        {{-- ESTOQUE BAIXO CARD --}}
        <div class="bg-white border rounded-xl p-5">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-sm font-medium text-red-500">Estoque Baixo</h3>

                <span class="text-xs text-red-400 bg-red-50 px-2 py-1 rounded-md">
                    {{ $estoqueBaixo->count() }} itens
                </span>
            </div>

            <div class="space-y-3 max-h-64 overflow-auto pr-1">

                @forelse($estoqueBaixo as $item)
                    <div class="border border-gray-100 rounded-lg p-3 hover:bg-gray-50 transition-colors">

                        {{-- código --}}
                        <div class="flex items-center justify-between mb-1">
                            <span class="text-sm font-semibold text-gray-700 uppercase tracking-wide">
                                {{ strtoupper($item->acessorio->codigo ?? '-') }}
                            </span>
                        </div>

                        {{-- descrição --}}
                        <p class="text-sm text-gray-500 leading-tight mb-2">
                            {{ $item->acessorio->descricao ?? '-' }}
                        </p>

                        {{-- quantidade --}}
                        <div class="flex justify-between items-center">
                            <span class="text-xs text-gray-400">Quantidade</span>

                            <span class="text-sm font-bold">
                                {{ $item->quantidade }}
                            </span>
                        </div>

                    </div>
                @empty
                    <div class="text-center py-6">
                        <p class="text-sm text-gray-400">Nenhum item crítico</p>
                    </div>
                @endforelse

            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
<script>
    new Chart(document.getElementById('grafico'), {
        type: 'bar',
        data: {
            labels: @json($graficoLabels),
            datasets: [
                {
                    label: 'Entradas',
                    data: @json($graficoEntradas),
                    backgroundColor: 'rgba(37, 99, 235, 0.8)',
                    borderRadius: 6
                },
                {
                    label: 'Saídas',
                    data: @json($graficoSaidas),
                    backgroundColor: 'rgba(239, 68, 68, 0.8)',
                    borderRadius: 6
                }
            ]
        },

        plugins: [ChartDataLabels],

        options: {
            plugins: {
                datalabels: {
                    color: '#374151',
                    anchor: 'end',
                    align: 'top',
                    font: {
                        weight: 'bold',
                        size: 11
                    }
                },
                legend: {
                    labels: {
                        color: '#6B7280'
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: { display: true }
                },
                x: {
                    grid: { display: false }
                }
            }
        }
    });
</script>

@endsection
