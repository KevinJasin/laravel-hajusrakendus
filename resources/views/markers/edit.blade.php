<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">✏️ Edit Marker</h2>
    </x-slot>

    <div class="max-w-xl mx-auto py-6">
        <form method="POST" action="{{ route('markers.update', $marker) }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block font-bold">Name</label>
                <input type="text" name="name" value="{{ $marker->name }}" class="w-full border rounded p-2" required>
            </div>

            <div class="mb-4">
                <label class="block font-bold">Latitude</label>
                <input type="text" name="latitude" value="{{ $marker->latitude }}" class="w-full border rounded p-2" required>
            </div>

            <div class="mb-4">
                <label class="block font-bold">Longitude</label>
                <input type="text" name="longitude" value="{{ $marker->longitude }}" class="w-full border rounded p-2" required>
            </div>

            <div class="mb-4">
                <label class="block font-bold">Description</label>
                <textarea name="description" class="w-full border rounded p-2" rows="3">{{ $marker->description }}</textarea>
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update</button>
        </form>
    </div>
</x-app-layout>
