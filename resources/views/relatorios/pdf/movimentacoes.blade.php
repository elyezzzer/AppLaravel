<h1>Relatório de Movimentações</h1>

<table border="1" width="100%">
    <thead>
        <tr>
            <th>Data</th>
            <th>Acessório</th>
            <th>Tipo</th>
            <th>Quantidade</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($dados as $item)
            <tr>
                <td>{{ $item->created_at }}</td>
                <td>{{ $item->acessorio->descricao }}</td>
                <td>{{ $item->tipo }}</td>
                <td>{{ $item->quantidade }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<br><br>

<h3>Totais</h3>

<p>Total Entradas: {{ $totais['entradas'] }}</p>
<p>Total Saídas: {{ $totais['saidas'] }}</p>
<p>Saldo: {{ $totais['saldo'] }}</p>
