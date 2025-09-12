<x-app-layout>
    <x-slot:heading>
        Available Products
    </x-slot:heading>
    <x-slot:actions>
        <x-action-button href="/products/create">Add Product</x-action-button>
    </x-slot:actions>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-6 gap-4">

        @foreach($products as $product)
            <a href="/products/{{ $product->id }}" class="block px-4 py-6 aspect-square border border-gray-300 rounded-lg hover:shadow-lg transition duration-300">
                <div class="text-center">
                    <div class="font-bold text-xl text-blue-600">{{ $product->name }}</div>

                    @if($product->stock < 1)
                        <div class="text-sm font-semibold text-red-600 mt-10">Out of Stock</div>
                    @else
                        <div class="text-sm font-semibold text-gray-500 mt-10">Stock: {{ $product->stock }}</div>
                    @endif

                    <div class="text-lg text-gray-700 mt-2">{{ $product->price }} {{ $product->currency }}</div>
                </div>
            </a>
        @endforeach

    </div>
</x-app-layout>
