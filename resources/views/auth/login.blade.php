<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <img src="{{ asset('assets/img/OAuth2_logo.jpeg') }}" alt="Logo">
            </a>
        </x-slot>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

           <!-- Email Address -->
            <div class="bg-white sm:p-2 py-4">
                <div class="col-span-12 sm:col-span-3">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" id="email" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value="{{ old('email') }}" required autofocus>
                </div>
            </div>

            <!-- Password -->
            <div class="bg-white sm:p-2 py-2">
                <div class="col-span-12 sm:col-span-3">
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" name="password" id="password" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required autocomplete="current-password">
                </div>
            </div>

            <!-- Remember Me -->
            <div class="bg-white sm:p-2">
                <div class="col-span-12 sm:col-span-3">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                        <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                    </label>
                </div>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-800" href="{{ route('password.request') }}">
                        {{ __('Forgot your password ?') }}
                    </a>
                @endif

                <div class="py-2 bg-gray-50 text-right sm:px-2">
                    <button type="submit" class="bg-indigo-600 border ml-2 border-transparent rounded-md shadow-sm py-2 px-4 inline-flex justify-center text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">{{ __('Login') }}</button>
                </div>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
