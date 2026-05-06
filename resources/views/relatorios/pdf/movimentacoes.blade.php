@include('relatorios.pdf.header')

<style>
    body {
        font-family: Arial, Helvetica, sans-serif;
        color: #222;
        margin: 0;
        padding: 0;
    }

    h1 {
        font-size: 18px;
        margin: 18px 0 12px;
        text-align: center;
        color: #333;
    }

    .data-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 12px;
        font-size: 11px;
    }

    .data-table th,
    .data-table td {
        border: 1px solid #ccc;
        padding: 8px 10px;
        text-align: left;
    }

    .data-table th {
        background-color: #f5f5f5;
        color: #333;
        font-weight: 700;
    }

    .data-table tbody tr:nth-child(even) {
        background-color: #f9f9f9;
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
        margin-top: 18px;
        padding: 14px 16px;
        border: 1px solid #d1d7dd;
        background-color: #f9f9f9;
        font-size: 12px;
    }

    .totais h3 {
        margin: 0 0 10px;
        font-size: 14px;
        color: #333;
    }

    .totais p {
        margin: 4px 0;
    }

    strong {
        color: #111;
    }
</style>

    @php
        $valorTotalMovimentacoes = $dados->sum(function ($item) {
            return ($item->preco ?? $item->acessorio->preco ?? 0) * $item->quantidade;
        });
    @endphp

<div class="totais">
    <h3>Resumo das movimentações</h3>

    <table width="100%" style="margin-top: 10px;">
        <tr>
            <td style="vertical-align: top; width: 50%;">
                <p><strong>Tipo exibido:</strong> {{ isset($filtros['tipo']) && $filtros['tipo'] !== 'todos' ? ucfirst($filtros['tipo']) : 'Todos' }}</p>
                <p><strong>Total de Movimentações:</strong> {{ $dados->count() }}</p>
                <p><strong>Valor Total das Movimentações:</strong> R$ {{ number_format($valorTotalMovimentacoes, 2, ',', '.') }}</p>
            </td>

            <td style="vertical-align: top; width: 50%;">
                <p><strong>Total Entradas:</strong> {{ $totais['total_entradas'] }}</p>
                <p><strong>Total Saídas:</strong> {{ $totais['total_saidas'] }}</p>
            </td>
        </tr>
    </table>
</div>

<h1>Relatório de movimentações</h1>

<table class="data-table">
    <thead>
        <tr>
            <th>Código</th>
            <th>Descrição</th>
            <th>Cor</th>
            <th>Tipo</th>
            <th>Quantidade</th>
            <th>Preço Unitário</th>
            <th>Valor Total</th>
            <th>Data</th>
        </tr>
    </thead>

    <tbody>
        @forelse ($dados as $item)
            @php
                $preco = $item->preco ?? $item->acessorio->preco ?? 0;
                $valor = $preco * $item->quantidade;
            @endphp
            <tr>
                <td style="white-space: nowrap;">{{ strtoupper($item->acessorio->codigo ?? '-') }}</td>
                <td>{{ strtoupper($item->acessorio->descricao ?? '-') }}</td>
                <td>{{ strtoupper($item->cor ?? $item->acessorio->cor ?? '-') }}</td>
                <td class="{{ $item->tipo === 'entrada' ? 'entrada' : 'saida' }}">
                    {{ ucfirst($item->tipo) }}
                </td>
                <td>{{ $item->quantidade }}</td>
                <td>R$ {{ number_format($preco, 2, ',', '.') }}</td>
                <td>R$ {{ number_format($valor, 2, ',', '.') }}</td>
                <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d/m/Y H:i') }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="8" style="text-align: center;">Nenhuma movimentação encontrada.</td>
            </tr>
        @endforelse
    </tbody>
</table>

<script type="text/php">
    if (isset($pdf)) {
        $pdf->page_script('
            $font = $fontMetrics->get_font("Helvetica", "normal");
            $size = 9;

            $text = "Página " . $PAGE_NUM . " / " . $PAGE_COUNT;

            $width = $fontMetrics->get_text_width($text, $font, $size);

            $x = $pdf->get_width() - $width - 30;
            $y = $pdf->get_height() - 30;

            $pdf->text($x, $y, $text, $font, $size);
        ');
    }
</script>


