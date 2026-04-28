<nav class="flex items-center space-x-4">
    @auth
    <!-- Desktop Auth Section -->
    <div class="hidden sm:flex sm:items-center sm:ms-6 space-x-4">
            <!-- Desktop Navigation Menu -->
            <div class="hidden md:flex items-baseline space-x-1">
                <a href="{{ route("index") }}" class="text-gray-600 hover:text-gray-800 hover:bg-gray-100 px-3 py-2 rounded-md text-sm font-medium transition">{{ __('messages.home') }}</a>
                <a href="{{ route("book.index") }}" class="text-gray-600 hover:text-gray-800 hover:bg-gray-100 px-3 py-2 rounded-md text-sm font-medium transition">{{ __('messages.books') }}</a>
                <a href="{{ route("books") }}" class="text-gray-600 hover:text-gray-800 hover:bg-gray-100 px-3 py-2 rounded-md text-sm font-medium transition">{{ __('messages.search') }}</a>
                <a href="{{ route("about") }}" class="text-gray-600 hover:text-gray-800 hover:bg-gray-100 px-3 py-2 rounded-md text-sm font-medium transition">{{ __('messages.about_us') }}</a>
                <a href="{{ route("contact") }}" class="text-gray-600 hover:text-gray-800 hover:bg-gray-100 px-3 py-2 rounded-md text-sm font-medium transition">{{ __('messages.contact_us') }}</a>
            </div>

            <!-- Language Switcher -->
            <x-dropdown align="right" width="48">
                <x-slot name="trigger">
                    <button class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-600 hover:text-gray-800 transition rounded-md hover:bg-gray-100 uppercase">
                        {{ App::getLocale() }}
                        <svg class="ml-1 h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </x-slot>
                <x-slot name="content">
                    <x-dropdown-link :href="route('lang', 'en')">English</x-dropdown-link>
                    <x-dropdown-link :href="route('lang', 'fr')">Français</x-dropdown-link>
                </x-slot>
            </x-dropdown>

            <x-dropdown align="right" width="48">
                <x-slot name="trigger">
                    <button
                        class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-600 hover:text-gray-800 transition rounded-md hover:bg-gray-100">
                        <span>{{ Auth::user()->name }}</span>

                        <svg class="ml-2 h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                </x-slot>

                <x-slot name="content">
                    <x-dropdown-link :href="route('profile.edit')">
                        {{ __('messages.profile') }}
                    </x-dropdown-link>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-dropdown-link :href="route('logout')"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                            {{ __('messages.logout') }}
                        </x-dropdown-link>
                    </form>
                </x-slot>
            </x-dropdown>
        </div>
    @endauth

    @guest
        <div class="hidden sm:flex items-center space-x-3">
            <!-- Language Switcher -->
            <x-dropdown align="right" width="48">
                <x-slot name="trigger">
                    <button class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-600 hover:text-gray-800 transition rounded-md hover:bg-gray-100 uppercase">
                        {{ App::getLocale() }}
                        <svg class="ml-1 h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </x-slot>
                <x-slot name="content">
                    <x-dropdown-link :href="route('lang', 'en')">English</x-dropdown-link>
                    <x-dropdown-link :href="route('lang', 'fr')">Français</x-dropdown-link>
                </x-slot>
            </x-dropdown>

            <a href="{{ route('register') }}"
                class="text-gray-600 hover:text-gray-800 hover:bg-gray-100 px-3 py-2 rounded-md text-sm font-medium transition">
                {{ __('messages.register') }}
            </a>

            <a href="{{ route('login') }}"
                class="bg-blue-600 text-white hover:bg-blue-700 px-3 py-2 rounded-md text-sm font-medium transition">
                {{ __('messages.login') }}
            </a>
        </div>
    @endguest
</nav>