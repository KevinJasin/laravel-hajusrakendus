<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center gap-6">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden sm:flex gap-2 text-sm">
                    <a href="{{ route('dashboard') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-3 py-1.5 rounded">🏠 Dashboard</a>
                    <a href="{{ route('weather') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1.5 rounded">🌤️ Weather</a>
                    <a href="{{ route('map') }}" class="bg-green-500 hover:bg-green-600 text-white px-3 py-1.5 rounded">🗺️ Map</a>
                    <a href="{{ route('markers.list') }}" class="bg-green-400 hover:bg-green-500 text-white px-3 py-1.5 rounded">📍 Markers</a>
                    <a href="{{ route('blogs.index') }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1.5 rounded">📝 Blog</a>
                    <a href="{{ route('shop.index') }}" class="bg-indigo-500 hover:bg-indigo-600 text-white px-3 py-1.5 rounded">🛒 Shop</a>
                    <a href="{{ route('cart.index') }}" class="bg-indigo-400 hover:bg-indigo-500 text-white px-3 py-1.5 rounded">🧾 Cart</a>
                    <a href="{{ route('checkout.form') }}" class="bg-indigo-300 hover:bg-indigo-400 text-white px-3 py-1.5 rounded">💳 Checkout</a>
                    <a href="{{ route('subjects.list') }}" class="bg-pink-500 hover:bg-pink-600 text-white px-3 py-1.5 rounded">📚 Subjects</a>
                    <a href="{{ route('subjects.create') }}" class="bg-pink-400 hover:bg-pink-500 text-white px-3 py-1.5 rounded">➕ Add Subject</a>
                </div>


            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden px-4 pb-4">
        <div class="pt-2 pb-3 space-y-2">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            <a href="{{ route('weather') }}" class="block text-blue-600 hover:underline">🌤️ Weather</a>
            <a href="{{ route('map') }}" class="block text-green-600 hover:underline">🗺️ Map</a>
            <a href="{{ route('blogs.index') }}" class="block text-yellow-600 hover:underline">📝 Blog</a>
            <a href="{{ route('shop.index') }}" class="block text-indigo-600 hover:underline">🛒 Shop</a>
            <a href="{{ route('cart.index') }}" class="block text-indigo-500 hover:underline">🧾 Cart</a>
            <a href="{{ route('checkout.form') }}" class="block text-indigo-400 hover:underline">💳 Checkout</a>
            <a href="{{ route('subjects.list') }}" class="block text-pink-600 hover:underline">📚 Subjects</a>
            <a href="{{ route('subjects.create') }}" class="block text-pink-500 hover:underline">➕ Add Subject</a>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
