@extends('layouts.app')

@section('slot')
<div class="container">
    <h1>Criar Nova Obra</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('obras.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nome" class="form-label">Nome da Obra</label>
            <input type="text" name="nome" id="nome" class="form-control" value="{{ old('nome') }}" required>
        </div>

        <button type="submit" class="btn btn-success">Salvar</button>
        <a href="{{ route('obras.index') }}" class="btn btn-secondary">Voltar</a>
    </form>
</div>
@endsection