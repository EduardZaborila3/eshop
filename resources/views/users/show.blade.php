<x-app-layout>
    <x-slot:heading>
        User Details
    </x-slot:heading>

    <div class="space-x-3">
        <h2 class="font-bold text-3xl text-green-700">{{ $user->name }}</h2>
        <hr class="border-t border-gray-300 my-4">

        <div class="font-semibold text-xl mt-6 mb-6">
            <h1>{{ $user->email }}</h1>
            <h1>{{ $user->phone }}</h1>
        </div>
        <p><strong>Role:</strong> {{ ucfirst($user->role) }}</p>
        <p><strong>Joined At:</strong> {{ $user->created_at->format('F j, Y') }}</p>
        <p><strong>Address:</strong> {{ data_get($user, 'address_data.country') }}, {{ data_get($user, 'address_data.city') }}, {{ data_get($user, 'address_data.street') }}, {{ data_get($user, 'address_data.street_number') }}</p>
        <p><strong>Postal Code:</strong> {{ data_get($user, 'address_data.postcode') }}</p>

        @auth
            @if(auth()->user()->role === 'admin')
                <div class="text-blue-400 mt-6 font-semibold space-x-4">
                    <x-button href="/users/{{ $user->id }}/edit">Edit User</x-button>
                    <a href="/users">Go back</a>
                </div>
            @endif
        @endauth
</x-layout>
