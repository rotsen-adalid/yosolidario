<x-guest-layout>
    <x-slot name="title">
        {{__('Forgot your password?')}} : YoSolidario
    </x-slot>
    <div class="md:min-h-screen md:flex md:flex-col md:justify-center md:items-center py-20 md:-mt-10 bg-gray-50">
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <div class="mb-4 text-sm text-gray-600 mt-5">
            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
        </div>

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="block">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button>
                    <span class="font-bold">{{ __('Email Password Reset Link') }}</span>
                </x-button>
            </div>
        </form>
    </x-authentication-card>
    </div>
    <livewire:footer.footer-guest/>
</x-guest-layout>
