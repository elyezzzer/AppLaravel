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

    .baixo {
        color: red;
        font-weight: bold;
    }

    .ok {
        color: green;
        font-weight: bold;
    }

    .totais {
        margin-top: 20px;
    }

    .totais p {
        margin: 5px 0;
    }
</style>

<h1>Relatório de Estoque Atual</h1>

<table>
    <thead>
        <tr>
            <th>Código</th>
            <th>Descrição</th>
            <th>Cor</th>
            <th>Quantidade</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($dados as $item)
            @foreach ($item->estoque as $estoque)
                <tr>
                    <td>{{ $item->codigo }}</td>
                    <td>{{ $item->descricao }}</td>
                    <td>{{ strtoupper($estoque->cor) }}</td>
                    <td>{{ $estoque->quantidade }}</td>
                </tr>
            @endforeach
        @endforeach
    </tbody>
</table>

<div class="totais">
    <h3>Resumo do Estoque</h3>

    <p><strong>Total de Itens:</strong> {{ $dados->count() }}</p>
    <p><strong>Quantidade Total em Estoque:</strong> {{ $dados->flatMap->estoque->sum('quantidade') }}</p>
</div>
