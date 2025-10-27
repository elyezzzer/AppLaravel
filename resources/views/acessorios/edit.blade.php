@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Editar Acessório') }}
    </h2>
@endsection

@section('slot')
<div class="py-12">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white p-6 shadow-sm sm:rounded-lg">
            <form action="{{ route('acessorios.update', $acessorio->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Código</label>
                        <input type="text" name="codigo" value="{{ old('codigo', $acessorio->codigo) }}"
                            class="mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        @error('codigo')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Descrição</label>
                        <input type="text" name="descricao" value="{{ old('descricao', $acessorio->descricao) }}"
                            class="mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>

                </div>

                <div class="flex justify-center gap-4 mt-4">
                    <button type="submit"
                        class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent 
                        rounded-md font-semibold text-xs text-white uppercase tracking-widest 
                        hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 
                        focus:ring-offset-2 transition ease-in-out duration-150">
                        ATUALIZAR
                    </button>

                    <a href="{{ route('acessorios.index') }}"
                        class="inline-flex items-center px-4 py-2 bg-gray-500 border border-transparent 
                        rounded-md font-semibold text-xs text-white uppercase tracking-widest 
                        hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-400 
                        focus:ring-offset-2 transition ease-in-out duration-150">
                        CANCELAR
                    </a>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
