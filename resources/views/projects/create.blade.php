<x-app-layout>
    <x-slot name="header">
        <h1 class="text-2xl font-semibold text-gray-900 dark:text-gray-100">Upload Project</h1>
    </x-slot>

    <div class="py-6 px-4 max-w-2xl mx-auto">
        <div class="bg-white shadow-md rounded-lg p-6 dark:bg-gray-800">
            <form action="{{ route('projects.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf

                <div>
                    <label for="file" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Choose a ZIP file to upload</label>
                    <input type="file" name="file" id="file" required
                        class="mt-1 block w-full text-sm text-gray-800 dark:text-gray-100 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-400 dark:focus:border-blue-400">
                </div>

                <div>
                    <button type="submit"
                        class="inline-flex items-center px-4 py-2 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-400">
                        Upload
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
