<x-layout>
    <x-slot:heading>
        Company Details
    </x-slot:heading>
    <div class="space-x-3">
        <h2 class="font-bold text-3xl text-green-700">{{ $company->name }}</h2>
        <h1 class="font-bold text-xl mt-3 mb-6">{{ $company->address }}</h1>
        <p><strong>Phone Number:</strong> {{ $company->phone }}</p>
        <p><strong>Email:</strong> {{ $company->email }}</p>
        <p><strong>Identifier Slug:</strong> {{ $company->slug }}</p>
    </div>

    <div class="mt-10 font-semibold text-blue-400">
        <a href="/companies">Go back</a>
    </div>
</x-layout>

