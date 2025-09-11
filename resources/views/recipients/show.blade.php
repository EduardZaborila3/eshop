<x-layout>
    <x-slot:heading>
        Recipient Details
    </x-slot:heading>
    <div class="max-w-2xl bg-white p-6 rounded-lg shadow">
        <h2 class="font-bold text-2xl text-green-700 mb-4">{{ $recipient->name }}</h2>
        <p class="mb-2"><strong>Email:</strong> {{ $recipient->email }}</p>
        <p class="mb-2"><strong>Phone:</strong> {{ $recipient->phone }}</p>
        <p class="mb-2"><strong>Address:</strong>
            {{ $recipient->address_data['country'] }}, {{ $recipient->address_data['city'] }},
            {{ $recipient->address_data['street'] }} {{ $recipient->address_data['street_number'] }},
            {{ $recipient->address_data['postal_code'] }}
        </p>
        @if($recipient->notes)
            <p class="mb-2"><strong>Notes:</strong> {{ $recipient->notes }}</p>
        @endif

{{--        <p class="mb-2"><strong>Joined:</strong> {{ $recipient->created_at->format('F j, Y') }}</p>--}}


{{--        @can('edit', $user)--}}
{{--            <a href="/users/{{ $user->id }}/edit" class="inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Edit User</a>--}}
{{--        @endcan--}}
    </div>

    <div class="mt-6 text-blue-400 font-semibold space-x-4">
        <x-button href="/recipients/{{ $recipient->id }}/edit">Edit Recipient</x-button>
        <a href="/recipients">Go Back</a>
    </div>
</x-layout>
