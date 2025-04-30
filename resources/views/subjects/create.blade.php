<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            ➕ Add Favorite Subject
        </h2>
    </x-slot>

    <div class="max-w-2xl mx-auto py-10 px-6 bg-white rounded shadow mt-6">
        <form method="POST" action="{{ route('subjects.store') }}">
            @csrf

            <div class="mb-5">
                <label class="block font-semibold mb-1 text-gray-700">Title</label>
                <input type="text" name="title" class="w-full border rounded px-3 py-2 shadow-sm" required>
            </div>

            <div class="mb-5">
                <label class="block font-semibold mb-1 text-gray-700">Description</label>
                <textarea name="description" class="w-full border rounded px-3 py-2 shadow-sm" rows="4" required></textarea>
            </div>

            <div class="mb-5">
                <label class="block font-semibold mb-1 text-gray-700">Image URL</label>
                <input type="url" name="image" id="imageInput" class="w-full border rounded px-3 py-2 shadow-sm">
                <div class="mt-3 flex items-center justify-center w-full h-[150px] border rounded shadow-sm bg-gray-50 overflow-hidden">
                    <img id="imagePreview" class="max-h-full max-w-full object-contain hidden" />
                </div>
            </div>

            <div class="mb-5">
                <label class="block font-semibold mb-1 text-gray-700">Category</label>
                <input type="text" name="category" class="w-full border rounded px-3 py-2 shadow-sm">
            </div>

            <div class="mb-6">
                <label class="block font-semibold mb-1 text-gray-700">Interest Level</label>
                <select name="interest_level" class="w-full border rounded px-3 py-2 shadow-sm">
                    <option value="">Choose...</option>
                    <option value="low">Low</option>
                    <option value="moderate">Moderate</option>
                    <option value="high">High</option>
                </select>
            </div>

            <div class="text-right">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-5 py-2 rounded shadow">
                    ✅ Submit
                </button>
            </div>
        </form>
    </div>

    <script>
        const input = document.getElementById('imageInput');
        const preview = document.getElementById('imagePreview');

        input.addEventListener('input', () => {
            if (input.value.trim() !== '') {
                preview.src = input.value;
                preview.classList.remove('hidden');
            } else {
                preview.src = '';
                preview.classList.add('hidden');
            }
        });
    </script>
</x-app-layout>
