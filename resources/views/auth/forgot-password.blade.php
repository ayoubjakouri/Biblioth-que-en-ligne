<x-guest-layout>
    <x-slot:title> {{ __('Forgot Password') }} </x-slot:title>

    <div class="mb-6 p-4 bg-blue-50 border border-blue-200 rounded-lg">
        <p class="text-sm text-gray-700">
            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
        </p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
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
                placeholder="you@example.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between pt-4">
            <a href="{{ route('login') }}" class="text-sm text-blue-600 hover:text-blue-800">{{ __('Back to login') }}</a>
            <x-primary-button class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-6 rounded-lg transition">
                {{ __('Send Reset Link') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
