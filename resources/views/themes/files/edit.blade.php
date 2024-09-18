<x-app-layout>

    <div class="w-full h-full">
        <h2 class="text-xl font-semibold mb-4 dark:text-white text-black text-center font-bold">Edit {{ $file }}</h2>
        <form id="fileEditForm" class="w-full h-full relative">
            @csrf
            <div id="editor" style="height: calc(100vh - 120px); border: 1px solid #ddd;"></div>
            <textarea name="content" id="editorContent" style="display:none;">{{ $content }}</textarea>

            <!-- Sticky save button -->
            <div class="mt-4 fixed bottom-4 right-4 z-10">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Save Changes
                </button>
            </div>
        </form>
    </div>

    <!-- Toastify CSS and JS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/monaco-editor/0.34.1/min/vs/loader.js"></script>
    <script>
        require.config({ paths: { 'vs': 'https://cdnjs.cloudflare.com/ajax/libs/monaco-editor/0.34.1/min/vs' }});
        require(['vs/editor/editor.main'], function() {
            var editor = monaco.editor.create(document.getElementById('editor'), {
                value: {!! json_encode($content) !!},
                language: 'html',
                theme: 'vs-dark'
            });

            // Handle form submission via AJAX
            document.getElementById('fileEditForm').addEventListener('submit', function(event) {
                event.preventDefault(); // Prevent the default form submission

                // Get the editor content
                document.getElementById('editorContent').value = editor.getValue();

                // Prepare form data
                var formData = new FormData(this);

                // Send the AJAX request
                fetch("{{ route('file.update', $file) }}", {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('input[name=_token]').value
                    },
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Toastify({
                            text: "File updated successfully!",
                            duration: 3000,  // Duration in milliseconds
                            gravity: "top",  // Display on top
                            position: "right",  // Show it on the right
                            backgroundColor: "#4CAF50",  // Success green color
                            close: true  // Add close button
                        }).showToast();
                    } else if (data.error) {
                        console.error(data.error); // Log error to the console
                    }
                })
                .catch(error => {
                    console.error('Error:', error); // Log any fetch errors to the console
                });
            });
        });
    </script>

</x-app-layout>
