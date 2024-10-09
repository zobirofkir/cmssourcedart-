<nav x-data="{ open: false }" class="bg-white dark:bg-gray-900 border-b border-gray-200 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <div class="flex items-center">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-900 dark:text-gray-100" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="hover:text-indigo-500 dark:hover:text-indigo-400">
                        {{ __('Dashboard') }}
                    </x-nav-link>

                    <x-nav-link :href="route('projects.index')" :active="request()->routeIs('projects.index')" class="hover:text-indigo-500 dark:hover:text-indigo-400">
                        {{ __('Upload') }}
                    </x-nav-link>

                    <x-nav-link :href="route('items.index')" :active="request()->routeIs('items.index')" class="hover:text-indigo-500 dark:hover:text-indigo-400">
                        {{ __('Items') }}
                    </x-nav-link>

                    <!-- Reddifusion Dropdown -->
                    <div x-data="{ open: false }" class="relative inline-block">
                        <button @click="open = !open" class="inline-flex items-center justify-center text-gray-800 dark:text-gray-300 hover:text-indigo-500 dark:hover:text-indigo-400 focus:outline-none">
                                <x-nav-link class="hover:text-indigo-500 dark:hover:text-indigo-400">
                                    {{ __('Reddifusion') }}
                                </x-nav-link>        
                                <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                        </button>
                        
                        <!-- Dropdown Menu -->
                        <div x-show="open" @click.away="open = false" class="absolute right-0 bg-white dark:bg-gray-800 shadow-lg rounded-md mt-2 w-48 z-10">
                            <x-nav-link :href="route('themes.index')" :active="request()->routeIs('themes.index')" class="block flex justify-center py-2 text-gray-800 dark:text-gray-300 hover:bg-indigo-500 dark:hover:bg-indigo-400 hover:text-white w-full">
                                {{ __('Themes') }}
                            </x-nav-link>
                            <x-nav-link :href="route('videos.index')" :active="request()->routeIs('videos.index')" class="block flex justify-center py-2 text-gray-800 dark:text-gray-300 hover:bg-indigo-500 dark:hover:bg-indigo-400 hover:text-white w-full">
                                {{ __('Videos') }}
                            </x-nav-link>
                        </div>    
                    </div>
                    
                    <x-nav-link :href="route('programme.index')" :active="request()->routeIs('programme.index')" class="hover:text-indigo-500 dark:hover:text-indigo-400">
                        {{ __('Programme') }}
                    </x-nav-link>

                    <x-nav-link :href="url('eposter')" :active="request()->routeIs('eposter.index')" class="hover:text-indigo-500 dark:hover:text-indigo-400">
                        {{ __('E-Poster') }}
                    </x-nav-link>

                    <x-nav-link :href="url('album')" :active="request()->routeIs('eposter.index')" class="hover:text-indigo-500 dark:hover:text-indigo-400">
                        {{ __('Album') }}
                    </x-nav-link>

                    <x-nav-link :href="route('project.export')" :active="request()->routeIs('project.export')" id="exportButton" class="hover:text-indigo-500 dark:hover:text-indigo-400">
                        {{ __('Export') }}
                    </x-nav-link>

                </div>
            </div>

            <!-- Right Side -->
            <div class="flex items-center ml-auto">
                <!-- Settings Dropdown -->
                <div class="hidden sm:flex sm:items-center sm:ms-6">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-800 hover:text-gray-800 dark:hover:text-gray-200 focus:outline-none transition ease-in-out duration-150">
                                <div>{{ Auth::user()->name }}</div>
                                <div class="ms-2">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')" class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                {{ __('Profile') }}
                            </x-dropdown-link>
                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault(); this.closest('form').submit();" class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-500 dark:text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-800 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="hover:bg-gray-100 dark:hover:bg-gray-800">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('projects.index')" :active="request()->routeIs('projects.index')" class="hover:bg-gray-100 dark:hover:bg-gray-800">
                {{ __('Upload') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('themes.index')" :active="request()->routeIs('themes.index')" class="hover:bg-gray-100 dark:hover:bg-gray-800">
                {{ __('Themes') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('videos.index')" :active="request()->routeIs('videos.index')" class="hover:bg-gray-100 dark:hover:bg-gray-800">
                {{ __('Videos') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('items.index')" :active="request()->routeIs('items.index')" class="hover:bg-gray-100 dark:hover:bg-gray-800">
                {{ __('Items') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('programme.index')" :active="request()->routeIs('programme.index')" class="hover:bg-gray-100 dark:hover:bg-gray-800">
                {{ __('Programme') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="url('eposter')" :active="request()->routeIs('eposter.index')" class="hover:bg-gray-100 dark:hover:bg-gray-800">
                {{ __('E-Poster') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('project.export')" :active="request()->routeIs('project.export')" class="hover:bg-gray-100 dark:hover:bg-gray-800">
                {{ __('Export') }}
            </x-responsive-nav-link>
        </div>
    </div>
</nav>
