@extends('layouts.app')

@section('slot')
<div class="container">
    <h1>Histórico de Retiradas</h1>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ACESSÓRIO</th>
                <th>OBRA</th>
                <th>QUANTIDADE</th>
                <th>DATA</th>
            </tr>
        </thead>
        <tbody>
            @foreach($historico as $h)
                <tr>
                    <td>{{ $h->acessorio->codigo }} - {{ $h->acessorio->descricao }}</td>
                    <td>{{ $h->obra->nome }}</td>
                    <td>{{ $h->quantidade }}</td>
                    <td>{{ $h->created_at->format('d/m/Y H:i') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection