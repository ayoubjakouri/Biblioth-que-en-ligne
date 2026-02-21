<x-guest-layout>
    <x-slot:title> {{ __('Log in') }} </x-slot:title>
    
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email Address')" class="text-gray-700 font-medium" />
            <x-text-input id="email" 
                class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                type="email" 
                name="email" 
                :value="old('email')" 
                required 
                autofocus 
                autocomplete="username" 
                placeholder="you@example.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" class="text-gray-700 font-medium" />
            <x-text-input id="password" 
                class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                type="password"
                name="password"
                required 
                autocomplete="current-password" 
                placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center">
            <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500" name="remember">
            <label for="remember_me" class="ms-2 text-sm text-gray-600">
                {{ __('Remember me') }}
            </label>
        </div>

        <div class="flex items-center justify-between pt-4">
            @if (Route::has('password.request'))
                <a class="text-sm text-blue-600 hover:text-blue-800 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500" 
                    href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-6 rounded-lg transition">
                {{ __('Log in') }}
            </x-primary-button>
        </div>

        <div class="text-center pt-2">
            <p class="text-gray-600 text-sm">
                {{ __("Don't have an account?") }}
                <a href="{{ route('register') }}" class="text-blue-600 hover:text-blue-800 font-medium">{{ __('Register here') }}</a>
            </p>
        </div>
    </form>
</x-guest-layout>
