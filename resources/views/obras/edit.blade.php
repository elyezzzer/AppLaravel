@extends('layouts.app')

@section('slot')
<div class="container">
    <h1>Editar Obra</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('obras.update', $obra->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nome" class="form-label">Nome da Obra</label>
            <input type="text" name="nome" id="nome" class="form-control" value="{{ old('nome', $obra->nome) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Atualizar</button>
        <a href="{{ route('obras.index') }}" class="btn btn-secondary">Voltar</a>
    </form>
</div>
@endsection