<form method="POST" action="{{ route('relatorios.gerar') }}">
@csrf

<div class="grid grid-cols-2 gap-4">

    <input type="date" name="data_inicio" class="border p-2">
    <input type="date" name="data_fim" class="border p-2">

    <select name="tipo" class="border p-2">
        <option value="todos">Todos</option>
        <option value="entrada">Entrada</option>
        <option value="saida">Saída</option>
        <option value="estoque">Estoque Atual</option>
    </select>

    <input
        type="text"
        name="codigo"
        placeholder="Código do acessório (opcional)"
        class="border p-2"
    >

</div>

<button class="mt-4 px-4 py-2 bg-gray-800 text-white">
    Gerar relatório
</button>

</form>
