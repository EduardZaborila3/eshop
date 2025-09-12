<x-app-layout>
    <x-slot:heading>
        Recipients
    </x-slot:heading>
    <x-slot:actions>
        <x-action-button href="/recipients/create">Add Recipient</x-action-button>
    </x-slot:actions>

    <div class="space-y-4 ">
        @foreach($recipients as $recipient)
            <a href="/recipients/{{ $recipient['id'] }}" class="block px-4 py-6 border border-gray-300 rounded-lg hover:shadow-lg transition duration-300">
                <div class="text-lg">
                    <strong class="text-green-700">{{ $recipient['name'] }}</strong> ({{ $recipient['email'] }})
                </div>
            </a>
        @endforeach
</x-app-layout>
