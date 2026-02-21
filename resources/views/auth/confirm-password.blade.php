<x-guest-layout>
    <x-slot:title> {{ __('Confirm Password') }} </x-slot:title>
    
    <div class="mb-6 p-4 bg-yellow-50 border border-yellow-200 rounded-lg">
        <p class="text-sm text-gray-700">
            {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
        </p>
    </div>

    <form method="POST" action="{{ route('password.confirm') }}" class="space-y-6">
        @csrf

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

        <div class="flex justify-end pt-4">
            <x-primary-button class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-6 rounded-lg transition">
                {{ __('Confirm') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
