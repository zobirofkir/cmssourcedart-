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
                        @foreach ($existingDaysThemes as $existingDay)
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

        <!-- Button to toggle the add Video form -->
        <div class="flex justify-center mb-8">
            <button id="toggle-add-day" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition duration-200">
                Add New Video
            </button>
        </div>

        <!-- Section for adding a new day (initially hidden) -->
        <div id="add-day-form" class="hidden bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg mb-8">
            <h2 class="text-2xl font-semibold text-gray-900 dark:text-gray-100 mb-4 text-center">Add New Video</h2>
            <form action="{{ route('videos.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Day Selection -->
                <div class="mb-4">
                    <label for="day" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Day</label>
                    <select name="day" id="day" class="mt-1 p-2 border border-gray-300 rounded-lg w-full" required>
                        <option value="">Select a Day</option>
                        @foreach ($existingDays as $existingDay)
                            <option value="{{ $existingDay }}">{{ $existingDay }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Theme Number Input -->
                <div class="mb-4">
                    <label for="theme" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Theme Number</label>
                    <input type="number" name="theme" id="theme" class="mt-1 p-2 border border-gray-300 rounded-lg w-full" required>
                </div>

                <!-- Video Source Choice -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Video Source</label>
                    <div class="mt-2 flex space-x-4">
                        <label class="flex items-center">
                            <input type="radio" name="video_source" value="upload" class="form-radio" onclick="toggleVideoSource('upload')" checked>
                            <span class="ml-2 text-black dark:text-white">Upload Video</span>
                        </label>
                        <label class="flex items-center">
                            <input type="radio" name="video_source" value="youtube" class="form-radio" onclick="toggleVideoSource('youtube')">
                            <span class="ml-2 text-black dark:text-white">YouTube URL</span>
                        </label>
                    </div>
                </div>

                <!-- Video Upload -->
                <div id="uploadVideoSection" class="mb-4">
                    <label for="video" class="block text-sm font-medium text-black dark:text-white">Upload Video</label>
                    <input type="file" name="video" id="video" class="mt-1 p-2 border border-white text-black dark:text-white rounded-lg w-full">
                </div>

                <!-- YouTube URL Input -->
                <div id="youtubeUrlSection" class="mb-4 hidden">
                    <label for="youtube_url" class="block text-sm font-medium text-black dark:text-white">YouTube URL</label>
                    <input type="text" name="youtube_url" id="youtube_url" class="mt-1 p-2 border border-white rounded-lg w-full">
                </div>

                <!-- Submit Button -->
                <button type="submit" class="w-full px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition duration-200">
                    Add Video
                </button>
            </form>
        </div>

        <!-- Section to list and manage days -->
        {{-- <div id="days-list" class="hidden grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 mb-10">
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
        </div> --}}

        <!-- Section to list and manage themes -->
        <div class="flex flex-col md:flex-row gap-8 mt-10">
            <!-- Left Side: Content Section -->
            <div class="flex-1 bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg">
                <h2 class="text-2xl font-semibold text-gray-900 dark:text-gray-100 mb-6">Themes Section</h2>
                
                <ul class="space-y-4">
                    @foreach ($themes as $day => $themeFiles)
                    <li class="bg-gray-100 dark:bg-gray-700 p-5 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300">
                        <h2 class="text-2xl font-semibold text-gray-900 dark:text-gray-100 mb-4 text-center border-b border-gray-300 dark:border-gray-600 pb-2 cursor-pointer" onclick="toggleDropdown('{{ $day }}')">
                            {{ $day }}
                        </h2>
                        
                        <ul id="{{ $day }}" class="hidden space-y-2 mt-4">
                            @foreach ($themeFiles as $theme)
                                <li class="flex items-center justify-between bg-white dark:bg-gray-800 p-4 rounded-lg shadow-md hover:bg-gray-50 dark:hover:bg-gray-600 transition-all duration-300">
                                    <a href="{{ route('themes.edit', ['day' => $day, 'theme' => basename($theme)]) }}"
                                    class="text-indigo-600 dark:text-indigo-400 font-medium hover:text-indigo-800 dark:hover:text-indigo-500 transition-colors duration-200">
                                        {{ basename($theme) }}
                                    </a>
                                    <form action="{{ route('themes.destroy', ['day' => $day, 'theme' => basename($theme)]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this theme?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 dark:text-red-400 font-medium hover:text-red-800 dark:hover:text-red-300 transition-colors duration-200">
                                            Delete
                                        </button>
                                    </form>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                    @endforeach
                </ul>
            </div>
            
                    
            <!-- Right Side: Videos Section -->
            <div class="flex-1 bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg">
                <h2 class="text-2xl font-semibold text-gray-900 dark:text-gray-100 mb-6">Videos Section</h2>
                
                @foreach ($videoFiles as $day => $dayVideoFiles)
                <div class="bg-gray-100 dark:bg-gray-700 p-5 mb-6 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300">
                    <h2 class="text-2xl font-semibold text-gray-900 dark:text-gray-100 mb-4 text-center border-b border-gray-300 dark:border-gray-600 pb-2 cursor-pointer" onclick="toggleVideoDropdown('{{ $day }}')">
                        {{ $day }}
                    </h2>
                    
                    <ul id="video-{{ $day }}" class="hidden space-y-4 mt-4">
                        @foreach ($dayVideoFiles as $video)
                        <li class="flex items-center justify-between bg-white dark:bg-gray-800 p-4 rounded-lg shadow-md hover:bg-gray-50 dark:hover:bg-gray-600 transition-all duration-300">
                            <a href="{{ route('videos.edit', ['day' => $day, 'videoName' => basename($video)]) }}"
                            class="text-indigo-600 dark:text-indigo-400 font-medium hover:text-indigo-800 dark:hover:text-indigo-500 transition-colors duration-200">
                                {{ basename($video) }}
                            </a>
                            <form action="{{ route('videos.destroy', ['day' => $day, 'videoName' => basename($video)]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this video?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 dark:text-red-400 font-medium hover:text-red-800 dark:hover:text-red-300 transition-colors duration-200">
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

    <script>
        function toggleVideoSource(source) {
            if (source === 'upload') {
                document.getElementById('uploadVideoSection').classList.remove('hidden');
                document.getElementById('youtubeUrlSection').classList.add('hidden');
            } else if (source === 'youtube') {
                document.getElementById('uploadVideoSection').classList.add('hidden');
                document.getElementById('youtubeUrlSection').classList.remove('hidden');
            }
        }
    </script>

    <script>
        function toggleDropdown(day) {
            const dropdown = document.getElementById(day);
            dropdown.classList.toggle('hidden');
        }
    </script>

    <script>
        function toggleVideoDropdown(day) {
            const dropdown = document.getElementById(`video-${day}`);
            dropdown.classList.toggle('hidden');
        }
    </script>

</x-app-layout>
