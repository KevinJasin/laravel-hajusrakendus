<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            🧾 Checkout
        </h2>
    </x-slot>

    <div class="py-8 max-w-xl mx-auto sm:px-6 lg:px-8">
        @if(session('error'))
            <div class="mb-6 p-4 bg-red-100 text-red-700 border border-red-300 rounded shadow-sm">
                {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="{{ route('checkout.process') }}" class="bg-white p-6 rounded-lg shadow-lg space-y-5">
            @csrf

            <div>
                <label class="block font-semibold mb-1 text-gray-700">First Name</label>
                <input type="text" name="first_name" value="{{ old('first_name') }}"
                       class="w-full border border-gray-300 rounded px-3 py-2 focus:ring focus:ring-green-200" required>
                @error('first_name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block font-semibold mb-1 text-gray-700">Last Name</label>
                <input type="text" name="last_name" value="{{ old('last_name') }}"
                       class="w-full border border-gray-300 rounded px-3 py-2 focus:ring focus:ring-green-200" required>
                @error('last_name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block font-semibold mb-1 text-gray-700">Email</label>
                <input type="email" name="email" value="{{ old('email') }}"
                       class="w-full border border-gray-300 rounded px-3 py-2 focus:ring focus:ring-green-200" required>
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block font-semibold mb-1 text-gray-700">Phone</label>
                <input type="text" name="phone" value="{{ old('phone') }}"
                       class="w-full border border-gray-300 rounded px-3 py-2 focus:ring focus:ring-green-200" required>
                @error('phone')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="pt-4">
                <button type="submit"
                        class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold px-4 py-2 rounded transition duration-150">
                    ✅ Confirm Order
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
