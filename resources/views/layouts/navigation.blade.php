<div x-data="{ open: false }" class="h-screen flex flex-col"><div x-data="{ open: localStorage.getItem('sidebar') === 'open' }"
     x-init="$watch('open', value => localStorage.setItem('sidebar', value ? 'open' : 'closed'))"
     class="h-screen flex flex-col">


    <!-- HEADER -->
    <nav class="bg-gray-200 text-gray-800 border-b border-gray-300">
        <div class="w-full px-6">
            <div class="flex justify-between h-16 items-center">

                <!-- ESQUERDA -->
                <div class="flex items-center gap-4">

                    <!-- BOTAO MENU -->
                    <button @click="open = !open"
                        class="text-2xl text-gray-700 hover:text-gray-900">
                        ☰
                    </button>

                    <!-- LOGO -->
                    <div class="shrink-0 flex items-center">
                        <a href="{{ route('home') }}">
                            <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                        </a>
                    </div>
                </div>

                <!-- DIREITA (CONTA USUARIO) -->
                <div class="flex items-center">

                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-700 bg-gray-200 rounded-md hover:text-gray-900">

                                {{ Auth::user()->name }}

                                <svg class="ms-1 fill-current h-4 w-4" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd"/>
                                </svg>
                            </button>
                        </x-slot>
                        <x-slot name="content">

                            <x-dropdown-link :href="route('profile.edit')">
                                Profile
                            </x-dropdown-link>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();">

                                    Log Out

                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            </div>
        </div>
    </nav>

    <!-- AREA ABAIXO DO HEADER -->
    <div class="flex flex-1">

        <!-- SIDEBAR -->
        <div :class="open ? 'w-48' : 'w-18'"
            class="bg-gray-300 text-gray-800 transition-all duration-300 flex flex-col">

            <nav class="mt-4 space-y-2 px-2">

                <a href="{{ route('home') }}"
                    class="flex items-center gap-3 p-3 text-sm rounded hover:bg-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                        </svg>
                    <span x-show="open">Home</span>
                </a>

                <a href="{{ route('acessorios.index') }}"
                    class="flex items-center gap-3 p-3 text-sm rounded hover:bg-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11.42 15.17 17.25 21A2.652 2.652 0 0 0 21 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655 5.653a2.548 2.548 0 1 1-3.586-3.586l6.837-5.63m5.108-.233c.55-.164 1.163-.188 1.743-.14a4.5 4.5 0 0 0 4.486-6.336l-3.276 3.277a3.004 3.004 0 0 1-2.25-2.25l3.276-3.276a4.5 4.5 0 0 0-6.336 4.486c.091 1.076-.071 2.264-.904 2.95l-.102.085m-1.745 1.437L5.909 7.5H4.5L2.25 3.75l1.5-1.5L7.5 4.5v1.409l4.26 4.26m-1.745 1.437 1.745-1.437m6.615 8.206L15.75 15.75M4.867 19.125h.008v.008h-.008v-.008Z" />
                        </svg>
                    <span x-show="open">Acessórios cadastrados</span>
                </a>

                <a href="{{ route('estoque.index') }}"
                    class="flex items-center gap-3 p-3 text-sm rounded hover:bg-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
                        </svg>
                    <span x-show="open">Estoque</span>
                </a>

                <a href="{{ route('obras.index') }}"
                    class="flex items-center gap-3 p-3 text-sm rounded hover:bg-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21" />
                        </svg>
                    <span x-show="open">Obras</span>
                </a>

                <a href="{{ route('historico.index') }}"
                    class="flex items-center gap-3 p-3 text-sm rounded hover:bg-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                    <span x-show="open">Histórico</span>
                </a>

                <a href="{{ route('relatorios.index') }}"
                    class="flex items-center gap-3 p-3 text-sm rounded hover:bg-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 0 1-2.25 2.25M16.5 7.5V18a2.25 2.25 0 0 0 2.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 0 0 2.25 2.25h13.5M6 7.5h3v3H6v-3Z" />
                        </svg>
                    <span x-show="open">Relatórios</span>
                </a>

                

            </nav>
        </div>

        <!-- CONTEUDO -->
        <div class="flex-1 bg-gray-100">

            <!-- CONTEUDO -->
            <main class="p-6">
                @yield('slot')
            </main>

        </div>
    </div>
</div>
