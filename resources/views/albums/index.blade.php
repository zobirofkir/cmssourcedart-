<x-app-layout>
    <div class="container mx-auto mt-10 p-4 sm:p-6">

        <!-- Session Messages -->
        @if (session('error'))
            <div class="bg-red-500 text-white p-4 rounded-lg mb-6 shadow-lg">
                {{ session('error') }}
            </div>
        @endif

        @if (session('success'))
            <div class="bg-green-500 text-white p-4 rounded-lg mb-6 shadow-lg">
                {{ session('success') }}
            </div>
        @endif

        <!-- Section for Adding a New Album -->
        <div class="bg-gray-100 dark:bg-gray-800 p-8 rounded-xl shadow-md mb-10">
            <h2 class="text-3xl font-bold text-gray-900 dark:text-gray-100 mb-6 text-center">Add New Album</h2>
            <form action="{{ route('album.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="space-y-6">
                    <!-- Album Number Input -->
                    {{-- <div>
                        <label for="theme" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Theme Number</label>
                        <input type="number" name="theme" id="theme" class="mt-2 p-3 border border-gray-300 dark:border-gray-700 rounded-lg w-full focus:ring-2 focus:ring-blue-500 dark:bg-gray-900 dark:text-gray-100 text-gray-800" required>
                    </div>
 --}}
                    <!-- Image Upload -->
                    <div>
                        <label for="image" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Upload Image</label>
                        <input type="file" name="image[]" id="image" class="mt-2 p-3 border border-gray-300 dark:border-gray-700 rounded-lg w-full dark:bg-gray-900 dark:text-gray-100 text-gray-800" required multiple>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="w-full py-3 bg-blue-600 text-white rounded-lg font-medium hover:bg-blue-700 transition duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        Add Album
                    </button>
                </div>
            </form>
        </div>

        <!-- Section for Displaying Albums -->
        <h2 class="text-3xl font-bold text-gray-900 dark:text-gray-100 mb-6 text-center">Albums</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @if ($albums && count($albums) > 0)
                @foreach ($albums as $day => $images)
                    <div class="col-span-full">
                        <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-4 text-center">{{ $day }}</h3>
                    </div>
                    @foreach ($images as $image)
                        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
                            <img src="{{ $image }}" alt="Image" class="w-full h-64 object-cover rounded-lg mb-4 transition-transform duration-300 transform hover:scale-105">
                            <div class="flex justify-between items-center">
                                <a href="{{ $image }}" class="text-indigo-600 dark:text-indigo-400 font-medium hover:text-indigo-800 dark:hover:text-indigo-500 transition-colors duration-200">
                                    View Image
                                </a>
                                <form action="{{ route('album.destroy', ['albumName' => $albumName]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this album?');">

                                @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 dark:text-red-400 hover:text-red-800 dark:hover:text-red-300 transition-colors duration-200">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                @endforeach
            @else
                <p class="text-gray-700 dark:text-gray-300 text-center col-span-full">No albums available.</p>
            @endif
        </div>
    </div>
</x-app-layout>
