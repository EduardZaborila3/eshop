<x-app-layout>
    <x-slot:heading>
        Recipients
    </x-slot:heading>
    <x-slot:actions>
        <x-action-button href="/recipients/create">Add Recipient</x-action-button>
    </x-slot:actions>

    <form method="GET" class="mb-6 flex gap-4 items-end">
        <div class="flex items-center justify-between space-x-6">

            <div class="sm:col-span-4">
                <label for="email" class="block text-sm/6 font-medium text-gray-500"></label>
                <div class="mt-2">
                    <div class="flex items-center rounded-md bg-white/5 outline-1 -outline-offset-1 outline-white/10 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-500">
                        <input id="email"
                               type="text"
                               name="email"
                               value="{{ request()->email }}"
                               placeholder="Search"
                               class="rounded-md border border-gray-400 block min-w-0 grow bg-transparent py-1.5 px-3 text-base text-gray-900 placeholder:text-gray-500 focus:outline-none sm:text-sm/6"
                        />
                    </div>
                </div>
            </div>

            <div>
                <label for="order_by" class="block text-sm font-medium text-gray-700">Order By</label>
                <select name="order_by" id="order_by" class="mt-1 block rounded-md border-gray-300 shadow-sm">
                    <option value="email" {{ request('order_by') == 'email' ? 'selected' : '' }}>Email</option>
                    <option value="created_at" {{ request('order_by') == 'created_at' ? 'selected' : '' }}>Newest</option>
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

    <div class="space-y-4 ">
        @foreach($recipients as $recipient)
            <a href="/recipients/{{ $recipient['id'] }}" class="block px-4 py-6 border border-gray-300 rounded-lg hover:shadow-lg transition duration-300">
                <div class="text-lg">
                    <strong class="text-green-700">{{ $recipient['name'] }}</strong> ({{ $recipient['email'] }})
                </div>
            </a>
        @endforeach
</x-app-layout>
