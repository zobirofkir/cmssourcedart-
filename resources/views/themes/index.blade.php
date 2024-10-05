<x-app-layout>
    <div class="container mx-auto mt-10">

        <!-- Section for adding a new theme -->
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg mb-8">
            <h2 class="text-2xl font-semibold text-gray-900 dark:text-gray-100 mb-4 text-center">Add New Theme</h2>
            <form action="{{ route('themes.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label for="day" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Day</label>
                    <select name="day" id="day" class="mt-1 p-2 border border-gray-300 rounded-lg w-full" required>
                        <option value="">Select a Day</option>
                        @foreach ($existingDays as $existingDay)
                            <option value="{{ $existingDay }}">{{ $existingDay }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label for="theme" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Theme Number</label>
                    <input type="number" name="theme" id="theme" class="mt-1 p-2 border border-gray-300 rounded-lg w-full" required>
                </div>
                <div class="mb-4">
                    <label for="image" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Upload Image</label>
                    <input type="file" name="image" id="image" class="mt-1 p-2 border border-gray-300 rounded-lg w-full" required>
                </div>
                <button type="submit" class="w-full px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition duration-200">
                    Add Theme
                </button>
            </form>
        </div>

        <!-- Button to toggle the add day form -->
        <div class="flex justify-center mb-8">
            <button id="toggle-add-day" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition duration-200">
                Add New Day
            </button>
        </div>

        <!-- Section for adding a new day (initially hidden) -->
        <div id="add-day-form" class="hidden bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg mb-8">
            <h2 class="text-2xl font-semibold text-gray-900 dark:text-gray-100 mb-4 text-center">Add New Day</h2>
            <form action="{{ route('themes.createDay') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label for="day" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Day Name</label>
                    <input type="text" name="day" id="day" class="mt-1 p-2 border border-gray-300 rounded-lg w-full" required>
                </div>
                <div class="mb-4">
                    <label for="file" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Upload File</label>
                    <input type="file" name="file" id="file" class="mt-1 p-2 border border-gray-300 rounded-lg w-full" required>
                </div>
                <button type="submit" class="w-full px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition duration-200">
                    Add Day
                </button>
            </form>
        </div>

        <!-- Section to list and manage days -->
        <div id="days-list" class="hidden grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 mb-10">
            @foreach ($existingDays as $existingDay)
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300">
                    <h2 class="text-2xl font-semibold text-gray-900 dark:text-gray-100 mb-4 text-center">{{ $existingDay }}</h2>
                    <form action="{{ route('themes.destroyDay', ['day' => $existingDay]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this day?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 dark:text-red-400 hover:text-red-800 dark:hover:text-red-300 transition-colors duration-200">
                            Delete Day
                        </button>
                    </form>
                </div>
            @endforeach
        </div>

        <!-- Section to list and manage themes -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 mt-10">
            @foreach ($themes as $day => $themeFiles)
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300">
                    <h2 class="text-2xl font-semibold text-gray-900 dark:text-gray-100 mb-4 text-center">{{ $day }}</h2>
                    <ul class="space-y-2">
                        @foreach ($themeFiles as $theme)
                            <li class="flex items-center justify-between text-gray-700 dark:text-gray-300">
                                <a href="{{ route('themes.edit', ['day' => $day, 'theme' => basename($theme)]) }}"
                                   class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-500 transition-colors duration-200">
                                    {{ basename($theme) }}
                                </a>
                                <form action="{{ route('themes.destroy', ['day' => $day, 'theme' => basename($theme)]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this theme?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 dark:text-red-400 hover:text-red-800 dark:hover:text-red-300 transition-colors duration-200">
                                        Delete
                                    </button>
                                </form>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>

    </div>

    <!-- JavaScript to toggle the visibility of "Add New Day" section -->
    <script>
        document.getElementById('toggle-add-day').addEventListener('click', function() {
            const addDayForm = document.getElementById('add-day-form');
            const daysList = document.getElementById('days-list');
            
            // Toggle visibility of the form and days list
            addDayForm.classList.toggle('hidden');
            daysList.classList.toggle('hidden');
        });
    </script>
</x-app-layout>
