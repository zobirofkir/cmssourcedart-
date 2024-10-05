<x-app-layout>
    <div class="container mx-auto mt-10">
        <!-- Section for adding a new theme -->
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg mb-8">
            <h2 class="text-2xl font-semibold text-gray-900 dark:text-gray-100 mb-4 text-center">Add New Item</h2>
            <form action="{{ route('items.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label for="image" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Upload Image</label>
                    <input type="file" name="image" id="image" class="mt-1 p-2 border border-gray-300 rounded-lg w-full dark:text-white text-black" required>
                </div>
            
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Item Name</label>
                    <input type="number" name="name" id="name" class="mt-1 p-2 border border-gray-300 rounded-lg w-full" required>
                </div>
            
                <div class="mb-4">
                    <label for="category" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Select Category</label>
                    <select name="category" id="category" class="mt-1 p-2 border border-gray-300 rounded-lg w-full text-black">
                        <option value="e-poster">e-poster</option>
                        <option value="reddifusion">reddifusion</option>
                        <option value="programme">programme</option>
                    </select>
                </div>
                                                            
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                    Add Item
                </button>
            </form>                        
        </div>

        <!-- Section to list and manage items -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach ($items as $itemName => $itemPath)
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300">
                    <h2 class="text-2xl font-semibold text-gray-900 dark:text-gray-100 mb-4 text-center font-bold">{{ $itemName }}</h2>
                    <ul class="space-y-2">
                        <li class="flex items-center justify-between text-gray-700 dark:text-gray-300">
                            <a href="{{ route('items.edit', ['itemName' => $itemName]) }}"
                               class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-500 transition-colors duration-200">
                                {{ $itemName }}
                            </a>
                            <form action="{{ route('items.destroy', ['itemName' => $itemName]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this item?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 dark:text-red-400 hover:text-red-800 dark:hover:text-red-300 transition-colors duration-200">
                                    Delete
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
