<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">📍 All Markers</h2>
    </x-slot>

    <div class="max-w-4xl mx-auto py-6">
        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                {{ session('success') }}
            </div>
        @endif

        <table class="w-full table-auto border-collapse">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-2 border">Name</th>
                    <th class="p-2 border">Lat</th>
                    <th class="p-2 border">Lng</th>
                    <th class="p-2 border">Description</th>
                    <th class="p-2 border">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($markers as $marker)
                    <tr class="border-t">
                        <td class="p-2">{{ $marker->name }}</td>
                        <td class="p-2">{{ $marker->latitude }}</td>
                        <td class="p-2">{{ $marker->longitude }}</td>
                        <td class="p-2">{{ $marker->description }}</td>
                        <td class="p-2 flex gap-2">
                            <a href="{{ route('markers.edit', $marker) }}" class="text-yellow-500">Edit</a>
                            <form action="{{ route('markers.destroy', $marker) }}" method="POST" onsubmit="return confirm('Delete this marker?')">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-600 hover:underline">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
