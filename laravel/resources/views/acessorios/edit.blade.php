@extends('layouts.app')

@section('slot')
<div class="container">
    <h1>Editar Acessório</h1>

    <form action="{{ route('acessorios.update', $acessorio->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Código</label>
            <input type="text" name="codigo" class="form-control" value="{{ old('codigo', $acessorio->codigo) }}">
        </div>

        <div class="mb-3">
            <label>Descrição</label>
            <input type="text" name="descricao" class="form-control" value="{{ old('descricao', $acessorio->descricao) }}">
        </div>

        <div class="mb-3">
            <label>Quantidade</label>
            <input type="number" name="quantidade" class="form-control" value="{{ old('quantidade', $acessorio->quantidade) }}">
        </div>

        <div class="mb-3">
            <label>Cor</label>
            <input type="text" name="cor" class="form-control" value="{{ old('cor', $acessorio->cor) }}">
        </div>

        <div class="mb-3">
            <label>Preço</label>
            <input type="number" step="0.01" name="preco" class="form-control" value="{{ old('preco', $acessorio->preco) }}">
        </div>

        <button type="submit" class="btn btn-success">ATUALIZAR</button>
        <a href="{{ route('acessorios.index') }}" class="btn btn-secondary">CANCELAR</a>
    </form>
</div>
@endsection