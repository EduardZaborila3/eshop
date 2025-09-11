<x-layout>
    <x-slot:heading>
        Order Details
    </x-slot:heading>

    @foreach($orders as $order)
        <div class="rounded-xl p-4 mb-6 shadow border border-gray-200 transition-shadow hover:shadow-lg duration-300">
        <div class="flex justify-between items-center mb-1">
                <h2 class="font-bold text-2xl text-green-700 mb-1">Order #{{ $order->id }}</h2>
                <p class="{{ $order->status == 'cancelled' ? 'text-red-500 bg-red-100 border-red-300' :
                    ($order->status == 'delivered' ? 'text-green-600 bg-green-100' :
                    ($order->status == 'draft' ? 'text-orange-400 bg-orange-100' : 'text-blue-400 bg-blue-100')) }} mb-1 text-right px-2 py-1 rounded-2xl font-semibold">
                    {{ ucfirst($order->status) }}
                </p>
            </div>
                <p class="mb-1"><strong>Recipient:</strong> {{ data_get($order, 'recipient.name', '-')}}</p>
                <p class="mb-1"><strong>Company:</strong> {{ data_get($order, 'company.name', '-') }}</p>
                <p class="mb-1"><strong>Order Date:</strong> {{ data_get($order, 'created_at')->format('F j, Y') }}</p>
                <p class="mb-1"><strong>Total Items:</strong> {{ (data_get($order, 'total_items')) }}</p>
                <p class="mb-1"><strong>Total Amount:</strong> ${{ number_format(data_get($order, 'total_amount'), 2) }}</p>

        </div>
    @endforeach

{{--        @can('edit', $user)--}}
{{--            <a href="/users/{{ $user->id }}/edit" class="inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Edit User</a>--}}
{{--        @endcan--}}
</x-layout>
