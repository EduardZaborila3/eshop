<x-layout>
    <x-slot:heading>
        Add New Company
    </x-slot:heading>
    <form method="POST" action="/companies">
        @csrf
        <div class="space-y-12">
            <div class="border-b border-white/10 pb-12">
                <h2 class="text-base/7 font-semibold text-gray-500">Create a New Company</h2>
                <p class="mt-1 text-sm/6 text-gray-400">We just need a handful of details from you.</p>

                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-6 sm:grid-cols-6">
                    <x-form-field>
                        <x-form-label for="name">Company Name</x-form-label>
                        <div class="mt-2">
                            <x-form-input id="name"  name="name" placeholder="Company Name" value="{{ old('name', $company->name ?? '') }}"/>

                            <x-form-error name="name" />
                        </div>
                    </x-form-field>

                    <x-form-field>
                        <x-form-label for="email">Email</x-form-label>
                        <div class="mt-2">
                            <x-form-input id="email"  name="email" placeholder="company@example.com" value="{{ old('email', $company->email ?? '') }}"/>

                            <x-form-error name="email" />
                        </div>
                    </x-form-field>

                    <x-form-field>
                        <x-form-label for="phone">Phone Number</x-form-label>
                        <div class="mt-2">
                            <x-form-input id="phone"  name="phone" placeholder="+40712345678" value="{{ old('phone', $company->phone ?? '') }}"/>

                            <x-form-error name="phone" />
                        </div>
                    </x-form-field>

                    <hr class="sm:col-span-6 mt-2 border-gray-300" />

                    <h2 class="text-base/7 font-semibold text-gray-500 sm:col-span-6">Address</h2>

                    <x-form-field>
                        <x-form-label for="street">Street</x-form-label>
                        <div class="mt-2">
                            <x-form-input id="street"  name="street" placeholder="Long Street" value="{{ old('street', $company->address['street'] ?? '') }}"/>

                            <x-form-error name="street" />
                        </div>
                    </x-form-field>

                    <x-form-field>
                        <x-form-label for="street_number">Street Number</x-form-label>
                        <div class="mt-2">
                            <x-form-input id="street_number" name="street_number" placeholder="1" value="{{ old('street_number', $company->address['street_number'] ?? '') }}"/>

                            <x-form-error name="street_number" />
                        </div>
                    </x-form-field>

                    <x-form-field>
                        <x-form-label for="city">City</x-form-label>
                        <div class="mt-2">
                            <x-form-input id="city" name="city" placeholder="New York" value="{{ old('city', $company->address['city'] ?? '') }}"/>

                            <x-form-error name="city" />
                        </div>
                    </x-form-field>

                    <x-form-field>
                        <x-form-label for="postcode">Postcode</x-form-label>
                        <div class="mt-2">
                            <x-form-input id="postcode" name="postcode" placeholder="600000" value="{{ old('postcode', $company->address['postcode'] ?? '') }}"/>

                            <x-form-error name="postcode" />
                        </div>
                    </x-form-field>

                    <x-form-field>
                        <x-form-label for="country">Country/State</x-form-label>
                        <div class="mt-2">
                            <x-form-input id="country" name="country" placeholder="California" value="{{ old('country', $company->address['country'] ?? '') }}"/>

                            <x-form-error name="country" />
                        </div>
                    </x-form-field>

                    <x-form-field>
                        <x-form-label for="country">Activity</x-form-label>
                        <div class="mt-2 flex gap-4">
                            <label class="inline-flex items-center">
                                <input type="radio" name="is_active" value="1"
                                       class="form-radio text-indigo-600"
                                    {{ old('is_active', $company->is_active ?? '') == 1 ? 'checked' : '' }}>
                                <span class="ml-2 text-gray-500">Active</span>
                            </label>

                            <label class="inline-flex items-center">
                                <input type="radio" name="is_active" value="0"
                                       class="form-radio text-indigo-600"
                                    {{ old('is_active', $company->is_active ?? '') == 0 ? 'checked' : '' }}>
                                <span class="ml-2 text-gray-500">Not Active</span>
                            </label>
                        </div>

                        <x-form-error name="is_active" />
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
            <a href="/companies" class="rounded-md bg-gray-400 px-3 py-2 text-sm font-semibold text-white focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">Cancel</a>
            <x-form-button>Save</x-form-button>
        </div>
    </form>

</x-layout>
