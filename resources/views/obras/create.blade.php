@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Criar Nova Obra') }}
    </h2>
@endsection

@section('slot')
<div class="py-12">
    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

        <div class="mb-6 text-left">
            <span class="text-2xl font-semibold text-gray-800 tracking-wide">
                Cadastrar Nova Obra
            </span>
        </div>

        <div class="bg-white p-6 shadow-sm sm:rounded-lg">

            @if ($errors->any())
                <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li class="text-sm">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('obras.store') }}" method="POST" class="space-y-6">
                @csrf

                <div>
                    <label for="nome" class="block text-sm font-medium text-gray-700">Nome da Obra</label>
                    <input type="text" name="nome" id="nome" value="{{ old('nome') }}" required
                        class="mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>

                <div class="flex justify-center gap-4 mt-4">
                    <button type="submit"
                        class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent 
                        rounded-md font-semibold text-xs text-white uppercase tracking-widest 
                        hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 
                        focus:ring-offset-2 transition ease-in-out duration-150">
                        Salvar
                    </button>

                    <a href="{{ route('obras.index') }}"
                        class="inline-flex items-center px-4 py-2 bg-gray-500 border border-transparent 
                        rounded-md font-semibold text-xs text-white uppercase tracking-widest 
                        hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-400 
                        focus:ring-offset-2 transition ease-in-out duration-150">
                        Voltar
                    </a>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
