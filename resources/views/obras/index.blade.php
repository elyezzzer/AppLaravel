@extends('layouts.app')

@section('slot')
<div class="container">
    <h1>Lista de Obras</h1>

    <a href="{{ route('obras.create') }}" class="btn btn-primary mb-3">Nova Obra</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($obras as $obra)
                <tr>
                    <td>{{ $obra->id }}</td>
                    <td>{{ $obra->nome }}</td>
                    <td>
                        <a href="{{ route('obras.edit', $obra->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('obras.destroy', $obra->id) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection