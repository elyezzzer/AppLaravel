<div style="width:100%; padding:6px 8px;">

    <table width="100%" style="border-collapse:collapse;">
        <tr style="height:60px; overflow:hidden;">

            <!-- DADOS EMPRESA -->
            <td style="vertical-align:middle; font-size:11px; padding:0; line-height:1.2;">
                
                <strong style="font-size:14px;">
                    {{ $empresa['nome'] ?? 'InventoryPlus' }}
                </strong><br>

                {{ $empresa['endereco'] ?? 'Rua Exemplo, 123 - Centro' }}<br>

                Tel: {{ $empresa['telefone'] ?? '(00) 0000-0000' }} |
                Email: {{ $empresa['email'] ?? 'contato@empresa.com' }}

            </td>

            <!-- INFO RELATÓRIO -->
            <td style="width:260px; vertical-align:middle; font-size:11px; text-align:right; line-height:1.3; padding:0;">
                
                <strong style="font-size:14px;">
                    {{ $titulo ?? 'Relatório' }}
                </strong><br>

                @if($mostrarPeriodo)
                    Período:
                    {{ isset($filtros['data_inicio']) ? \Carbon\Carbon::parse($filtros['data_inicio'])->format('d/m/Y') : '--/--/----' }}
                    -
                    {{ isset($filtros['data_fim']) ? \Carbon\Carbon::parse($filtros['data_fim'])->format('d/m/Y') : '--/--/----' }}
                    <br>
                @endif

                Gerado em: {{ isset($gerado_em) ? $gerado_em->format('d/m/Y H:i') : now()->format('d/m/Y H:i') }}
            </td>
        </tr>
    </table>
</div>