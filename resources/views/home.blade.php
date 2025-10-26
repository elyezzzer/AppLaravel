@extends('layouts.app')

@section('header')
<h2 class="font-semibold text-xl text-gray-800 leading-tight">
    {{ __('Dashboard') }}
</h2>
@endsection

@section('slot')
<div class="py-12">
    <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6">

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 justify-center items-stretch">
            <a href="{{ route('acessorios.index') }}" class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition">
                <h3 class="text-lg font-semibold text-gray-700">Acessórios</h3>
                <p class="mt-2 text-sm text-gray-500">Gerencie todos os acessórios.</p>
            </a>

            <a href="{{ route('obras.index') }}" class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition">
                <h3 class="text-lg font-semibold text-gray-700">Obras</h3>
                <p class="mt-2 text-sm text-gray-500">Visualize e gerencie as obras.</p>
            </a>

            <a href="{{ route('historico.index') }}" class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition">
                <h3 class="text-lg font-semibold text-gray-700">Histórico</h3>
                <p class="mt-2 text-sm text-gray-500">Veja as retiradas realizadas.</p>
            </a>
        </div>

    </div>
</div>
@endsection
