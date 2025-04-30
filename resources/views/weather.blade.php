<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            🌤️ Weather in {{ $weather['name'] ?? 'Unknown' }}
        </h2>
    </x-slot>

    <div class="max-w-xl mx-auto py-8 px-6 bg-white rounded shadow text-center">

        {{-- Search form --}}
        <form method="GET" action="{{ route('weather') }}" class="mb-6">
            <label for="city" class="block font-semibold text-gray-700 mb-2">Enter city name:</label>
            <div class="flex gap-2 justify-center">
                <input type="text" name="city" id="city" value="{{ $city ?? '' }}"
                       class="border rounded px-4 py-2 w-full sm:w-auto" placeholder="e.g. Tallinn" required>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                    Search
                </button>
            </div>
        </form>

        @if($weather)
            <div class="text-4xl font-bold mb-2">
                {{ $weather['main']['temp'] }}°C
            </div>
            <div class="text-lg text-gray-600 mb-4">
                {{ $weather['weather'][0]['main'] }}
            </div>

            <img src="http://openweathermap.org/img/wn/{{ $weather['weather'][0]['icon'] }}@4x.png"
                 alt="Weather icon"
                 class="mx-auto w-32 h-32 mb-4">

            <div class="grid grid-cols-2 gap-4 text-sm text-gray-700">
                <div>
                    <strong>Feels like:</strong><br>
                    {{ $weather['main']['feels_like'] }}°C
                </div>
                <div>
                    <strong>Humidity:</strong><br>
                    {{ $weather['main']['humidity'] }}%
                </div>
                <div>
                    <strong>Pressure:</strong><br>
                    {{ $weather['main']['pressure'] }} hPa
                </div>
                <div>
                    <strong>Wind speed:</strong><br>
                    {{ $weather['wind']['speed'] }} m/s
                </div>
            </div>
        @else
            <p class="text-red-500 mt-6">Weather data not found for "{{ $city }}".</p>
        @endif
    </div>
</x-app-layout>
