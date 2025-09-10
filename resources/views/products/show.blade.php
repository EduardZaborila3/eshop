<x-layout>
    <x-slot:heading>
        Product Details
    </x-slot:heading>
    <div class="space-y-2">
        <h2 class="font-bold text-3xl text-green-700 mb-4">{{ $product->name }}</h2>
        <p><strong>Stock:</strong> {{ $product->stock }}</p>
        <p><strong>Product Unique Identifier: </strong>{{ $product->sku }}</p>
        <p><strong>Status:</strong>
            <span class="{{ $product->is_active == 1 ? 'text-green-500' : 'text-red-600' }}">
                {{ $product->is_active == 1 ? "Product is available" : "Product is not available" }}
            </span>
        </p>
        <p class="mt-4 text-lg"><strong>Price:</strong> {{ $product->currency }} {{ $product->price }}</p>
    </div>

    <div class="mt-10 font-semibold text-blue-400 space-x-4">
        <x-button href="/products/{{ $product->id }}/edit">Edit Product</x-button>
        <a href="/products">Go back</a>
    </div>
</x-layout>

