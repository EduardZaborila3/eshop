<x-layout>
    <x-slot:heading>
        Company Details
    </x-slot:heading>
    <div class="space-x-3">
        <h2 class="font-bold text-3xl text-green-700">{{ $company->name }}</h2>
        <h1 class="font-bold text-xl mt-3 mb-6">{{ $company->address['country'] }}, {{ $company->address['city'] }},
            {{ $company->address['street'] }} {{ $company->address['street_number'] }},
            {{ $company->address['postcode'] }}</h1>
        <p><strong>Phone Number:</strong> {{ $company->phone }}</p>
        <p><strong>Email:</strong> {{ $company->email }}</p>
        <p><strong>Identifier Slug:</strong> {{ $company->slug }}</p>
        <p class="{{ $company->is_active ? 'text-green-500' : 'text-red-500' }}">
            {{ $company->is_active ? 'The company is active' : 'The company is not active' }}
        </p>
    </div>

    <div class="mt-10 font-semibold text-blue-400 space-x-4">
        <x-button href="/companies/{{ $company->id }}/edit">Edit Company</x-button>
        <a href="/companies">Go back</a>
    </div>
</x-layout>

