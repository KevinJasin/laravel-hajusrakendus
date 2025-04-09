<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            ✍️ Create New Blog Post
        </h2>
    </x-slot>

    <div class="py-8 max-w-2xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white p-6 rounded shadow">
            <form method="POST" action="{{ route('blogs.store') }}">
                @csrf

                <div class="mb-5">
                    <label class="block text-gray-700 font-semibold mb-1">Title</label>
                    <input type="text" name="title"
                           class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                           required>
                </div>

                <div class="mb-5">
                    <label class="block text-gray-700 font-semibold mb-1">Description</label>
                    <textarea name="description" rows="5"
                              class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                              required></textarea>
                </div>

                <div class="flex justify-end">
                    <button type="submit"
                            class="bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded shadow transition">
                        ✅ Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
