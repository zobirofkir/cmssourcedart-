<x-guest-layout>
    <div class="max-w-md mx-auto bg-white dark:bg-gray-800 shadow-md rounded-lg p-8 mt-10">
        <h2 class="text-center text-2xl font-bold text-gray-900 dark:text-gray-100 mb-6">
            {{ __('Create Your Account') }}
        </h2>

        <form method="POST" action="{{ route('register') }}" class="space-y-6">
            @csrf

            <!-- Name -->
            <div class="relative">
                <x-input-label for="name" :value="__('Name')" class="text-gray-700 dark:text-gray-300" />
                <x-text-input id="name" class="block mt-1 w-full bg-gray-50 dark:bg-gray-700 border-gray-300 dark:border-gray-600 focus:ring-indigo-500 focus:border-indigo-500 transition duration-300 ease-in-out transform hover:scale-105" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div class="relative mt-4">
                <x-input-label for="email" :value="__('Email')" class="text-gray-700 dark:text-gray-300" />
                <x-text-input id="email" class="block mt-1 w-full bg-gray-50 dark:bg-gray-700 border-gray-300 dark:border-gray-600 focus:ring-indigo-500 focus:border-indigo-500 transition duration-300 ease-in-out transform hover:scale-105" type="email" name="email" :value="old('email')" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="relative mt-4">
                <x-input-label for="password" :value="__('Password')" class="text-gray-700 dark:text-gray-300" />
                <x-text-input id="password" class="block mt-1 w-full bg-gray-50 dark:bg-gray-700 border-gray-300 dark:border-gray-600 focus:ring-indigo-500 focus:border-indigo-500 transition duration-300 ease-in-out transform hover:scale-105" type="password" name="password" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="relative mt-4">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-gray-700 dark:text-gray-300" />
                <x-text-input id="password_confirmation" class="block mt-1 w-full bg-gray-50 dark:bg-gray-700 border-gray-300 dark:border-gray-600 focus:ring-indigo-500 focus:border-indigo-500 transition duration-300 ease-in-out transform hover:scale-105" type="password" name="password_confirmation" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <!-- Register Button -->
            <div class="flex flex-col items-center justify-between mt-6">
                <x-primary-button class="w-full flex justify-center mt-4 py-2 bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-4 focus:ring-indigo-300 dark:focus:ring-indigo-900 transition duration-300 ease-in-out transform hover:scale-105">
                    {{ __('Register') }}
                </x-primary-button>

                <a class="underline mt-5 text-sm text-indigo-600 dark:text-indigo-400 hover:text-indigo-900 dark:hover:text-indigo-100 transition duration-200 ease-in-out" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

            </div>
        </form>
    </div>
</x-guest-layout>
