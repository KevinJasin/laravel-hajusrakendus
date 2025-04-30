<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            🧟 Monster Encyclopedia
        </h2>
    </x-slot>

    <div class="py-8 max-w-6xl mx-auto sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($monsters as $monster)
                <div class="bg-white rounded shadow-md p-6 border border-gray-200 hover:shadow-xl transition">
                    <h3 class="text-2xl font-bold text-purple-700 mb-2">
                        {{ $monster['title'] ?? 'Unknown Monster' }}
                    </h3>

                    <p class="text-gray-700 text-sm mb-3">
                        <strong>Description:</strong><br>
                        {{ $monster['description'] ?? 'No description.' }}
                    </p>

                    <p class="text-gray-700 text-sm mb-3">
                        <strong>Behavior:</strong><br>
                        {{ $monster['behavior'] ?? 'Unknown behavior.' }}
                    </p>

                    @if (!empty($monster['habitat']))
                        <p class="text-gray-700 text-sm">
                            <strong>Habitat:</strong><br>
                            {{ $monster['habitat'] }}
                        </p>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
