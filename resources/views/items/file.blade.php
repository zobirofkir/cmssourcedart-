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
        
                @foreach(['top', 'right', 'left'] as $property)
                    <label class="block text-gray-700 text-sm font-bold mb-2">{{ ucfirst(str_replace('_', ' ', $property)) }}:</label>
                    <div class="flex items-center mb-2">
                        <input type="text" id="listliks_{{ $property }}" name="listliks_{{ $property }}" value="{{ old('listliks_' . $property, $stylesArray[$property] ?? '') }}" class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline w-full">
                        
                        <!-- Dropdown to choose unit (px or %) -->
                        <select id="unit_listliks_{{ $property }}" class="ml-2 border rounded py-2 px-[30px] text-gray-700 ">
                            <option value="px">px</option>
                            <option value="%">%</option>
                        </select>
                        
                        <button type="button" onclick="adjustValue('listliks_{{ $property }}', 'unit_listliks_{{ $property }}', -10)" class="ml-2 bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-1 px-2 rounded">-</button>
                        <button type="button" onclick="adjustValue('listliks_{{ $property }}', 'unit_listliks_{{ $property }}', 10)" class="ml-2 bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-1 px-2 rounded">+</button>
                    </div>
                @endforeach
        
                <label class="block text-gray-700 text-sm font-bold mb-2">Button Size:</label>
                <div class="flex items-center mb-2">
                    <input type="text" id="btnPoster_height" name="btnPoster_height" value="{{ old('btnPoster_height', $btnPosterHeight) }}" class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline w-full">
                                        
                    <!-- Dropdown to choose unit (px or %) -->
                    <select id="unit_btnPoster_height" class="ml-2 border rounded py-2 px-[30px] text-gray-700 px-4">
                        <option value="px" selected>px</option>
                        {{-- <option value="%">%</option> --}}
                    </select>
                    
                    <button type="button" onclick="adjustValue('btnPoster_height', 'unit_btnPoster_height', -10)" class="ml-2 bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-1 px-2 rounded">-</button>
                    <button type="button" onclick="adjustValue('btnPoster_height', 'unit_btnPoster_height', 10)" class="ml-2 bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-1 px-2 rounded">+</button>
                </div>

                <h3 class="text-lg font-medium text-gray-700 mb-2">Responsive Styles</h3>
        
                <label class="block text-gray-700 text-sm font-bold mb-2">Responsive Top:</label>
                <div class="flex items-center mb-2">
                    <input type="text" id="responsive_top" name="responsive_top" value="{{ old('responsive_top') ?? '70%' }}" class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline w-full">
                    
                    <!-- Dropdown to choose unit (px or %) -->
                    <select id="unit_responsive_top" class="ml-2 border rounded py-2 px-[30px] text-gray-700">
                        <option value="px">px</option>
                        <option value="%" selected>%</option>
                    </select>
                    
                    <button type="button" onclick="adjustValue('responsive_top', 'unit_responsive_top', -10)" class="ml-2 bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-1 px-2 rounded">-</button>
                    <button type="button" onclick="adjustValue('responsive_top', 'unit_responsive_top', 10)" class="ml-2 bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-1 px-2 rounded">+</button>
                </div>
        
                <label class="block text-gray-700 text-sm font-bold mb-2">Responsive Right:</label>
                <div class="flex items-center mb-2">
                    <input type="text" id="responsive_right" name="responsive_right" value="{{ old('responsive_right') ?? '0px' }}" class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline w-full">
                    
                    <!-- Dropdown to choose unit (px or %) -->
                    <select id="unit_responsive_right" class="ml-2 border rounded py-2 px-[30px] text-gray-700 px-4">
                        <option value="px" selected>px</option>
                        <option value="%">%</option>
                    </select>
                    
                    <button type="button" onclick="adjustValue('responsive_right', 'unit_responsive_right', -10)" class="ml-2 bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-1 px-2 rounded">-</button>
                    <button type="button" onclick="adjustValue('responsive_right', 'unit_responsive_right', 10)" class="ml-2 bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-1 px-2 rounded">+</button>
                </div>
        
                <label class="block text-gray-700 text-sm font-bold mb-2">Responsive Left:</label>
                <div class="flex items-center mb-2">
                    <input type="text" id="responsive_left" name="responsive_left" value="{{ old('responsive_left') ?? '170px' }}" class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline w-full">
                    
                    <!-- Dropdown to choose unit (px or %) -->
                    <select id="unit_responsive_left" class="ml-2 border rounded py-2 px-[30px] text-gray-700">
                        <option value="px" selected>px</option>
                        <option value="%">%</option>
                    </select>
                    
                    <button type="button" onclick="adjustValue('responsive_left', 'unit_responsive_left', -10)" class="ml-2 bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-1 px-2 rounded">-</button>
                    <button type="button" onclick="adjustValue('responsive_left', 'unit_responsive_left', 10)" class="ml-2 bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-1 px-2 rounded">+</button>
                </div>
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

<script>
    function adjustValue(id, unitId, amount) {
        const input = document.getElementById(id);
        const unitSelect = document.getElementById(unitId);
        const unit = unitSelect.value;
        let value = parseInt(input.value.replace('px', '').replace('%', '')) || 0;
        value += amount;
        input.value = value + unit;
    }
</script>
