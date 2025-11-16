@if ($paginator->hasPages())
    <nav class="flex items-center justify-center space-x-1 mt-4">

        {{-- Link Anterior --}}
        @if ($paginator->onFirstPage())
            <span class="px-3 py-1 text-gray-400 cursor-not-allowed text-sm">
                <
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}"
               class="px-3 py-1 text-gray-700 text-sm hover:bg-gray-200 rounded transition">
                <
            </a>
        @endif

        {{-- Links das páginas --}}
        @foreach ($elements as $element)
            
            {{-- "..." separador --}}
            @if (is_string($element))
                <span class="px-3 py-1 text-gray-500 text-sm">
                    {{ $element }}
                </span>
            @endif

            {{-- Páginas --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)

                    {{-- Página atual --}}
                    @if ($page == $paginator->currentPage())
                        <span class="px-3 py-1 bg-gray-300 text-gray-700 rounded text-sm font-semibold">
                            {{ $page }}
                        </span>

                    {{-- Outras páginas --}}
                    @else
                        <a href="{{ $url }}"
                           class="px-3 py-1 text-gray-700 text-sm hover:bg-gray-200 rounded transition">
                            {{ $page }}
                        </a>
                    @endif

                @endforeach
            @endif

        @endforeach

        {{-- Link Próximo --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}"
               class="px-3 py-1 text-gray-700 text-sm hover:bg-gray-200 rounded transition">
                >
            </a>
        @else
            <span class="px-3 py-1 text-gray-400 cursor-not-allowed text-sm">
                >
            </span>
        @endif
    </nav>
@endif