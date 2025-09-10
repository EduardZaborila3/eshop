<x-layout>
    <x-slot:heading>
        Companies
    </x-slot:heading>

    <x-slot:actions>
        <a href="/companies/create" class="bg-blue-400 hover:bg-blue-500 px-4 py-2 rounded-2xl text-white text-sm font-semibold">Add Company</a>
    </x-slot:actions>
    <div class="space-y-4">

        @foreach($companies as $company)
            <a href="/companies/{{ $company->id }}" class="block px-4 py-6 border border-gray-300 rounded-lg hover:shadow-lg transition duration-300">
                <div class="font-bold text-green-700 text-xl">{{ $company->name }}</div>
                <div class="text-sm">{{ $company->address['country'] }}, {{ $company->address['city'] }},
                    {{ $company->address['street'] }} {{ $company->address['street_number'] }},
                    {{ $company->address['postcode'] }}</div>
                <div class="text-xs font-bold">Phone number: {{ $company->phone }}</div>
            </a>
        @endforeach

    </div>
</x-layout>
