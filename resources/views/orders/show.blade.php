<x-app-layout>
    <x-slot:heading>
        Order Details: #{{ $order->id }}
    </x-slot:heading>
    <div class="max-w-2xl bg-white py-6">
        <p class="mb-2"><strong>Recipient:</strong> {{ data_get($order, 'recipient.name', '-') }}</p>
        <p class="mb-2"><strong>Company:</strong> {{ data_get($order, 'company.name', '-') }}</p>
        <p class="mb-2"><strong>Products:</strong>
            @foreach($order->products as $product)
                <span class="inline-block bg-gray-200 text-gray-800 text-sm px-2 py-1 rounded-full mr-2 mb-2">
                    {{ $product->name }} ({{ $product->price }} {{ $product->currency }})
                </span>
            @endforeach
        </p>
        <p class="mb-2"><strong>Total Amount:</strong> {{ $order->total_amount }} {{ $order->currency }}</p>
        <p class="mb-2"><strong>Placed At:</strong> {{ $order->placed_at }}</p>
        <p class="{{ $order->status == 'cancelled' ? 'text-red-500' :
                    ($order->status == 'delivered' ? 'text-green-600' :
                    ($order->status == 'draft' ? 'text-orange-400' : 'text-blue-400')) }}">
            <strong class="text-black">Status:</strong> {{ ucfirst($order->status) }}
        </p>

        {{--        <p class="mb-2"><strong>Joined:</strong> {{ $order->created_at->format('F j, Y') }}</p>--}}


        {{--        @can('edit', $user)--}}
        {{--            <a href="/users/{{ $user->id }}/edit" class="inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Edit User</a>--}}
        {{--        @endcan--}}
    </div>

    <div class="mt-6 text-blue-400 font-semibold space-x-4">
        <x-button href="/orders/{{ $order->id }}/edit">Edit Order</x-button>
        <a href="/orders">Go Back</a>
    </div>
</x-app-layout>

