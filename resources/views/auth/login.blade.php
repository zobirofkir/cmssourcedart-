<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="max-w-md mx-auto bg-white dark:bg-gray-800 shadow-md rounded-lg p-8 mt-10">
        <h2 class="text-center text-2xl font-bold text-gray-900 dark:text-gray-100 mb-6">
            {{ __('Login to Your Account') }}
        </h2>
        
        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf

            <!-- Email Address -->
            <div class="relative">
                <x-input-label for="email" :value="__('Email')" class="text-gray-700 dark:text-gray-300" />
                <x-text-input id="email" class="block mt-1 w-full bg-gray-50 dark:bg-gray-700 border-gray-300 dark:border-gray-600 focus:ring-indigo-500 focus:border-indigo-500 transition duration-300 ease-in-out transform hover:scale-105" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="relative mt-4">
                <x-input-label for="password" :value="__('Password')" class="text-gray-700 dark:text-gray-300" />
                <x-text-input id="password" class="block mt-1 w-full bg-gray-50 dark:bg-gray-700 border-gray-300 dark:border-gray-600 focus:ring-indigo-500 focus:border-indigo-500 transition duration-300 ease-in-out transform hover:scale-105" type="password" name="password" required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me -->
            <div class="flex items-center justify-between mt-4">
                <label for="remember_me" class="inline-flex items-center text-gray-600 dark:text-gray-400">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 dark:bg-gray-700 dark:border-gray-600 text-indigo-600 focus:ring-indigo-500 transition ease-in-out duration-150" name="remember">
                    <span class="ml-2">{{ __('Remember me') }}</span>
                </label>
                
                <div>
                    @if (Route::has('password.request'))
                        <a class="underline text-sm text-indigo-600 dark:text-indigo-400 hover:text-indigo-900 dark:hover:text-indigo-100 transition duration-200 ease-in-out" href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif
                </div>
            </div>

            <!-- Login Button -->
            <div class="flex items-center justify-center mt-6">
                <x-primary-button class="w-full flex justify-center text-center py-2 bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-4 focus:ring-indigo-300 dark:focus:ring-indigo-900 transition duration-300 ease-in-out transform hover:scale-105">
                    {{ __('Log in') }}
                </x-primary-button>
            </div>
            
            <!-- Register Link -->
            <div class="flex items-center justify-center mt-4">
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    {{ __('Don\'t have an account?') }} 
                    <a href="{{ url('/register') }}" class="underline text-indigo-600 dark:text-indigo-400 hover:text-indigo-900 dark:hover:text-indigo-100 transition duration-200 ease-in-out">
                        {{ __('Register here') }}
                    </a>
                </p>
            </div>
        </form>
    </div>
</x-guest-layout>
