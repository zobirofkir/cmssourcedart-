<x-app-layout>
    <div class="container mx-auto mt-10">
        <h1 class="text-3xl font-bold mb-5 dark:text-white text-black">Edit PDF: {{ $pdfName }}</h1>
        
        <!-- Update form to handle file uploads -->
        <form action="{{ route('programme.update', ['pdfName' => $pdfName]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- PDF Preview -->
            <div class="bg-white p-6 rounded-lg shadow-md mb-5">
                <h2 class="text-xl font-semibold mb-4">PDF Preview</h2>
                <iframe src="{{ asset('project/application/assets/img/app/programme/' . $pdfName) }}" class="w-full h-96 border-2 border-gray-300 rounded-lg" frameborder="0"></iframe>
            </div>
                                
            <!-- File Upload -->
            <div class="mt-5">
                <label for="pdf" class="block text-sm font-medium text-gray-700 dark:text-white text-black">Upload New PDF</label>
                <input type="file" name="pdf" id="pdf" class="mt-2 p-2 border border-gray-300 rounded-lg w-full dark:text-white text-black">
            </div>

            <!-- Action buttons -->
            <div class="mt-5">
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                    Save Changes
                </button>
                <a href="{{ route('programme.index') }}" class="ml-4 px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</x-app-layout>
