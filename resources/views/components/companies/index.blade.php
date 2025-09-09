<x-layout>
    <x-slot:heading>
        Companies
    </x-slot:heading>
    <div class="space-y-4">

        @foreach($companies as $company)
            <a href="/companies/{{ $company->id }}" class="block px-4 py-6 border border-gray-300 rounded-lg hover:shadow-lg transition duration-300">
                <div class="font-bold text-green-700 text-xl">{{ $company->name }}</div>
                <div class="text-sm">{{ $company->address }}</div>
                <div class="text-xs font-bold">Phone number: {{ $company->phone }}</div>
            </a>
        @endforeach

    </div>
</x-layout>
