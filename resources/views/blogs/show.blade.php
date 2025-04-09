<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            📄 Blog Post
        </h2>
    </x-slot>

    <div class="py-8 max-w-2xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="bg-white p-6 rounded shadow">
            <h1 class="text-3xl font-bold mb-3 text-gray-900">{{ $blog->title }}</h1>
            <p class="text-gray-700 leading-relaxed">{{ $blog->description }}</p>

            <a href="{{ route('blogs.index') }}" class="inline-block mt-4 text-blue-500 hover:underline">← Back to posts</a>
        </div>

        <div class="bg-white p-6 rounded shadow">
            <h2 class="text-2xl font-semibold mb-4 text-gray-800">
                💬 Comments ({{ $blog->comments->count() }})
            </h2>

            @forelse($blog->comments as $comment)
                <div class="mb-4 p-4 border rounded bg-gray-50">
                    <p class="text-gray-800 mb-1">{{ $comment->content }}</p>
                    <p class="text-sm text-gray-500">
                        By <strong>{{ $comment->user->name }}</strong> on {{ $comment->created_at->format('d M Y H:i') }}
                    </p>

                    @auth
                        @if(auth()->user()->is_admin)
                            <form action="{{ route('comments.destroy', $comment) }}" method="POST" class="mt-2">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-600 text-sm hover:underline"
                                        onclick="return confirm('Delete this comment?')">
                                    Delete
                                </button>
                            </form>
                        @endif
                    @endauth
                </div>
            @empty
                <p class="text-gray-500">No comments yet. Be the first to comment!</p>
            @endforelse
        </div>

        @auth
            <div class="bg-white p-6 rounded shadow">
                <form action="{{ route('comments.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="blog_id" value="{{ $blog->id }}">

                    <div class="mb-4">
                        <label class="block font-semibold mb-1 text-gray-700">Add a Comment:</label>
                        <textarea name="content" class="w-full border-gray-300 rounded p-3 shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                  rows="4" required></textarea>
                    </div>

                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded shadow">
                        ➕ Post Comment
                    </button>
                </form>
            </div>
        @else
            <p class="text-gray-500 text-center">
                Please <a href="{{ route('login') }}" class="text-blue-500 hover:underline">log in</a> to leave a comment.
            </p>
        @endauth
    </div>
</x-app-layout>
