<x-app-layout>
    <div class="container mx-auto mt-10">
        <!-- Section for uploading a new image -->
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg mb-8">
            <h2 class="text-2xl font-semibold text-gray-900 dark:text-gray-100 mb-4 text-center">Upload New Image</h2>
            <form action="{{ route('eposter.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label for="image" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Select Image</label>
                    <input type="file" name="image" id="image" class="mt-1 p-2 border border-gray-300 rounded-lg w-full dark:text-white text-black" required>
                </div>
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                    Upload Image
                </button>
            </form>
        </div>

        <!-- Section to list and manage e-posters -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach ($images as $imageName)
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300">
                    <h2 class="text-2xl font-semibold text-gray-900 dark:text-gray-100 mb-4 text-center">{{ $imageName }}</h2>
                    <div class="border border-gray-300 p-4 rounded-lg bg-gray-50 dark:bg-gray-800">
                        <img src="{{ asset('project/application/e-poster/images/' . $imageName) }}" alt="{{ $imageName }}" class="w-full max-w-md rounded-lg shadow-md">
                    </div>
                    <div class="mt-4 flex justify-center space-x-4">
                        <a href="{{ route('eposter.edit', ['imageName' => $imageName]) }}" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                            Edit
                        </a>
                        <form action="{{ route('eposter.destroy', ['imageName' => $imageName]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this image?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-4 py-2 text-red-600 dark:text-red-400 hover:text-red-800 dark:hover:text-red-300">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
