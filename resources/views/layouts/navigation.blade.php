<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">

    <div class="w-full px-6">
        <div class="flex justify-between h-16 items-center">

            <!-- ESQUERDA -->
            <div class="flex items-center gap-4">

                <!-- BOTAO MENU -->
                <div class="relative">
                    <button id="btnMenu"
                        class="bg-gray-400 text-white px-4 py-2 rounded">
                        ☰
                    </button>

                    <div id="menuDropdown"
                        class="hidden absolute left-0 mt-2 w-52 bg-white rounded shadow z-50">

                        <a href="{{ route('home') }}" class="block px-4 py-2 hover:bg-gray-100">Home</a>
                        <a href="{{ route('acessorios.index') }}" class="block px-4 py-2 hover:bg-gray-100">Acessórios cadastrados</a>
                        <a href="{{ route('obras.index') }}" class="block px-4 py-2 hover:bg-gray-100">Obras</a>
                        <a href="{{ route('estoque.index') }}" class="block px-4 py-2 hover:bg-gray-100">Estoque</a>
                        <a href="{{ route('historico.index') }}" class="block px-4 py-2 hover:bg-gray-100">Histórico</a>

                    </div>
                </div>

                <!-- LOGO -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>

            </div>

            <!-- DIREITA -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-600 bg-white rounded-md hover:text-gray-700">
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

    <script>
        document.addEventListener('DOMContentLoaded', function(){

            const btn = document.getElementById('btnMenu');
            const menu = document.getElementById('menuDropdown');

            btn.addEventListener('click', function(){
                menu.classList.toggle('hidden');
            });

        });
    </script>

</nav>