@extends('layouts.app')

@section('slot')
<div class="container">
    <h1>Lista de Acessórios</h1>

    <a href="{{ route('acessorios.create') }}" class="btn btn-primary mb-3">NOVO ACESSÓRIO</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th> 
                <th>CÓDIGO</th>
                <th>DESCRIÇÃO</th>
                <th>QUANTIDADE</th>
                <th>COR</th>
                <th>PREÇO</th>
                <th>AÇÕES</th>
            </tr>
        </thead>
        <tbody>
            @foreach($acessorios as $acessorio)
                <tr>
                    <td>{{ $acessorio->id }}</td>
                    <td>{{ $acessorio->codigo }}</td>
                    <td>{{ $acessorio->descricao }}</td>
                    <td>{{ $acessorio->quantidade }}</td>
                    <td>{{ $acessorio->cor }}</td>
                    <td>R$ {{ number_format($acessorio->preco, 2, ',', '.') }}</td>
                    <td>

                        <a href="{{ route('acessorios.retirar', $acessorio->id) }}" class="btn btn-sm btn-info">RETIRAR</a>
    
                        <a href="{{ route('acessorios.edit', $acessorio->id) }}" class="btn btn-sm btn-warning">EDITAR</a>

                        <form action="{{ route('acessorios.destroy', $acessorio->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">
                                EXCLUIR
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection