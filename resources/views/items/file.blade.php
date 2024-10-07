<x-app-layout>
    <div class="container mx-auto p-6 bg-white rounded-lg shadow-md max-w-4xl mt-10">
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                {{ session('success') }}
            </div>
        @elseif(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                {{ session('error') }}
            </div>
        @endif

        <h2 class="text-2xl font-semibold text-gray-800 mb-6">Edit CSS File Properties</h2>

        <form action="{{ route('file.update', ['file' => 1]) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Hidden input for file path -->
            <input type="hidden" name="filePath" value="{{ $filePath }}">

            <!-- Base List Styles Section -->
            <div class="mb-6">
                <h3 class="text-lg font-medium text-gray-700 mb-2">Base List Styles</h3>
            
                @foreach(['top', 'right', 'bottom', 'left'] as $property)
                    <label class="block text-gray-700 text-sm font-bold mb-2">{{ ucfirst(str_replace('_', ' ', $property)) }}:</label>
                    <input type="text" name="listliks_{{ $property }}" value="{{ old('listliks_' . $property, $stylesArray[$property] ?? '') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @endforeach
                
                <h3 class="text-lg font-medium text-gray-700 mb-2">List Items Styles</h3>
                
                <label class="block text-gray-700 text-sm font-bold mb-2">Margin Bottom:</label>
                <input type="text" name="listliks_li_margin_bottom" value="{{ old('listliks_li_margin_bottom', $listItemsStylesArray['margin-bottom'] ?? '') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            
                <label class="block text-gray-700 text-sm font-bold mb-2">Width:</label>
                <input type="text" name="listliks_li_width" value="{{ old('listliks_li_width', $listItemsStylesArray['width'] ?? '') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            
                <h3 class="text-lg font-medium text-gray-700 mb-2">Button Poster Styles</h3>
            
                <label class="block text-gray-700 text-sm font-bold mb-2">Width:</label>
                <input type="text" name="btnPoster_width" value="{{ old('btnPoster_width', $btnPosterStylesArray['width'] ?? '') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            
                <label class="block text-gray-700 text-sm font-bold mb-2">Height:</label>
                <input type="text" name="btnPoster_height" value="{{ old('btnPoster_height', $btnPosterStylesArray['height'] ?? '') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            
                <label class="block text-gray-700 text-sm font-bold mb-2">Object Fit:</label>
                <input type="text" name="btnPoster_object_fit" value="{{ old('btnPoster_object_fit', $btnPosterStylesArray['object-fit'] ?? '') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            
                <label class="block text-gray-700 text-sm font-bold mb-2">Justify Content:</label>
                <input type="text" name="btnPoster_justify_content" value="{{ old('btnPoster_justify_content', $btnPosterStylesArray['justify-content'] ?? '') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">            
            </div>
                                    
            <!-- Submit Button -->
            <div class="flex justify-end">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-200">
                    Update CSS
                </button>
            </div>
        </form>
    </div>

    <div class="listliks">
        <!-- Your list items go here -->
    </div>
</x-app-layout>
