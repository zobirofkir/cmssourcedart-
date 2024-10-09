<x-app-layout>

    <div class="py-6 px-4 max-w-3xl mx-auto">
        <div class="bg-white shadow-md rounded-lg p-6 dark:bg-gray-800">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative dark:bg-green-900 dark:border-green-700 dark:text-green-300" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative dark:bg-red-900 dark:border-red-700 dark:text-red-300" role="alert">
                    {{ session('error') }}
                </div>
            @endif

            <ul class="space-y-4">
                @foreach ($projects as $project)
                    <li class="flex items-center justify-between p-4 border border-gray-200 rounded-md dark:border-gray-700 dark:bg-gray-900">
                        <span class="text-gray-800 dark:text-gray-200">{{ $project->name }}</span>
                        {{-- <div class="flex space-x-4 items-center">
                            <form action="{{ route('projects.destroy', $project->name) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this project?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800 font-medium dark:text-red-400 dark:hover:text-red-300">
                                    Delete
                                </button>
                            </form>
                            <form action="{{ route('projects.updatePath', $project->name) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="text" name="new_path" placeholder="New Path" class="border border-gray-300 rounded-md p-2 text-sm dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200" required>
                                <button type="submit" class="text-yellow-600 hover:text-yellow-800 font-medium dark:text-yellow-400 dark:hover:text-yellow-300">
                                    Update Path
                                </button>
                            </form>
                        </div> --}}
                    </li>
                @endforeach
            </ul>

            <div class="mt-6 text-center">
                <a href="{{ route('projects.create') }}"
                   class="inline-flex items-center px-4 py-2 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-400">
                    Upload New Project
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
