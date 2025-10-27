@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Estoque de Acessórios') }}
    </h2>
@endsection

@section('slot')
<div class="py-12">
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
        <div class="flex justify-end mb-4">
            <a href="{{ route('estoque.create') }}"
               class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent 
                      rounded-md font-semibold text-xs text-white uppercase tracking-widest 
                      hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 
                      focus:ring-offset-2 transition ease-in-out duration-150">
                ADICIONAR AO ESTOQUE
            </a>
        </div>

        @if(session('success'))
            <div class="mb-4 px-4 py-2 bg-green-100 text-green-700 rounded shadow">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto bg-white shadow-sm sm:rounded-lg">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Código</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Descrição</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cor</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quantidade</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Preço</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ações</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($estoques as $estoque)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $estoque->acessorio->codigo }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $estoque->acessorio->descricao }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $estoque->cor }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $estoque->quantidade }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">R$ {{ number_format($estoque->preco, 2, ',', '.') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                <a href="{{ route('estoque.retirar', $estoque->id) }}" 
                                   class="inline-flex px-2 py-1 bg-green-500 text-white rounded hover:bg-green-600 text-xs">
                                   RETIRAR
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
