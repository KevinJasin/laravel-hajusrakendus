<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            🛍️ Shop
        </h2>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto sm:px-6 lg:px-8">
        @if(session('success'))
            <div class="mb-6 p-4 bg-green-100 text-green-800 rounded shadow">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
            @foreach($products as $product)
                <div class="bg-white rounded-xl shadow hover:shadow-lg transition p-5 flex flex-col">
                    <img src="{{ $product->image }}" alt="{{ $product->name }}"
                         class="w-full h-44 object-cover rounded mb-4">

                    <h3 class="text-xl font-bold text-gray-800 mb-1">{{ $product->name }}</h3>
                    <p class="text-gray-600 text-sm mb-3">{{ $product->description }}</p>
                    <p class="text-blue-600 font-bold text-lg mb-4">€{{ number_format($product->price, 2) }}</p>

                    <form action="{{ route('cart.add', $product) }}" method="POST" class="mt-auto">
                        @csrf
                        <div class="flex items-center gap-2 mb-4">
                            <label for="quantity" class="text-sm text-gray-700">Qty:</label>
                            <input type="number" name="quantity" value="1" min="1"
                                   class="w-20 border border-gray-300 rounded px-2 py-1 focus:ring focus:ring-blue-200">
                        </div>

                        <button type="submit"
                                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition w-full">
                            🛒 Add to Cart
                        </button>
                    </form>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
