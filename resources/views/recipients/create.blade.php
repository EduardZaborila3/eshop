<x-app-layout>
    <x-slot:heading>
        Add New Recipient
    </x-slot:heading>
    <form method="POST" action="/recipients">
        @csrf
        <div class="space-y-12">
            <div class="border-b border-white/10 pb-12">
                <h2 class="text-base/7 font-semibold text-gray-500">Add a New Recipient</h2>

                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-6 sm:grid-cols-6">
                    <x-form-field>
                        <x-form-label for="name">Recipient Name</x-form-label>
                        <div class="mt-2">
                            <x-form-input id="name"  name="name" value="{{ old('name', $recipient->name ?? '') }}" placeholder="Recipient Name" class="placeholder-gray-300 placeholder-opacity-50"/>

                            <x-form-error name="name" />
                        </div>
                    </x-form-field>

                    <x-form-field>
                        <x-form-label for="price">Email</x-form-label>
                        <div class="mt-2">
                            <x-form-input id="email"  name="email" value="{{ old('email', $recipient->email ?? '') }}" placeholder="recipient@example.com" />

                            <x-form-error name="email" />
                        </div>
                    </x-form-field>

                    <x-form-field>
                        <x-form-label for="phone">Phone</x-form-label>
                        <div class="mt-2">
                            <x-form-input id="phone"  name="phone" value="{{ old('stock', $recipient->phone ?? '') }}" placeholder="+4072345678" />

                            <x-form-error name="phone" />
                        </div>
                    </x-form-field>

                    <hr class="sm:col-span-6 mt-2 border-gray-300" />

                    <h2 class="text-base/7 font-semibold text-gray-500 sm:col-span-6">Address</h2>

                    <x-form-field>
                        <x-form-label for="street">Street</x-form-label>
                        <div class="mt-2">
                            <x-form-input id="street"  name="street" placeholder="Long Street" value="{{ old('street', $recipient->address['street'] ?? '') }}"/>

                            <x-form-error name="street" />
                        </div>
                    </x-form-field>

                    <x-form-field>
                        <x-form-label for="street_number">Street Number</x-form-label>
                        <div class="mt-2">
                            <x-form-input id="street_number" name="street_number" placeholder="1" value="{{ old('street_number', $recipient->address['street_number'] ?? '') }}"/>

                            <x-form-error name="street_number" />
                        </div>
                    </x-form-field>

                    <x-form-field>
                        <x-form-label for="city">City</x-form-label>
                        <div class="mt-2">
                            <x-form-input id="city" name="city" placeholder="New York" value="{{ old('city', $recipient->address['city'] ?? '') }}"/>

                            <x-form-error name="city" />
                        </div>
                    </x-form-field>

                    <x-form-field>
                        <x-form-label for="postal_code">Postcode</x-form-label>
                        <div class="mt-2">
                            <x-form-input id="postal_code" name="postal_code" placeholder="600000" value="{{ old('postal_code', $recipient->address['postal_code'] ?? '') }}"/>

                            <x-form-error name="postal_code" />
                        </div>
                    </x-form-field>

                    <x-form-field>
                        <x-form-label for="country">Country/State</x-form-label>
                        <div class="mt-2">
                            <x-form-input id="country" name="country" placeholder="California" value="{{ old('country', $recipient->address['country'] ?? '') }}"/>

                            <x-form-error name="country" />
                        </div>
                    </x-form-field>

                    <x-form-field>
                        <x-form-label for="notes">Notes</x-form-label>
                        <div class="mt-2">
                        <textarea id="notes" name="notes" rows="4"
                            class="block w-full rounded-md placeholder-gray-300 border-gray-300 shadow-sm p-2 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                            placeholder="Enter notes here...">{{ old('notes', $recipient->notes ?? '') }}
                        </textarea>

                            <x-form-error name="notes" />
                        </div>
                    </x-form-field>
                </div>
                {{--                    <div class="mt-10 italic">--}}
                {{--                        @if($errors->any())--}}
                {{--                            @foreach($errors->all() as $error)--}}
                {{--                                <li class="text-red-500">{{ $error }}</li>--}}
                {{--                            @endforeach--}}
                {{--                        @endif--}}
                {{--                    </div>--}}
            </div>
        </div>

        <div class="mt-6 flex items-center justify-end gap-x-6">
            <a href="/recipients" class="rounded-md bg-gray-400 px-3 py-2 text-sm font-semibold text-white focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">Cancel</a>
            <x-form-button>Save</x-form-button>
        </div>
    </form>

</x-app-layout>
