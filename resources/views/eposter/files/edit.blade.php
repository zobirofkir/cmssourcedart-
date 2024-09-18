<x-app-layout>
    <div class="w-full h-full">
        <h2 class="text-xl font-semibold mb-4 dark:text-white text-black text-center font-bold">Edit {{ $file }}</h2>
        <form action="{{ route('e-poster.update', $file) }}" method="POST" class="w-full h-full relative">
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/monaco-editor/0.34.1/min/vs/loader.js"></script>
    <script>
        require.config({ paths: { 'vs': 'https://cdnjs.cloudflare.com/ajax/libs/monaco-editor/0.34.1/min/vs' }});
        require(['vs/editor/editor.main'], function() {
            var editor = monaco.editor.create(document.getElementById('editor'), {
                value: {!! json_encode($content) !!},
                language: getEditorLanguage('{{ $file }}'),
                theme: 'vs-dark'
            });

            document.querySelector('form').addEventListener('submit', function() {
                document.getElementById('editorContent').value = editor.getValue();
            });
        });

        function getEditorLanguage(filename) {
            const extension = filename.split('.').pop();
            if (extension === 'html') return 'html';
            if (extension === 'css') return 'css';
            if (extension === 'js') return 'javascript';
            return 'text';
        }
    </script>
</x-app-layout>
