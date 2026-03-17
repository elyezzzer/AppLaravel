@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Lista de Obras') }}
    </h2>
@endsection

@section('slot')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <div class="mb-6 text-left">
            <span class="text-2xl font-semibold text-gray-800 tracking-wide">
                Obras
            </span>
        </div>

        <div class="flex justify-end mb-4">
            <a href="{{ route('obras.create') }}"
                class="inline-flex items-center px-4 py-2 bg-blue-600 rounded-md 
                font-semibold text-xs text-white uppercase hover:bg-blue-700 transition">
                Nova Obra
            </a>
        </div>

        <div class="bg-white shadow-sm sm:rounded-lg p-6 overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 text-center">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">Nome</th>
                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">Endereço</th>
                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">Telefone</th>
                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">Data início</th>
                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">Ações</th>
                    </tr>
                </thead>

                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($obras as $obra)
                        <tr class="hover:bg-gray-50">

                            <td class="px-6 py-4 text-sm text-gray-700">
                                {{ $obra->nome }}
                            </td>

                            <td class="px-6 py-4 text-sm text-gray-700">
                                {{ $obra->rua }}, {{ $obra->numero }} <br>
                                {{ $obra->bairro }} - {{ $obra->cidade }}
                            </td>

                            <td class="px-6 py-4 text-sm text-gray-700">
                                {{ $obra->telefone }}
                            </td>

                            <td class="px-6 py-4 text-sm text-gray-700">
                                {{ $obra->data_inicio 
                                    ? \Carbon\Carbon::parse($obra->data_inicio)->format('d/m/Y') 
                                    : '-' }}
                            </td>

                            <td class="px-6 py-4 text-sm text-gray-700 space-x-2">
                                <a href="{{ route('obras.edit', $obra->id) }}"
                                    class="inline-flex items-center px-3 py-1 bg-gray-500 rounded-md 
                                    text-xs text-white hover:bg-gray-600 transition">
                                    Editar
                                </a>

                                <form action="{{ route('obras.destroy', $obra->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="inline-flex items-center px-3 py-1 bg-red-600 rounded-md 
                                        text-xs text-white hover:bg-red-700 transition">
                                        Excluir
                                    </button>
                                </form>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-4">
                {{ $obras->links('components.pagination') }}
            </div>

        </div>
    </div>
</div>
@endsection