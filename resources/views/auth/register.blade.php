<x-guest-layout>  
    <x-slot:title> {{ __('Register') }} </x-slot:title>
    
    <form method="POST" action="{{ route('register') }}" class="space-y-6">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Full Name')" class="text-gray-700 font-medium" />
            <x-text-input id="name" 
                class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                type="text" 
                name="name" 
                :value="old('name')" 
                required 
                autofocus 
                autocomplete="name" 
                placeholder="John Doe" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email Address')" class="text-gray-700 font-medium" />
            <x-text-input id="email" 
                class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                type="email" 
                name="email" 
                :value="old('email')" 
                required 
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
                autocomplete="new-password" 
                placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div>
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-gray-700 font-medium" />
            <x-text-input id="password_confirmation" 
                class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                type="password"
                name="password_confirmation" 
                required 
                autocomplete="new-password" 
                placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between pt-4">
            <a class="text-sm text-blue-600 hover:text-blue-800 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500" 
                href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-6 rounded-lg transition">
                {{ __('Create Account') }}
            </x-primary-button>
        </div>

        <div class="text-center pt-2 border-t border-gray-200">
            <p class="text-gray-600 text-sm mt-4">
                {{ __('By registering, you agree to our terms and conditions') }}
            </p>
        </div>
    </form>
</x-guest-layout>
