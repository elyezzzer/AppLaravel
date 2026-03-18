@extends('layouts.app')

@section('header')
<h2 class="font-semibold text-xl text-gray-800 leading-tight">
Editar Acessório
</h2>
@endsection

@section('slot')
<div class="py-12">
<div class="max-w-4xl mx-auto">

<div class="bg-white p-6 rounded shadow">

<form action="{{ route('acessorios.update',$acessorio->id) }}" method="POST">
@csrf
@method('PUT')

<div class="grid grid-cols-2 gap-4">

<div>
<label>Código</label>
<input type="text" name="codigo"
value="{{ old('codigo',$acessorio->codigo) }}"
class="border rounded w-full">
</div>

<div>
<label>Descrição</label>
<input type="text" name="descricao"
value="{{ old('descricao',$acessorio->descricao) }}"
class="border rounded w-full">
</div>

<div>
    <label>Estoque mínimo</label>
    <input type="number" name="estoque_minimo"
    value="{{ old('estoque_minimo',$acessorio->estoque_minimo) }}"
    class="border rounded w-full">
</div>

<div>
<label>Cor</label>
<select name="cor" class="border rounded w-full">

<option value="todas"
{{ $acessorio->cor == 'todas' ? 'selected' : '' }}>
TODAS
</option>

<option value="preto"
{{ $acessorio->cor == 'preto' ? 'selected' : '' }}>
PRETO
</option>

<option value="branco"
{{ $acessorio->cor == 'branco' ? 'selected' : '' }}>
BRANCO
</option>

<option value="natural"
{{ $acessorio->cor == 'natural' ? 'selected' : '' }}>
NATURAL
</option>

</select>
</div>

<div>
<label>Preço</label>
<input type="number" step="0.01" name="preco"
value="{{ old('preco',$acessorio->preco) }}"
class="border rounded w-full">
</div>

</div>

<div class="mt-4 flex gap-3">

<button class="bg-blue-600 text-white px-4 py-2 rounded">
Atualizar
</button>

<a href="{{ route('acessorios.index') }}"
class="bg-gray-500 text-white px-4 py-2 rounded">
Voltar
</a>

</div>

</form>

</div>
</div>
</div>
@endsection