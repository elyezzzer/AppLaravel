@extends('layouts.app')

@section('slot')

<div class="max-w-4xl mx-auto mt-6">

<div class="bg-white p-6 rounded shadow">

<form action="{{ route('estoque.store') }}" method="POST">
@csrf

<div class="grid grid-cols-2 gap-4">

<div>
<label>Acessório</label>
<select name="acessorio_id" id="acessorio" class="border rounded w-full">
@foreach($acessorios as $a)
<option value="{{ $a->id }}" data-cor="{{ $a->cor }}">
{{ $a->codigo }}
</option>
@endforeach
</select>
</div>

<div id="campoCor">
<label>Cor</label>
<select name="cor" class="border rounded w-full">
<option value="branco">Branco</option>
<option value="preto">Preto</option>
<option value="natural">Natural</option>
</select>
</div>

<div>
<label>Quantidade</label>
<input type="number" name="quantidade" class="border rounded w-full">
</div>

</div>

<button class="bg-blue-600 text-white px-4 py-2 mt-4 rounded">
Adicionar
</button>

</form>

</div>
</div>

<script>
const selectAcessorio = document.getElementById('acessorio');
const campoCor = document.getElementById('campoCor');

function verificar(){
    const cor = selectAcessorio.options[selectAcessorio.selectedIndex].dataset.cor;
    if(cor === 'todas'){
        campoCor.style.display = 'block';
    }else{
        campoCor.style.display = 'none';
    }
}

selectAcessorio.addEventListener('change', verificar);
window.onload = verificar;
</script>

@endsection