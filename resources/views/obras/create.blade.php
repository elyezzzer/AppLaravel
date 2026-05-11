@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Criar Nova Obra') }}
    </h2>
@endsection

@section('slot')
<div class="py-10">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

        {{-- Header --}}
        <div class="flex items-end justify-between mb-7 flex-wrap gap-4">
            <div>
                <h1 class="text-2xl font-medium text-gray-900 leading-tight">Nova Obra</h1>
                <p class="text-sm text-gray-400 mt-0.5">Cadastre uma nova obra no sistema</p>
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

            <form action="{{ route('obras.store') }}" method="POST" class="space-y-6" novalidate>
                @csrf

                <div class="grid grid-cols-2 gap-4">

                    {{-- Nome --}}
                    <div class="col-span-2">
                        <label class="block text-xs font-medium text-gray-500 uppercase">Nome da Obra</label>
                        <input type="text" name="nome" value="{{ old('nome') }}" required
                            class="mt-1 w-full rounded-lg border-gray-200 text-sm focus:border-gray-900 focus:ring-gray-900">
                            @error('nome')
                                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                    </div>

                    {{-- Cidade --}}
                    <div>
                        <label class="block text-xs font-medium text-gray-500 uppercase">Cidade</label>
                        <input type="text" name="cidade" value="{{ old('cidade') }}"
                            class="mt-1 w-full rounded-lg border-gray-200 text-sm focus:border-gray-900 focus:ring-gray-900">
                    </div>

                    {{-- Bairro --}}
                    <div>
                        <label class="block text-xs font-medium text-gray-500 uppercase">Bairro</label>
                        <input type="text" name="bairro" value="{{ old('bairro') }}"
                            class="mt-1 w-full rounded-lg border-gray-200 text-sm focus:border-gray-900 focus:ring-gray-900">
                    </div>

                    {{-- Rua --}}
                    <div>
                        <label class="block text-xs font-medium text-gray-500 uppercase">Rua</label>
                        <input type="text" name="rua" value="{{ old('rua') }}"
                            class="mt-1 w-full rounded-lg border-gray-200 text-sm focus:border-gray-900 focus:ring-gray-900">
                    </div>

                    {{-- Número --}}
                    <div>
                        <label class="block text-xs font-medium text-gray-500 uppercase">Número</label>
                        <input type="text" name="numero" value="{{ old('numero') }}"
                            class="mt-1 w-full rounded-lg border-gray-200 text-sm focus:border-gray-900 focus:ring-gray-900">
                    </div>

                    {{-- Telefone --}}
                    <div>
                        <label class="block text-xs font-medium text-gray-500 uppercase">Telefone</label>
                        <input type="text" name="telefone" value="{{ old('telefone') }}"
                            class="mt-1 w-full rounded-lg border-gray-200 text-sm focus:border-gray-900 focus:ring-gray-900">
                    </div>

                    {{-- Data --}}
                    <div>
                        <label class="block text-xs font-medium text-gray-500 uppercase">Data de início</label>
                        <input type="date" name="data_inicio" value="{{ old('data_inicio') }}"
                            class="mt-1 w-full rounded-lg border-gray-200 text-sm focus:border-gray-900 focus:ring-gray-900">
                    </div>

                </div>

                {{-- Botões --}}
                <div class="flex justify-center gap-3 pt-4 border-gray-100">
                    <button type="submit"
                        class="px-4 py-2 text-xs font-medium text-white bg-[#1565ff] rounded-lg hover:bg-[#0f4ed1] transition">
                        Salvar obra
                    </button>

                    <a href="{{ route('obras.index') }}"
                        class="px-4 py-2 text-xs font-medium text-white bg-gray-500 rounded-lg hover:bg-gray-600 transition">
                        Voltar
                    </a>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection
