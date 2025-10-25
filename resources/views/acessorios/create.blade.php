@extends('layouts.app')

@section('slot')
<div class="container">
    <h1>Novo Acessório</h1>

    <form action="{{ route('acessorios.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Código</label>
            <input type="text" name="codigo" class="form-control" value="{{ old('codigo') }}">
            @error('codigo') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label>Descrição</label>
            <input type="text" name="descricao" class="form-control" value="{{ old('descricao') }}">
        </div>

        <div class="mb-3">
            <label>Quantidade</label>
            <input type="number" name="quantidade" class="form-control" value="{{ old('quantidade') }}">
        </div>

        <div class="mb-3">
            <label>Cor</label>
            <input type="text" name="cor" class="form-control" value="{{ old('cor') }}">
        </div>

        <div class="mb-3">
            <label>Preço</label>
            <input type="number" step="0.01" name="preco" class="form-control" value="{{ old('preco') }}">
        </div>

        <button type="submit" class="btn btn-success">SALVAR</button>
        <a href="{{ route('acessorios.index') }}" class="btn btn-secondary">VOLTAR</a>
    </form>
</div>
@endsection