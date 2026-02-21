<x-guest-layout>
    <x-slot:title> {{ __('Verify Email') }} </x-slot:title>
    
    <div class="mb-6 p-4 bg-blue-50 border border-blue-200 rounded-lg">
        <p class="text-sm text-gray-700">
            {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
        </p>
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 p-4 bg-green-50 border border-green-200 rounded-lg">
            <p class="font-medium text-sm text-green-800">
                {{ __('A new verification link has been sent to the email address you provided during registration.') }}
            </p>
        </div>
    @endif

    <div class="flex flex-col gap-4 pt-4">
        <form method="POST" action="{{ route('verification.send') }}" class="w-full">
            @csrf
            <x-primary-button class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-6 rounded-lg transition justify-center">
                {{ __('Resend Verification Email') }}
            </x-primary-button>
        </form>

        <form method="POST" action="{{ route('logout') }}" class="w-full">
            @csrf
            <button type="submit" class="w-full text-sm text-gray-600 hover:text-gray-800 border border-gray-300 rounded-lg py-2 px-4 transition font-medium">
                {{ __('Log Out') }}
            </button>
        </form>
    </div>
</x-guest-layout>
