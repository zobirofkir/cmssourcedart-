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
        
                @foreach(['top', 'right','left'] as $property)
                    <label class="block text-gray-700 text-sm font-bold mb-2">{{ ucfirst(str_replace('_', ' ', $property)) }}:</label>
                    <input type="text" name="listliks_{{ $property }}" value="{{ old('listliks_' . $property, $stylesArray[$property] ?? '') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @endforeach
                
        
                <h3 class="text-lg font-medium text-gray-700 mb-2">Responsive Styles</h3>
        
                <label class="block text-gray-700 text-sm font-bold mb-2">Responsive Top:</label>
                <input type="text" name="responsive_top" value="{{ old('responsive_top') ?? '70%' }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        
                <label class="block text-gray-700 text-sm font-bold mb-2">Responsive Right:</label>
                <input type="text" name="responsive_right" value="{{ old('responsive_right') ?? '0px' }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        
        
                <label class="block text-gray-700 text-sm font-bold mb-2">Responsive Left:</label>
                <input type="text" name="responsive_left" value="{{ old('responsive_left') ?? '170px' }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
        
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Update Styles
            </button>
        </form>
                    
    </div>

    <div class="listliks">
        <!-- Your list items go here -->
    </div>
</x-app-layout>
