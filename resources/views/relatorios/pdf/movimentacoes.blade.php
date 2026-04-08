<style>
    body {
        font-family: Arial, sans-serif;
        font-size: 12px;
        color: #333;
    }

    h1 {
        text-align: center;
        margin-bottom: 20px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    thead {
        background-color: #f2f2f2;
    }

    th, td {
        border: 1px solid #ccc;
        padding: 8px;
        text-align: left;
    }

    th {
        font-weight: bold;
    }

    .entrada {
        color: green;
        font-weight: bold;
    }

    .saida {
        color: red;
        font-weight: bold;
    }

    .totais {
        margin-top: 20px;
    }

    .totais p {
        margin: 5px 0;
    }
</style>

<h1>Relatório de Movimentações</h1>

<table>
    <thead>
        <tr>
            <th>Código</th>
            <th>Descrição</th>
            <th>Tipo</th>
            <th>Quantidade</th>
            <th>Data</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($dados as $item)
            <tr>
                <td>{{ $item->acessorio->codigo ?? '-' }}</td>
                <td>{{ $item->acessorio->descricao }}</td>

                <td class="{{ $item->tipo === 'entrada' ? 'entrada' : 'saida' }}">
                    {{ ucfirst($item->tipo) }}
                </td>

                <td>{{ $item->quantidade }}</td>

                <td>
                    {{ \Carbon\Carbon::parse($item->created_at)->format('d/m/Y H:i') }}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<div class="totais">
    <h3>Total de movimentações</h3>

    <p><strong>Total Entradas:</strong> {{ $totais['total_entradas'] }}</p>
    <p><strong>Total Saídas:</strong> {{ $totais['total_saidas'] }}</p>
    <p><strong>Saldo:</strong> {{ $totais['saldo'] }}</p>
</div>
