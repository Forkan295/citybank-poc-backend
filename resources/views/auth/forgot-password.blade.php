<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                @if (request()->getHost() == config('app.sub_domain'))
                    <img src="{{ asset('assets/img/pwa_logo.jpeg') }}" alt="Logo">
                @else
                    <img src="{{ asset('assets/img/OAuth2_logo.jpeg') }}" alt="Logo">
                @endif
            </a>
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
            <div class="bg-white sm:px-2">
                <div class="col-span-12 sm:col-span-3">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" id="email" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value="{{ old('email') }}" required autofocus>
                </div>
            </div>

            <div class="py-2 bg-gray-50 text-right sm:px-2">
                <button type="submit" class="bg-indigo-600 border border-transparent rounded-md shadow-sm py-2 px-4 inline-flex justify-center text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">{{ __('Email Password Reset Link') }}</button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
