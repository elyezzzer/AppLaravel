@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Lista de Obras') }}
    </h2>
@endsection

@section('slot')
<div class="py-10">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        {{-- Header --}}
        <div class="flex items-end justify-between mb-7 flex-wrap gap-4">
            <div>
                <h1 class="text-2xl font-medium text-gray-900 leading-tight">Obras</h1>
                <p class="text-sm text-gray-400 mt-0.5">Gerencie as obras cadastradas</p>
            </div>

            <a href="{{ route('obras.create') }}"
               class="inline-flex items-center gap-1.5 px-4 py-2 bg-[#1565ff] text-white text-xs font-medium rounded-lg hover:bg-[#0f4ed1] transition-colors">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" viewBox="0 0 16 16">
                    <line x1="8" y1="2" x2="8" y2="14"/>
                    <line x1="2" y1="8" x2="14" y2="8"/>
                </svg>
                Nova obra
            </a>
        </div>
        
        {{-- Mensagem de sucesso --}}
        @if(session('success'))
            <div class="flex items-start gap-2 px-4 py-2.5 bg-green-50 border border-green-200 rounded-lg text-sm text-green-700 mb-5">
                <ul class="list-disc pl-4 space-y-0.5">
                    <li>{{ session('success') }}</li>
                </ul>
            </div>
        @endif

        {{-- Table --}}
        <div class="bg-white border border-gray-200 rounded-xl overflow-hidden shadow-sm">
            <table class="min-w-full divide-y divide-gray-100">

                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-5 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-widest">Nome</th>
                        <th class="px-5 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-widest">Endereço</th>
                        <th class="px-5 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-widest">Telefone</th>
                        <th class="px-5 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-widest">Data início</th>
                        <th class="px-5 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-widest">Ações</th>
                    </tr>
                </thead>

                <tbody class="bg-white divide-y divide-gray-50">
                    @foreach($obras as $obra)
                        <tr class="hover:bg-gray-50 transition-colors duration-100">

                            <td class="px-5 py-3.5 text-sm text-gray-700 uppercase font-medium">
                                {{ $obra->nome }}
                            </td>

                            <td class="px-5 py-3.5 text-sm text-gray-700 uppercase font-medium">
                                {{ $obra->rua }}, {{ $obra->numero }} <br>
                                {{ $obra->bairro }} - {{ $obra->cidade }}
                            </td>

                            <td class="px-5 py-3.5 text-sm text-gray-700">
                                @php
                                    $tel = preg_replace('/\D/', '', $obra->telefone);
                                @endphp

                                @if(strlen($tel) === 11)
                                    ({{ substr($tel, 0, 2) }}){{ substr($tel, 2, 5) }}-{{ substr($tel, 7, 4) }}
                                @elseif(strlen($tel) === 10)
                                    ({{ substr($tel, 0, 2) }}){{ substr($tel, 2, 4) }}-{{ substr($tel, 6, 4) }}
                                @else
                                    {{ $obra->telefone }}
                                @endif
                            </td>


                            <td class="px-5 py-3.5 text-sm text-gray-700">
                                {{ $obra->data_inicio 
                                    ? \Carbon\Carbon::parse($obra->data_inicio)->format('d/m/Y') 
                                    : '-' }}
                            </td>

                            {{-- Ações --}}
                            <td class="px-5 py-3.5 whitespace-nowrap ">
                                <div class="flex items-center justify-center gap-2">

                                    {{-- Editar --}}
                                    <x-tooltip text="Editar">
                                    <a href="{{ route('obras.edit', $obra->id) }}"
                                        class="p-2 bg-blue-50 text-blue-600 rounded-lg
                                            border border-blue-100
                                            hover:bg-blue-600 hover:text-white hover:border-blue-600
                                            hover:scale-105 active:scale-95
                                            transition-all duration-150">

                                        {{-- Ícone lápis --}}
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                        </svg>
                                    </a>
                                    </x-tooltip>

                                    {{-- Excluir --}}
                                    <x-tooltip text="Excluir">
                                    
                                        @csrf
                                        @method('DELETE')

                                        <button type="button"
                                                x-on:click="$dispatch('open-modal', 'confirm-delete-{{ $obra->id }}')"
                                                class="p-2 bg-red-50 text-red-600 rounded-lg
                                                    border border-red-100
                                                    hover:bg-red-600 hover:text-white hover:border-red-600
                                                    hover:scale-105 active:scale-95
                                                    transition-all duration-150">

                                            {{-- Ícone lixeira --}}
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="size-5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                            </svg>
                                        </button>

                                        {{-- Modal de confirmação --}}
                                        <x-modal name="confirm-delete-{{ $obra->id }}">
                                            <div class="p-6">

                                                <h2 class="text-lg font-semibold text-gray-800 mb-4">
                                                    Confirmar exclusão
                                                </h2>

                                                <p class="text-gray-600 mb-6">
                                                    Tem certeza que deseja excluir a obra <strong>{{ mb_strtoupper($obra->nome, 'UTF-8') }}</strong>?<br>
                                                    Não será possível <strong>GERAR RELATÓRIOS</strong> com os dados dessa obra!
                                                </p>

                                                <div class="flex justify-end gap-3">
                                                    
                                                    <button 
                                                        x-on:click="$dispatch('close-modal', 'confirm-delete-{{ $obra->id }}')"
                                                        class="px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300">
                                                        Cancelar
                                                    </button>

                                                    <form method="POST" action="{{ route('obras.destroy', $obra->id) }}">
                                                        @csrf
                                                        @method('DELETE')

                                                        <button 
                                                            type="submit"
                                                            class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
                                                            Excluir
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </x-modal>
                                    </x-tooltip>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>

            {{-- Paginação --}}
            <div class="flex items-center justify-between px-5 py-3 border-t border-gray-100">
                <span class="text-xs text-gray-400">
                    Mostrando {{ $obras->firstItem() }}–{{ $obras->lastItem() }} de {{ $obras->total() }} resultados
                </span>

                {{ $obras->links('components.pagination') }}
            </div>
        </div>

    </div>
</div>
@endsection
