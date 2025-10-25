@extends('layouts.app')

@section('slot')
<div class="container">
    <h1>Retirar Acessório</h1>

    <div class="card p-3 mb-3">
        <strong>Código:</strong> {{ $acessorio->codigo }} <br>
        <strong>Descrição:</strong> {{ $acessorio->descricao }} <br>
        <strong>Cor:</strong> {{ $acessorio->cor }} <br>
        <strong>Quantidade disponível:</strong> {{ $acessorio->quantidade }}
    </div>

    <form action="{{ route('acessorios.retirar', $acessorio->id) }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Quantidade a retirar</label>
            <input type="number" name="quantidade" class="form-control" min="1" max="{{ $acessorio->quantidade }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Selecionar Obra</label>
            <select name="obra_id" class="form-control" required>
                <option value="">Selecione...</option>
                @foreach($obras as $obra)
                    <option value="{{ $obra->id }}">{{ $obra->nome }}</option>
                @endforeach
            </select>
        </div>

        <button class="btn btn-success">Confirmar Retirada</button>
        <a href="{{ route('acessorios.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
