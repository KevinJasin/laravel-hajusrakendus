<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            🛒 Your Shopping Cart
        </h2>
    </x-slot>

    <div class="py-8 max-w-5xl mx-auto sm:px-6 lg:px-8">
        @if(session('success'))
            <div class="mb-6 p-4 bg-green-100 text-green-700 rounded shadow">
                {{ session('success') }}
            </div>
        @endif

        @if(count($cart) > 0)
            <form action="{{ route('cart.update') }}" method="POST">
                @csrf

                <div class="overflow-x-auto bg-white shadow rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">
                            <tr>
                                <th class="px-6 py-3">Image</th>
                                <th class="px-6 py-3">Product</th>
                                <th class="px-6 py-3">Price</th>
                                <th class="px-6 py-3">Quantity</th>
                                <th class="px-6 py-3">Subtotal</th>
                                <th class="px-6 py-3">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 text-sm">
                            @php $total = 0; @endphp

                            @foreach($cart as $id => $item)
                                @if(is_null($item)) @continue @endif
                                @php
                                    $subtotal = $item['price'] * $item['quantity'];
                                    $total += $subtotal;
                                @endphp
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4">
                                        <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}" class="w-16 h-16 object-cover rounded">
                                    </td>
                                    <td class="px-6 py-4 font-medium text-gray-800">{{ $item['name'] }}</td>
                                    <td class="px-6 py-4 text-blue-600 font-semibold">€{{ number_format($item['price'], 2) }}</td>
                                    <td class="px-6 py-4">
                                        <input type="number" name="quantities[{{ $id }}]" value="{{ $item['quantity'] }}" min="1"
                                               class="w-20 border rounded px-2 py-1 shadow-sm text-center">
                                    </td>
                                    <td class="px-6 py-4 font-semibold">€{{ number_format($subtotal, 2) }}</td>
                                    <td class="px-6 py-4">
                                        <button type="submit"
                                            formaction="{{ route('cart.remove', $id) }}"
                                            formmethod="POST"
                                            onclick="return confirm('Remove this product?')"
                                            class="text-red-500 hover:text-red-700 hover:underline text-sm">
                                            @csrf
                                            Remove
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="bg-gray-100 font-bold text-gray-700 text-sm">
                                <td colspan="4" class="px-6 py-4 text-right">Total:</td>
                                <td class="px-6 py-4">€{{ number_format($total, 2) }}</td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <div class="mt-6 flex flex-col sm:flex-row justify-between items-center gap-4">
                    <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white px-6 py-2 rounded shadow">
                        Update Cart
                    </button>
                    <a href="{{ route('checkout.form') }}" class="bg-green-500 hover:bg-green-600 text-white px-6 py-2 rounded shadow text-center">
                        Proceed to Checkout
                    </a>
                </div>
            </form>
        @else
            <p class="text-gray-700 text-lg">🛍 Your cart is empty.</p>
            <a href="{{ route('shop.index') }}" class="mt-4 inline-block text-blue-600 hover:underline">← Continue shopping</a>
        @endif
    </div>
</x-app-layout>
