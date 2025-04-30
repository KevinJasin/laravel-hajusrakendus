<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            📝 All Blog Posts
        </h2>
    </x-slot>

    <div class="py-6 max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-4">

        <div class="flex justify-end">
            <a href="{{ route('blogs.create') }}"
               class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded shadow transition">
                + New Post
            </a>
        </div>

        @foreach($blogs as $blog)
            <div class="bg-white border border-gray-200 rounded-lg shadow p-6">
                <h2 class="text-2xl font-semibold text-gray-800 mb-2">{{ $blog->title }}</h2>
                <p class="text-gray-600 mb-4">{{ Str::limit($blog->description, 150) }}</p>

                <div class="flex flex-wrap gap-3 text-sm">
                    <a href="{{ route('blogs.show', $blog) }}"
                       class="bg-blue-100 text-blue-800 px-3 py-1 rounded hover:bg-blue-200 transition">
                        View
                    </a>
                    <a href="{{ route('blogs.edit', $blog) }}"
                       class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded hover:bg-yellow-200 transition">
                        Edit
                    </a>
                    <form action="{{ route('blogs.destroy', $blog) }}" method="POST" onsubmit="return confirm('Delete this post?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="bg-red-100 text-red-700 px-3 py-1 rounded hover:bg-red-200 transition">
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        @endforeach

        @if($blogs->isEmpty())
            <p class="text-center text-gray-500 mt-10">No blog posts yet. Create one!</p>
        @endif
    </div>
</x-app-layout>
