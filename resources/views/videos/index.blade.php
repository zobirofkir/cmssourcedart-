<x-app-layout>
    <div class="container mx-auto mt-10">

        <!-- Section for adding a new video -->
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg mb-8">
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

                <!-- Video Upload -->
                <div class="mb-4">
                    <label for="video" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Upload Video</label>
                    <input type="file" name="video" id="video" class="mt-1 p-2 border border-gray-300 rounded-lg w-full" required>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="w-full px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition duration-200">
                    Add Video
                </button>
            </form>
        </div>

        <!-- Section to list and manage videos -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 mt-10">
            @foreach ($videoFiles as $day => $videoFiles)
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300">
                    <h2 class="text-2xl font-semibold text-gray-900 dark:text-gray-100 mb-4 text-center">{{ $day }}</h2>
                    <ul class="space-y-2">
                        @foreach ($videoFiles as $video)
                            <li class="flex items-center justify-between text-gray-700 dark:text-gray-300">
                                <a href="{{ route('videos.edit', ['day' => $day, 'videoName' => basename($video)]) }}"
                                   class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-500 transition-colors duration-200">
                                    {{ basename($video) }}
                                </a>
                                <form action="{{ route('videos.destroy', ['day' => $day, 'videoName' => basename($video)]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this video?');">
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
</x-app-layout>
