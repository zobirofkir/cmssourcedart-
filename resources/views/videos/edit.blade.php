<x-app-layout>
    <div class="container mx-auto mt-10">
        <h1 class="text-3xl font-bold mb-5 dark:text-white text-black">Edit Video: {{ $videoName }}</h1>
        
        <!-- Display success and error messages -->
        @if(session('success'))
            <div class="bg-green-500 text-white p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="bg-red-500 text-white p-4 rounded mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Update form to handle file uploads -->
        <form action="{{ route('videos.update', ['day' => $day, 'videoName' => $videoName]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Video Preview -->
            <div class="bg-white p-6 rounded-lg shadow-md mb-5">
                <h2 class="text-xl font-semibold mb-4">Video Preview</h2>
                <div class="border border-gray-300 p-4 rounded-lg bg-gray-50">
                    <video controls class="w-full max-w-md rounded-lg shadow-lg">
                        <source src="{{ asset('project/application/assets/videos/' . $day . '/' . $videoName) }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>
            </div>
                                    
            <!-- Video Upload -->
            <div class="mt-5">
                <label for="video" class="block text-sm font-medium text-gray-700 dark:text-white text-black">Upload New Video</label>
                <input type="file" name="video" id="video" class="mt-2 p-2 border border-gray-300 rounded-lg w-full dark:text-white text-black">
            </div>

            <!-- Action buttons -->
            <div class="mt-5">
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                    Save Changes
                </button>
                <a href="{{ route('videos.index') }}" class="ml-4 px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</x-app-layout>
