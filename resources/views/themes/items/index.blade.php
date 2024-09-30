<x-app-layout>
    <div class="w-full h-full p-4">
        <h2 class="text-xl font-semibold mb-4 dark:text-white text-black text-center font-bold">HTML Files List</h2>

        <!-- Form to create a new HTML file -->
        <div class="mb-4">
            <form action="{{ route('item.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label for="file_name" class="block text-sm font-medium text-gray-700 dark:text-gray-400">File Name</label>
                    <input type="text" name="file_name" id="file_name" required class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-100">
                </div>

                <div class="flex">
                    <button type="submit" class="inline-flex whitespace-nowrap justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 dark:bg-indigo-800 dark:hover:bg-indigo-900">
                        Create HTML File
                    </button>

                    <div class="flex justify-end w-full">
                        <button onclick="openRestoreModal()" class="inline-flex whitespace-nowrap  justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 dark:bg-green-800 dark:hover:bg-green-900">
                            Restore Trashed Files
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Display Files List -->
        <h3 class="text-lg font-semibold mb-4 dark:text-white text-black">Active Files</h3>
        <div class="overflow-x-auto mb-4">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-800">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                            File Name
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-900 dark:divide-gray-700">
                    @foreach ($filesList as $file)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">
                                {{ $file['name'] }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="{{ route('item.edit', $file['name']) }}" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300">
                                    Edit
                                </a>
                                    <form action="{{ route('item.delete', $file['name']) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300 ml-4">
                                            Delete
                                        </button>
                                    </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <!-- Modal for Restoring Files -->
        <div id="restoreModal" class="fixed inset-0 flex items-center justify-center z-50 hidden bg-black bg-opacity-50">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 w-11/12 md:w-1/2">
                <h3 class="text-lg font-semibold mb-4 dark:text-white text-black">Trashed Files</h3>
                <div class="overflow-x-auto mb-4">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-800">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                    File Name
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-900 dark:divide-gray-700">
                            @foreach ($trashFiles as $file)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">
                                        {{ $file }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <form action="{{ route('item.restore', $file) }}" method="GET" style="display:inline-block;">
                                            @csrf
                                            <button type="submit" class="text-green-600 hover:text-green-900 dark:text-green-400 dark:hover:text-green-300">
                                                Restore
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <button onclick="closeRestoreModal()" class="mt-4 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-gray-600 hover:bg-gray-700 dark:bg-gray-800 dark:hover:bg-gray-900">
                    Close
                </button>
            </div>
        </div>
    </div>

    <!-- JavaScript to handle modal -->
    <script>
        function openRestoreModal() {
            document.getElementById('restoreModal').classList.remove('hidden');
        }

        function closeRestoreModal() {
            document.getElementById('restoreModal').classList.add('hidden');
        }
    </script>
</x-app-layout>
