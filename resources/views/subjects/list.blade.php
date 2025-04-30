<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                📚 Favorite Subjects
            </h2>
            <a href="{{ route('monsters.index') }}"
               class="bg-purple-600 hover:bg-purple-700 text-white font-semibold py-2 px-4 rounded shadow transition duration-200">
                🧟 View Monster API
            </a>
        </div>
    </x-slot>

    <div class="max-w-6xl mx-auto py-8 px-4 space-y-6">
        @if(session('success'))
            <div class="bg-green-100 text-green-800 px-4 py-3 rounded shadow">
                {{ session('success') }}
            </div>
        @endif

        @foreach($subjects as $subject)
            <div class="bg-white shadow rounded-lg overflow-hidden flex flex-col sm:flex-row gap-4 p-5 border hover:shadow-md transition">
                @if($subject->image)
                    <div class="w-full sm:w-[200px] h-[150px] flex items-center justify-center border rounded bg-gray-50">
                        <img src="{{ $subject->image }}"
                             alt="{{ $subject->title }}"
                             class="object-contain max-h-full max-w-full" />
                    </div>
                @endif

                <div class="flex-1 flex flex-col justify-between">
                    <div>
                        <h3 class="text-xl font-bold text-gray-800">{{ $subject->title }}</h3>
                        <p class="text-gray-600 mt-2">{{ $subject->description }}</p>

                        <div class="text-sm text-gray-700 mt-3 space-y-1">
                            <p><strong>Category:</strong> {{ $subject->category ?? 'N/A' }}</p>

                            @php
                                $level = strtolower($subject->interest_level ?? '');
                                $colorMap = [
                                    'high' => 'bg-green-100 text-green-800 border-green-300',
                                    'moderate' => 'bg-yellow-100 text-yellow-800 border-yellow-300',
                                    'low' => 'bg-red-100 text-red-800 border-red-300',
                                ];
                                $badgeClass = $colorMap[$level] ?? 'bg-gray-100 text-gray-700 border-gray-300';
                                $label = $subject->interest_level ? ucfirst($subject->interest_level) : 'N/A';
                            @endphp

                            <div>
                                <strong>Interest Level:</strong>
                                <span class="inline-block px-3 py-1 rounded-full text-sm font-medium border {{ $badgeClass }}">
                                    {{ $label }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <form action="{{ route('subjects.destroy', $subject) }}" method="POST" class="mt-4" onsubmit="return confirm('Delete this subject?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-sm text-red-600 hover:text-red-800 hover:underline inline-flex items-center gap-1">
                            🗑 Delete
                        </button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
</x-app-layout>
