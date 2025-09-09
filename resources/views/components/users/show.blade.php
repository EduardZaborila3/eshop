<x-layout>
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
        <p><strong>Role:</strong> {{ $user->role }}</p>
        <p><strong>Joined At:</strong> {{ $user->created_at->format('F j, Y') }}</p>
        <p><strong>Address:</strong> {{ $user->address_data['country'] }}, {{ $user->address_data['city'] }}, {{ $user->address_data['street'] }}</p>
        <p><strong>Postal Code:</strong> {{ $user->address_data['postal_code'] }}</p>

        <div class="text-blue-400 mt-6 font-semibold">
            <a href="/users">Go back</a>
        </div>
</x-layout>
