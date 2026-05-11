@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Editar Obra') }}
    </h2>
@endsection

@section('slot')
<div class="py-10">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

        {{-- Header --}}
        <div class="flex items-end justify-between mb-7 flex-wrap gap-4">
            <div>
                <h1 class="text-2xl font-medium text-gray-900 leading-tight">Editar Obra</h1>
                <p class="text-sm text-gray-400 mt-0.5">Atualize as informações da obra</p>
            </div>
        </div>

        {{-- Mensagem de erro --}}
            @if($errors->any())
                <div class="flex items-start gap-2 px-4 py-2.5 bg-red-50 border border-red-200 rounded-lg text-sm text-red-700 mb-5">

                    <ul class="list-disc pl-4 space-y-0.5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

        {{-- Card --}}
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6">

            <form action="{{ route('obras.update', $obra->id) }}" method="POST" class="space-y-6" novalidate>
                @csrf
                @method('PUT')

                <div class="grid grid-cols-2 gap-4">

                    {{-- Nome --}}
                    <div class="col-span-2">
                        <label class="block text-xs font-medium text-gray-500 uppercase">Nome da Obra</label>
                        <input type="text" name="nome" value="{{ old('nome', mb_strtoupper($obra->nome, 'UTF-8')) }}"
                            class="mt-1 w-full rounded-lg border-gray-200 text-sm focus:border-gray-900 focus:ring-gray-900">
                            @error('nome')
                                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                    </div>

                    {{-- Cidade --}}
                    <div>
                        <label class="block text-xs font-medium text-gray-500 uppercase">Cidade</label>
                        <input type="text" name="cidade" value="{{ old('cidade', mb_strtoupper($obra->cidade, 'UTF-8')) }}"
                            class="mt-1 w-full rounded-lg border-gray-200 text-sm focus:border-gray-900 focus:ring-gray-900">
                    </div>

                    {{-- Bairro --}}
                    <div>
                        <label class="block text-xs font-medium text-gray-500 uppercase">Bairro</label>
                        <input type="text" name="bairro" value="{{ old('bairro', mb_strtoupper($obra->bairro, 'UTF-8')) }}"
                            class="mt-1 w-full rounded-lg border-gray-200 text-sm focus:border-gray-900 focus:ring-gray-900">
                    </div>

                    {{-- Rua --}}
                    <div>
                        <label class="block text-xs font-medium text-gray-500 uppercase">Rua</label>
                        <input type="text" name="rua" value="{{ old('rua', mb_strtoupper($obra->rua, 'UTF-8')) }}"
                            class="mt-1 w-full rounded-lg border-gray-200 text-sm focus:border-gray-900 focus:ring-gray-900">
                    </div>

                    {{-- Número --}}
                    <div>
                        <label class="block text-xs font-medium text-gray-500 uppercase">Número</label>
                        <input type="text" name="numero" value="{{ old('numero', $obra->numero) }}"
                            class="mt-1 w-full rounded-lg border-gray-200 text-sm focus:border-gray-900 focus:ring-gray-900">
                    </div>

                    {{-- Telefone --}}
                    <div>
                        <label class="block text-xs font-medium text-gray-500 uppercase">Telefone</label>
                        <input type="text" name="telefone" value="{{ old('telefone', $obra->telefone) }}"
                            class="mt-1 w-full rounded-lg border-gray-200 text-sm focus:border-gray-900 focus:ring-gray-900">
                    </div>

                    {{-- Data --}}
                    <div>
                        <label class="block text-xs font-medium text-gray-500 uppercase">Data de início</label>
                        <input type="date" name="data_inicio"
                            value="{{ old('data_inicio', $obra->data_inicio) }}"
                            class="mt-1 w-full rounded-lg border-gray-200 text-sm focus:border-gray-900 focus:ring-gray-900">
                    </div>

                </div>

                {{-- Botões --}}
                <div class="flex justify-end gap-3 pt-4 border-t border-gray-100">

                    <a href="{{ route('obras.index') }}"
                        class="px-4 py-2 text-xs font-medium text-gray-600 bg-gray-100 rounded-lg hover:bg-gray-200 transition">
                        Voltar
                    </a>

                    <button type="submit"
                        class="px-4 py-2 text-xs font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition">
                        Atualizar obra
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
