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

    .obra-info {
        margin-bottom: 20px;
    }

    .obra-info p {
        margin: 4px 0;
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

    .totais {
        margin-top: 20px;
    }

    .totais p {
        margin: 5px 0;
    }
</style>

<h1>Relatório de Itens Utilizados em Obras</h1>

<div class="obra-info">
    @if(isset($obra))
        <p>
            <strong>Obra:</strong>
            {{ mb_strtoupper($obra->nome, 'UTF-8') }}
        </p>

        @if($obra->cliente)
            <p>
                <strong>Cliente:</strong>
                {{ strtoupper($obra->cliente) }}
            </p>
        @endif
    @endif
</div>

<table>
    <thead>
        <tr>
            <th>Código</th>
            <th>Descrição</th>
            <th>Cor</th>
            <th>Quantidade Utilizada</th>
            <th>Data</th>
        </tr>
    </thead>

    <tbody>
        @forelse ($dados as $item)
            <tr>
                <td>{{ strtoupper($item->acessorio->codigo ?? '-') }}</td>

                <td>
                    {{ strtoupper($item->acessorio->descricao ?? '-') }}
                </td>

                <td>{{ strtoupper($item->cor ?? '-') }}</td>

                <td>{{ $item->quantidade }}</td>

                <td>
                    {{ \Carbon\Carbon::parse($item->created_at)->format('d/m/Y') }}
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5">
                    Nenhum item encontrado para esta obra.
                </td>
            </tr>
        @endforelse
    </tbody>
</table>

<div class="totais">
    <h3>Resumo da Obra</h3>

    <p>
        <strong>Total de Itens:</strong>
        {{ $dados->count() }}
    </p>

    <p>
        <strong>Quantidade Total Utilizada:</strong>
        {{ $dados->sum('quantidade') }}
    </p>
</div>
