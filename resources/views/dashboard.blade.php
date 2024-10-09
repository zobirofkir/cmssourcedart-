<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Dashboard Header -->
            <h1 class="text-4xl font-extrabold mb-10 dark:text-white text-gray-900 text-center">
                Welcome Back, {{ auth()->user()->name }}
            </h1>

            <!-- Main Content Section -->
            <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg overflow-hidden">
                <div class="p-8 text-gray-900 dark:text-gray-100">
                    
                    <!-- Greeting with User Name -->
                    <p class="text-xl font-semibold mb-6 text-center">
                        It's great to have you back, {{ auth()->user()->name }}!
                    </p>

                    <!-- Action Buttons Section -->
                    <div class="flex flex-col items-center space-y-4 md:flex-row md:justify-center md:space-y-0 md:space-x-6">
                        
                        <!-- GitHub Project Button -->
                        <a href="https://github.com/zobirofkir/cmssourcedart-" target="_blank" 
                           class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-lg shadow-lg transition-all duration-300">
                            Open Project in GitHub Codespaces
                        </a>

                        <!-- Local Project Button -->
                        <a href="{{ url('/project/index.html') }}" target="_blank" 
                           class="bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-3 rounded-lg shadow-lg transition-all duration-300">
                            Open Local Project
                        </a>
                    </div>

                    <!-- User Cards Section -->
                    <div class="grid grid-cols-1 gap-6 mt-10 sm:grid-cols-2 lg:grid-cols-3">
                        @foreach (App\Models\User::all() as $user)
                            <div class="bg-gray-100 dark:bg-gray-700 shadow-md rounded-lg p-6">
                                <h2 class="text-2xl font-semibold text-gray-900 dark:text-white mb-2">
                                    {{ $user->name }}
                                </h2>
                                <p class="text-gray-600 dark:text-gray-400">
                                    Email: {{ $user->email }}
                                </p>
                                <p class="text-gray-600 dark:text-gray-400">
                                    Joined: {{ $user->created_at->format('F j, Y') }}
                                </p>
                            </div>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
