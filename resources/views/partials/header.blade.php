<header class="bg-white border-b border-gray-200 shadow-sm sticky top-0 z-50">
    <nav x-data="{ mobileOpen: false }" class="container mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Desktop and Mobile Header -->
        <div class="flex items-center justify-between h-16">
            <!-- Logo -->
            <div class="shrink-0 flex-1">
                <a href="{{ route("index") }}" class="text-gray-800 font-bold text-xl hover:text-blue-600 transition">Bibliothèque</a>
            </div>

            <!-- Desktop Navigation Menu -->
            <div class="hidden md:flex items-baseline space-x-1">
                <a href="{{ route("index") }}" class="text-gray-600 hover:text-gray-800 hover:bg-gray-100 px-3 py-2 rounded-md text-sm font-medium transition">Accueil</a>
                <a href="{{ route("book.index") }}" class="text-gray-600 hover:text-gray-800 hover:bg-gray-100 px-3 py-2 rounded-md text-sm font-medium transition">Livres</a>
                <a href="{{ route("books") }}" class="text-gray-600 hover:text-gray-800 hover:bg-gray-100 px-3 py-2 rounded-md text-sm font-medium transition">Recherche</a>
                <a href="{{ route("about") }}" class="text-gray-600 hover:text-gray-800 hover:bg-gray-100 px-3 py-2 rounded-md text-sm font-medium transition">A propos</a>
                <a href="{{ route("contact") }}" class="text-gray-600 hover:text-gray-800 hover:bg-gray-100 px-3 py-2 rounded-md text-sm font-medium transition">Contact</a>
            </div>

            <!-- Desktop Auth Section -->
            <div class="hidden md:block ml-6">
                @include('layouts.navigation')
            </div>

            <!-- Mobile Hamburger Button -->
            <button @click="mobileOpen = !mobileOpen" class="md:hidden p-2 rounded-md text-gray-600 hover:text-gray-800 hover:bg-gray-100 focus:outline-none transition">
                <svg x-show="!mobileOpen" class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
                <svg x-show="mobileOpen" class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Mobile Navigation Menu -->
        <div x-show="mobileOpen" 
             x-transition
             @click.away="mobileOpen = false"
             class="md:hidden border-t border-gray-200">
            <div class="px-2 pt-2 pb-3 space-y-1">
                <a href="{{ route("index") }}" class="text-gray-600 hover:text-gray-800 hover:bg-gray-100 block px-3 py-2 rounded-md text-base font-medium transition" @click="mobileOpen = false">Accueil</a>
                <a href="{{ route("book.index") }}" class="text-gray-600 hover:text-gray-800 hover:bg-gray-100 block px-3 py-2 rounded-md text-base font-medium transition" @click="mobileOpen = false">Livres</a>
                <a href="{{ route("books") }}" class="text-gray-600 hover:text-gray-800 hover:bg-gray-100 block px-3 py-2 rounded-md text-base font-medium transition" @click="mobileOpen = false">Recherche</a>
                <a href="{{ route("about") }}" class="text-gray-600 hover:text-gray-800 hover:bg-gray-100 block px-3 py-2 rounded-md text-base font-medium transition" @click="mobileOpen = false">A propos</a>
                <a href="{{ route("contact") }}" class="text-gray-600 hover:text-gray-800 hover:bg-gray-100 block px-3 py-2 rounded-md text-base font-medium transition" @click="mobileOpen = false">Contact</a>
            </div>

            <!-- Mobile Auth Section -->
            <div class="border-t border-gray-200 px-2 py-2">
                @auth
                    <div class="px-3 py-2 font-semibold text-gray-800">
                        {{ Auth::user()->name }}
                    </div>
                    <div class="px-3 py-1 text-sm text-gray-600">
                        {{ Auth::user()->email }}
                    </div>
                    <a href="{{ route('profile.edit') }}" class="text-gray-600 hover:text-gray-800 hover:bg-gray-100 block px-3 py-2 rounded-md text-base font-medium transition mt-2" @click="mobileOpen = false">Profile</a>
                    <form method="POST" action="{{ route('logout') }}" class="mt-2">
                        @csrf
                        <button onclick="event.preventDefault(); this.closest('form').submit();" class="w-full text-left text-gray-600 hover:text-gray-800 hover:bg-gray-100 block px-3 py-2 rounded-md text-base font-medium transition">
                            Log Out
                        </button>
                    </form>
                @endauth

                @guest
                    <div class="flex flex-col space-y-2">
                        <a href="{{ route('register') }}" class="text-gray-600 hover:text-gray-800 hover:bg-gray-100 block px-3 py-2 rounded-md text-base font-medium text-center transition" @click="mobileOpen = false">
                            S'inscrire
                        </a>
                        <a href="{{ route('login') }}" class="bg-blue-600 text-white hover:bg-blue-700 block px-3 py-2 rounded-md text-base font-medium text-center transition" @click="mobileOpen = false">
                            Se connecter
                        </a>
                    </div>
                @endguest
            </div>
        </div>
    </nav>
</header>