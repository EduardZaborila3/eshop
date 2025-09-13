<x-app-layout>
    <x-slot:heading>
        Companies
    </x-slot:heading>

    <x-slot:actions>
        <x-action-button href="/companies/create">Add Company</x-action-button>
    </x-slot:actions>
    <div class="space-y-4">

        @foreach($companies as $company)
            <div class="flex items-center justify-between px-4 py-6 border border-gray-300 rounded-lg hover:shadow-lg transition duration-300">
                @if(auth()->user()->role === 'admin')
                    <a href="/companies/{{ $company->id }}" class="flex-1">
                        <div class="font-bold text-green-700 text-xl">{{ $company->name }}</div>
                        <div class="text-sm">{{ $company->address['country'] }}, {{ $company->address['city'] }},
                            {{ $company->address['street'] }} {{ $company->address['street_number'] }},
                            {{ $company->address['postcode'] }}</div>
                        <div class="text-xs font-bold">Phone number: {{ $company->phone }}</div>
                    </a>
                @elseif(auth()->user()->role === 'staff')
                    <div class="flex-1">
                        <div class="font-bold text-green-700 text-xl">{{ $company->name }}</div>
                        <div class="text-sm">{{ $company->address['country'] }}, {{ $company->address['city'] }},
                            {{ $company->address['street'] }} {{ $company->address['street_number'] }},
                            {{ $company->address['postcode'] }}</div>
                        <div class="text-xs font-bold">Phone number: {{ $company->phone }}</div>
                    </div>
                @endif

                <a href="/companies/{{ $company->id }}/orders/create"
                   class="px-3 py-1 bg-green-600 text-white text-xs font-semibold rounded-xl hover:bg-green-700 transition duration-200">
                    New Order
                </a>
            </div>
        @endforeach

    {{ $companies->links() }}
    </div>
</x-app-layout>
