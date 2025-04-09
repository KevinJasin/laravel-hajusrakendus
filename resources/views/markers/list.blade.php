<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            📌 All Markers
        </h2>
    </x-slot>

    <div class="py-6 max-w-5xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow rounded p-6">
            @if(session('success'))
                <div class="bg-green-100 text-green-800 p-2 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <table class="min-w-full border-collapse text-sm">
                <thead class="bg-gray-100 text-left">
                    <tr>
                        <th class="p-2 border-b">#</th>
                        <th class="p-2 border-b">Name</th>
                        <th class="p-2 border-b">Latitude</th>
                        <th class="p-2 border-b">Longitude</th>
                        <th class="p-2 border-b">Description</th>
                        <th class="p-2 border-b">Created</th>
                        <th class="p-2 border-b text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($markers as $marker)
                        <tr class="hover:bg-gray-50">
                            <td class="p-2 border-b">{{ $marker->id }}</td>
                            <td class="p-2 border-b font-semibold">{{ $marker->name }}</td>
                            <td class="p-2 border-b">{{ $marker->latitude }}</td>
                            <td class="p-2 border-b">{{ $marker->longitude }}</td>
                            <td class="p-2 border-b text-gray-600">{{ $marker->description }}</td>
                            <td class="p-2 border-b text-sm text-gray-500">{{ $marker->created_at->format('d M Y') }}</td>
                            <td class="p-2 border-b flex gap-2 justify-center">
                                <a href="{{ route('markers.edit', $marker) }}"
                                   class="text-blue-500 hover:underline text-sm">✏️ Edit</a>

                                <form action="{{ route('markers.destroy', $marker) }}" method="POST"
                                      onsubmit="return confirm('Delete this marker?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="text-red-500 hover:underline text-sm">🗑 Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
