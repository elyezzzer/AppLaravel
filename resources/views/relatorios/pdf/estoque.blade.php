

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

    .totais h3 {
        margin: 0 0 10px;
        font-size: 14px;
        color: #111;
    }

    .totais p {
        margin: 4px 0;
    }

    strong {
        color: #111;
    }
</style>

<h1>Relatório de Estoque Atual</h1>

<table class="data-table">
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
                    <td>{{ strtoupper($item->codigo) }}</td>
                    <td>{{ strtoupper($item->descricao) }}</td>
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