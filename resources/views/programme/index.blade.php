<x-app-layout>
    <div class="container mx-auto mt-10">
        <!-- Section for adding a new PDF -->
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg mb-8">
            <h2 class="text-2xl font-semibold text-gray-900 dark:text-gray-100 mb-4 text-center">Add New PDF</h2>
            <form action="{{ route('programme.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label for="pdf" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Upload PDF</label>
                    <input type="file" name="pdf" id="pdf" class="mt-1 p-2 border border-gray-300 rounded-lg w-full dark:text-white text-black" required>
                </div>
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                    Add PDF
                </button>
            </form>
        </div>

        <!-- Section to list and manage PDFs -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach ($pdfs as $pdfName => $pdfPath)
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300">
                    <h2 class="text-2xl font-semibold text-gray-900 dark:text-gray-100 mb-4 text-center font-bold">{{ $pdfName }}</h2>
                    <ul class="space-y-2">
                        <li class="flex items-center justify-between text-gray-700 dark:text-gray-300">
                            <a href="{{ route('programme.edit', ['pdfName' => $pdfName]) }}"
                               class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-500 transition-colors duration-200">
                                {{ $pdfName }}
                            </a>
                            <form action="{{ route('programme.destroy', ['pdfName' => $pdfName]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this PDF?');">
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
