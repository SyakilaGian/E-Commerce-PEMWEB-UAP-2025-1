<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- LEFT -->
            <div class="flex items-center gap-3">
                <!-- LOGO LANGSUNG -->
                <a href="{{ route('dashboard') }}" class="flex items-center gap-2">
                    <img
                        src="{{ asset('img/logo.png') }}"
                        alt="Logo"
                        class="h-9 w-auto object-contain"
                    />
                    <span class="hidden sm:block text-lg font-semibold text-gray-800">
                        {{ config('app.name', 'KS Store') }}
                    </span>
                </a>

                <!-- Desktop Menu -->
                <div class="hidden sm:flex sm:ms-10 space-x-8">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        Dashboard
                    </x-nav-link>

                    @auth
                        @if(auth()->user()->isMember())
                            <x-nav-link :href="route('store.register.form')">
                                Daftar Toko
                            </x-nav-link>
                        @endif

                        @if(auth()->user()->isSeller())
                            <x-nav-link :href="route('seller.store.edit')">
                                Profil Toko
                            </x-nav-link>
                            <x-nav-link :href="route('seller.products.index')">
                                Produk
                            </x-nav-link>
                            <x-nav-link :href="route('seller.orders.index')">
                                Pesanan
                            </x-nav-link>
                            <x-nav-link :href="route('seller.balance.index')">
                                Saldo
                            </x-nav-link>
                        @endif
                    @endauth
                </div>
            </div>

            <!-- RIGHT -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                @auth
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button
                                class="flex items-center gap-2 px-3 py-2 text-sm rounded-md
                                text-gray-600 hover:text-gray-800 focus:outline-none">

                                <div class="w-8 h-8 rounded-full bg-orange-100 flex items-center justify-center">
                                    <span class="font-semibold text-orange-600">
                                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                    </span>
                                </div>

                                <span>{{ auth()->user()->name }}</span>

                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                Profile
                            </x-dropdown-link>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link
                                    :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                    Log Out
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @endauth

                @guest
                    <a href="{{ route('login') }}"
                        class="px-4 py-2 text-sm text-gray-600 hover:text-orange-600">
                        Login
                    </a>
                    <a href="{{ route('register') }}"
                        class="ml-2 px-4 py-2 text-sm font-medium text-white
                        bg-orange-500 rounded-md hover:bg-orange-600">
                        Register
                    </a>
                @endguest
            </div>

            <!-- Hamburger -->
            <div class="flex items-center sm:hidden">
                <button @click="open = !open"
                    class="p-2 rounded-md text-gray-500 hover:bg-gray-100">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }"
                            class="inline-flex" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }"
                            class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
</nav>
