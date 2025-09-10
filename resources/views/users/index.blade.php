<x-layout>
    <x-slot:heading>
        Users
    </x-slot:heading>
    <div class="space-y-4">

        @foreach($users as $user)
            <a href="/users/{{ $user->id }}" class="block px-4 py-6 border border-gray-300 rounded-lg hover:shadow-lg transition duration-300">
                <div class="flex flex-1 justify-between items-center">
                    <div>
                        <div class="font-bold text-green-700 text-xl">{{ $user->name }}</div>
                        <div class="text-sm font-semibold">{{ $user->email }}</div>
                    </div>

                    <span class="{{ $user->is_active == 1 ? 'text-green-500' : 'text-red-600' }}">
                                 {{ $user->is_active == 1 ? "Active" : "Not Active" }}
            </span>
                </div>
            </a>
        @endforeach



    </div>
</x-layout>
