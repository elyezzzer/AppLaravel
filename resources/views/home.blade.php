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

@endsection