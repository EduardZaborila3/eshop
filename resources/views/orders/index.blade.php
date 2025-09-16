<x-app-layout>
    <x-slot:heading>
        Order Details
    </x-slot:heading>
    <form method="GET" class="mb-6 flex gap-4 items-end">
        <div class="flex items-center justify-between space-x-6">
            <div class="sm:col-span-4">
                <label for="id" class="block text-sm/6 font-medium text-gray-500"></label>
                <div class="mt-2">
                    <div class="flex items-center rounded-md bg-white/5 outline-1 -outline-offset-1 outline-white/10 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-500">
                        <input id="id"
                               type="text"
                               name="id"
                               value="{{ request()->id }}"
                               placeholder="Search"
                               class="rounded-md border border-gray-400 block min-w-0 grow bg-transparent py-1.5 px-3 text-base text-gray-900 placeholder:text-gray-500 focus:outline-none sm:text-sm/6"
                        />
                    </div>
                </div>
            </div>

            <div>
                <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                <select name="status" id="status" class="mt-1 block rounded-md border-gray-300 shadow-sm">
                    <option value="">All</option>
                    <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                    <option value="created" {{ request('status') == 'created' ? 'selected' : '' }}>Created</option>
                    <option value="delivered" {{ request('status') == 'delivered' ? 'selected' : '' }}>Delivered</option>
                    <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
            </div>

            <div>
                <label for="order_by" class="block text-sm font-medium text-gray-700">Order By</label>
                <select name="order_by" id="order_by" class="mt-1 block rounded-md border-gray-300 shadow-sm">
                    <option value="id" {{ request('order_by') == 'id' ? 'selected' : '' }}>ID</option>
                    <option value="placed_at" {{ request('order_by') == 'placed_at' ? 'selected' : '' }}>Newest</option>
                </select>
            </div>

            <div>
                <label for="direction" class="block text-sm font-medium text-gray-700">Direction</label>
                <select name="direction" id="direction" class="mt-1 block rounded-md border-gray-300 shadow-sm">
                    <option value="asc" {{ request('direction') == 'asc' ? 'selected' : '' }}>Ascending</option>
                    <option value="desc" {{ request('direction') == 'desc' ? 'selected' : '' }}>Descending</option>
                </select>
            </div>

            <div class="sm:col-span-4">
                <label for="per_page" class="block text-sm/6 font-medium text-gray-500"></label>
                <div class="mt-2">
                    <div class="flex items-center rounded-md bg-white/5 outline-1 -outline-offset-1 outline-white/10 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-500">
                        <input id="per_page"
                               type="text"
                               name="per_page"
                               value="{{ request('per_page') ?? 15 }}"
                               placeholder="Records per Page"
                               class="rounded-md border border-gray-400 block min-w-0 grow bg-transparent py-1.5 px-3 text-base text-gray-900 placeholder:text-gray-500 focus:outline-none sm:text-sm/6"
                        />
                    </div>
                </div>
            </div>

            <div class="space-x-4">
                <button type="submit" class="text-sm font-semibold mt-2 rounded-md bg-indigo-400 px-4 py-2 text-white shadow-sm">Filter</button>
                <a href="{{ url()->current() }}" class="text-indigo-500 border border-indigo-500 rounded-lg p-2">Reset Filters</a>
            </div>
        </div>
    </form>

    @foreach($orders as $order)
        <a href="/orders/{{ $order['id'] }}">
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
                <p class="mb-1"><strong>Order Date:</strong> {{ data_get($order, 'placed_at') }}</p>
                <p class="mb-1"><strong>Total Items:</strong> {{ (data_get($order, 'quantity_per_product', 0)) * $order->products->count() }}</p>
                <p class="mb-1"><strong>Total Amount:</strong> ${{ number_format(data_get($order, 'total_amount'), 2) }}</p>

            </div>
        </a>
    @endforeach

{{--        @can('edit', $user)--}}
{{--            <a href="/users/{{ $user->id }}/edit" class="inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Edit User</a>--}}
{{--        @endcan--}}
    {{ $orders->withQueryString()->links() }}
</x-app-layout>
