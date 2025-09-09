<x-layout>
    <x-slot:heading>
        Order Details
    </x-slot:heading>
    <div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow">
        @foreach($orders as $order)
            <div class="mb-4">
                <h2 class="font-bold text-2xl text-green-700 mb-2">Order #{{ $order->id }}</h2>
                <p class="mb-1"><strong>Recipient:</strong> {{ $order->recipient->name }}</p>
                <p class="mb-1"><strong>Company:</strong> {{ $order->company->name }}</p>
                <p class="mb-1"><strong>Order Date:</strong> {{ $order->created_at->format('F j, Y') }}</p>
                <p class="mb-1"><strong>Total Items:</strong> {{ ($order->total_items) }}</p>
                <p class="mb-1"><strong>Status:</strong> {{ ucfirst($order->status) }}</p>
                <p class="mb-1"><strong>Total Amount:</strong> ${{ number_format($order->total_amount, 2) }}</p>
            </div>
            <hr class="my-4">
        @endforeach

{{--        @can('edit', $user)--}}
{{--            <a href="/users/{{ $user->id }}/edit" class="inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Edit User</a>--}}
{{--        @endcan--}}
    </div>
</x-layout>
