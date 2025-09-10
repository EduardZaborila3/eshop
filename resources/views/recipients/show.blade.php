<x-layout>
    <x-slot:heading>
        Recipient Details
    </x-slot:heading>
    <div class="max-w-2xl bg-white p-6 rounded-lg shadow">
        <h2 class="font-bold text-2xl text-green-700 mb-4">{{ $recipient->name }}</h2>
        <p class="mb-2"><strong>Email:</strong> {{ $recipient->email }}</p>
        <p class="mb-2"><strong>Phone:</strong> {{ $recipient->phone }}</p>
        <p class="mb-2"><strong>Joined:</strong> {{ $recipient->created_at->format('F j, Y') }}</p>
        <p class="mb-4"><strong>Bio:</strong> {{ $recipient->bio ?? 'No bio available.' }}</p>

{{--        @can('edit', $user)--}}
{{--            <a href="/users/{{ $user->id }}/edit" class="inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Edit User</a>--}}
{{--        @endcan--}}
    </div>

    <div class="mt-6 text-blue-400 font-semibold">
        <a href="/recipients">Go Back</a>
    </div>
</x-layout>
