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
    <form id="filtroGrafico" class="flex flex-col md:flex-row gap-2 items-end">
        <div class="flex flex-col">
            <label class="text-xs text-gray-500">Data Inicial</label>
            <input type="date" name="data_inicial" class="border rounded p-1 text-sm w-36"
                   value="{{ request('data_inicial', date('Y-m-d')) }}">
        </div>
        <div class="flex flex-col">
            <label class="text-xs text-gray-500">Data Final</label>
            <input type="date" name="data_final" class="border rounded p-1 text-sm w-36"
                   value="{{ request('data_final', date('Y-m-d')) }}">
        </div>
        <div class="flex flex-col">
            <label class="text-xs text-gray-500">Tipo</label>
            <select name="tipo" class="border rounded p-1 text-sm w-36">
                <option value="ambos" {{ request('tipo')=='ambos'?'selected':'' }}>Todos</option>
                <option value="entrada" {{ request('tipo')=='entrada'?'selected':'' }}>Entrada</option>
                <option value="saida" {{ request('tipo')=='saida'?'selected':'' }}>Saída</option>
            </select>
        </div>
        <button type="submit" class="bg-blue-600 text-white p-2 rounded text-sm h-10">Filtrar</button>
    </form>
</div>

<div class="bg-white p-4 rounded shadow">
    <h3 class="text-sm font-semibold text-gray-600 mb-2">Movimentações</h3>
    <div style="height:200px">
        <canvas id="grafico"></canvas>
    </div>
</div>

</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx = document.getElementById('grafico').getContext('2d');
let chart = new Chart(ctx, {
    type:'bar',
    data:{
        labels:@json($grafico->pluck('data')),
        datasets:[
            {label:'Entradas', data:@json($grafico->pluck('entradas')), backgroundColor:'#22c55e'},
            {label:'Saídas', data:@json($grafico->pluck('saidas')), backgroundColor:'#ef4444'}
        ]
    },
    options:{responsive:true, maintainAspectRatio:false}
});

document.getElementById('filtroGrafico').addEventListener('submit', function(e){
    e.preventDefault();
    const form = new FormData(this);
    const params = new URLSearchParams(form).toString();

    fetch(`/grafico-filtro?${params}`)
        .then(res => res.json())
        .then(res => {
            const data = res.dados;
            chart.data.labels = data.map(d=>d.data);
            chart.data.datasets = [];
            if(res.tipo=='entrada') chart.data.datasets.push({label:'Entradas', data:data.map(d=>d.entradas), backgroundColor:'#22c55e'});
            else if(res.tipo=='saida') chart.data.datasets.push({label:'Saídas', data:data.map(d=>d.saidas), backgroundColor:'#ef4444'});
            else{
                chart.data.datasets.push({label:'Entradas', data:data.map(d=>d.entradas), backgroundColor:'#22c55e'});
                chart.data.datasets.push({label:'Saídas', data:data.map(d=>d.saidas), backgroundColor:'#ef4444'});
            }
            chart.update();
        });
});
</script>
@endsection