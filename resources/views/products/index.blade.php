<x-app-layout>
    <x-slot:heading>
        Available Products
    </x-slot:heading>
    <x-slot:actions>
        <x-action-button href="/products/create">Add Product</x-action-button>
    </x-slot:actions>
    <form method="GET" class="mb-6 flex gap-4 items-end">
        <div class="flex items-center justify-between space-x-6">
            <div class="sm:col-span-4">
                <label for="name" class="block text-sm/6 font-medium text-gray-500"></label>
                <div class="mt-2">
                    <div class="flex items-center rounded-md bg-white/5 outline-1 -outline-offset-1 outline-white/10 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-500">
                        <input id="name"
                               type="text"
                               name="name"
                               value="{{ request()->name }}"
                               placeholder="Search"
                               class="rounded-md border border-gray-400 block min-w-0 grow bg-transparent py-1.5 px-3 text-base text-gray-900 placeholder:text-gray-500 focus:outline-none sm:text-sm/6"
                        />
                    </div>
                </div>
            </div>

            <div>
                <label for="is_active" class="block text-sm font-medium text-gray-700">Is Active</label>
                <select name="is_active" id="is_active" class="mt-1 block rounded-md border-gray-300 shadow-sm">
                    <option value="">All</option>
                    <option value="1" {{ request('is_active') == '1' ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ request('is_active') == '0' ? 'selected' : '' }}>Not Active</option>
                </select>
            </div>

            <div>
                <label for="order_by" class="block text-sm font-medium text-gray-700">Order By</label>
                <select name="order_by" id="order_by" class="mt-1 block rounded-md border-gray-300 shadow-sm">
                    <option value="created_at" {{ request('order_by') == 'created_at' ? 'selected' : '' }}>Newest</option>
                    <option value="name" {{ request('order_by') == 'name' ? 'selected' : '' }}>Name</option>
                    <option value="price" {{ request('order_by') == 'price' ? 'selected' : '' }}>Price</option>
                </select>
            </div>

            <div>
                <label for="direction" class="block text-sm font-medium text-gray-700">Direction</label>
                <select name="direction" id="direction" class="mt-1 block rounded-md border-gray-300 shadow-sm">
                    <option value="asc" {{ request('direction') == 'asc' ? 'selected' : '' }}>Ascending</option>
                    <option value="desc" {{ request('direction') == 'desc' ? 'selected' : '' }}>Descending</option>
                </select>
            </div>

            <div class="sm:col-span-3">
                <label for="company_id" class="block text-sm font-medium text-gray-700 mb-2">
                    Select Company
                </label>
                <select class="mt-1 block w-40 rounded-md border-gray-300 shadow-sm"
                        name="company" id="company">
                    <option value="">All</option>
                    @foreach($companies as $company)
                        <option value="{{ $company->name }}" {{ request('company') == $company->name ? 'selected' : '' }}>
                            {{ $company->name }}
                        </option>
                    @endforeach
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
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-6 gap-4 mb-6">
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
    {{ $products->withQueryString()->links() }}
</x-app-layout>
