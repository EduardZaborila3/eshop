<x-app-layout>
    <x-slot:heading>
        Users
    </x-slot:heading>

    <form method="GET" class="mb-6 flex gap-4 items-end">
        <div class="flex items-center justify-between space-x-6">
            <div>
                <label for="role" class="block text-sm font-medium text-gray-700">Role</label>
                <select name="role" id="role" class="mt-1 px-2 block rounded-md border-gray-300 shadow-sm">
                    <option value="">All</option>
                    <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="staff" {{ request('role') == 'staff' ? 'selected' : '' }}>Staff</option>
                </select>
            </div>

            <div>
                <label for="is_active" class="block text-sm font-medium text-gray-700">Status</label>
                <select name="is_active" id="is_active" class="mt-1 block rounded-md border-gray-300 shadow-sm">
                    <option value="">All</option>
                    <option value="1" {{ request('is_active') == '1' ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ request('is_active') == '0' ? 'selected' : '' }}>Not Active</option>
                </select>
            </div>

            <div>
                <label for="order_by" class="block text-sm font-medium text-gray-700">Order By</label>
                <select name="order_by" id="order_by" class="mt-1 block rounded-md border-gray-300 shadow-sm">
                    <option value="email" {{ request('order_by') == 'email' ? 'selected' : '' }}>Email</option>
                    <option value="created_at" {{ request('order_by') == 'created_at' ? 'selected' : '' }}>Register Date</option>
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

            <div>
                <button type="submit" class="text-sm font-semibold mt-2 rounded-md bg-indigo-400 px-4 py-2 text-white shadow-sm">Filter</button>
            </div>
        </div>
    </form>

    <div class="space-y-4 mb-6">
        @foreach($users as $user)
            <a href="{{ auth()->user()->role === 'admin' ? route('users.edit', $user) : '#' }}"
               class="block px-4 py-6 border border-gray-300 rounded-lg hover:shadow-lg transition duration-300">
                <div class="flex flex-1 justify-between items-center">
                    <div>
                        <div class="font-bold text-green-700 text-xl">{{ $user->name }}</div>
                        <div class="text-sm font-semibold">{{ $user->email }}</div>
                    </div>

                    <span class="{{ $user->is_active ? 'text-green-500' : 'text-red-600' }}">
                        {{ $user->is_active ? 'Active' : 'Not Active' }}
                    </span>
                </div>
            </a>
        @endforeach
    </div>

    {{ $users->withQueryString()->links() }}
</x-app-layout>
