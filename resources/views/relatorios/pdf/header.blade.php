<div style="width:100%; padding:6px 8px;">

    <table width="100%" style="border-collapse:collapse;">
        <tr style="height:60px; overflow:hidden;">

            <!-- LOGO -->
            <td style="width:120px; vertical-align:middle; padding:0; line-height:0;">
                <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/IconeInventoryPlus.png'))) }}" 
                     style="height:60px; display:block;">
            </td>

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

                @if(!empty($mostrar_periodo) && $mostrar_periodo)
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