@extends('layouts.app')

@section('header')
<h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
@endsection

@section('slot')
<div class="py-6">
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

<div class="grid grid-cols-2 md:grid-cols-5 gap-4">
    <div class="bg-white p-3 rounded shadow text-center">
        <p class="text-xs text-gray-400">ITEMS EM ESTOQUE</p>
        <p class="text-lg font-bold text-gray-700">{{ $totalEstoque }}</p>
    </div>
    <div class="bg-white p-3 rounded shadow text-center">
        <p class="text-xs text-gray-400">VALOR TOTAL DO ESTOQUE</p>
        <p class="text-lg font-bold text-green-600">R$ {{ number_format($valorTotal,2,',','.') }}</p>
    </div>
    <div class="bg-white p-3 rounded shadow text-center">
        <p class="text-xs text-gray-400">RETIRADAS HOJE</p>
        <p class="text-lg font-bold text-red-500">{{ $retiradasHoje }}</p>
    </div>
    <div class="bg-white p-3 rounded shadow text-center">
        <p class="text-xs text-gray-400">ACESSÓRIOS CADASTRADOS</p>
        <p class="text-lg font-bold text-gray-700">{{ $totalAcessorios }}</p>
    </div>
    <div class="bg-white p-3 rounded shadow text-center">
        <p class="text-xs text-gray-400">OBRAS CADASTRADAS</p>
        <p class="text-lg font-bold text-gray-700">{{ $totalObras }}</p>
    </div>
</div>

<div class="bg-white p-4 rounded shadow mb-4">
    <h3 class="text-sm font-semibold text-gray-600 mb-2">Filtrar Movimentações</h3>
    <form method="GET" action="{{ route('home') }}" class="flex flex-col md:flex-row gap-2 items-end">
        <div class="flex flex-col">
            <label class="text-xs text-gray-500">Data Inicial</label>
            <input type="date" name="data_inicial" class="border rounded p-1 text-sm w-36" value="{{ $dataInicial }}">
        </div>
        <div class="flex flex-col">
            <label class="text-xs text-gray-500">Data Final</label>
            <input type="date" name="data_final" class="border rounded p-1 text-sm w-36" value="{{ $dataFinal }}">
        </div>
        <div class="flex flex-col">
            <label class="text-xs text-gray-500">Tipo</label>
            <select name="tipo" class="border rounded p-1 text-sm w-36">
                <option value="ambos" {{ $tipo=='ambos'?'selected':'' }}>Todos</option>
                <option value="entrada" {{ $tipo=='entrada'?'selected':'' }}>Entrada</option>
                <option value="saida" {{ $tipo=='saida'?'selected':'' }}>Saída</option>
            </select>
        </div>
        <button class="bg-blue-600 text-white p-2 rounded text-sm h-10">Filtrar</button>
    </form>
</div>

<div class="bg-white p-4 rounded shadow">
    <h3 class="text-sm font-semibold text-gray-600 mb-2">Movimentações</h3>
    <div style="height:220px">
        <canvas id="grafico"></canvas>
    </div>
</div>

</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
new Chart(document.getElementById('grafico'), {
    type:'bar',
    data:{
        labels:@json($grafico->pluck('data')),
        datasets:[
            {label:'Entradas', data:@json($grafico->pluck('entradas')), backgroundColor:'#22c55e'},
            {label:'Saídas', data:@json($grafico->pluck('saidas')), backgroundColor:'#ef4444'}
        ]
    },
    options:{
        responsive:true,
        maintainAspectRatio:false
    }
});
</script>
@endsection