<x-app-layout>
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('Dashboard') }}
    </h2>
</x-slot>

<div class="container mx-auto mt-10">
    <h1 class="text-3xl font-bold mb-5 dark:text-white text-black">Edit Theme: {{ $theme }}</h1>
    
    <!-- Update form to handle file uploads -->
    <form action="{{ route('themes.update', ['day' => $day, 'theme' => $theme]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Textarea for editing theme content -->
        <div class="bg-white p-6 rounded-lg shadow-md mb-5">
            <h2 class="text-xl font-semibold mb-4">Theme Preview</h2>
            <div class="border border-gray-300 p-4 rounded-lg bg-gray-50">
                <img src="{{ asset('project/application/assets/thems/' . $day . '/' . $theme) }}" alt="{{ $theme }}" class="w-full max-w-md rounded-lg shadow-lg">
            </div>
        </div>
                                
        <!-- Image Upload -->
        <div class="mt-5">
            <label for="image" class="block text-sm font-medium text-gray-700 dark:text-white text-black">Upload New Image</label>
            <input type="file" name="image" id="image" class="mt-2 p-2 border border-gray-300 rounded-lg w-full dark:text-white text-black">
        </div>

        <!-- Action buttons -->
        <div class="mt-5">
            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                Save Changes
            </button>
            <a href="{{ route('themes.index') }}" class="ml-4 px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
                Cancel
            </a>
        </div>
    </form>
</div>

</x-app-layout>