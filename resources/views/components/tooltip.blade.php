@props(['text']) {{-- Declara que o componente recebe a propriedade text --}}

<div class="relative group group flex">
    {{ $slot }}

    <span class="absolute -top-10 left-1/2 -translate-x-1/2
                 px-2 py-1 text-xs text-white bg-gray-900 rounded
                 opacity-0 group-hover:opacity-100
                 transition-opacity duration-200 whitespace-nowrap">
        {{ $text }}
    </span>
</div>
