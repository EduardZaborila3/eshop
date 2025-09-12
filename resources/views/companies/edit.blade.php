<x-app-layout>
    <x-slot:heading>
        Edit Company: {{ $company->name }}
    </x-slot:heading>
    <form method="POST" action="/companies/{{ $company->id }}">
        @csrf
        @method('PATCH')
        <div class="space-y-12">
            <div class="border-b border-white/10 pb-12">
                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-4">
                        <label for="title" class="block text-sm/6 font-medium text-gray-500">Name</label>
                        <div class="mt-2">
                            <div class="flex items-center rounded-md bg-white/5 outline-1 -outline-offset-1 outline-white/10 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-500">
                                <input id="name"
                                       type="text"
                                       name="name"
                                       required
                                       value="{{ $company->name }}"
                                       class="rounded-md border border-gray-400 block min-w-0 grow bg-transparent py-1.5 px-3 text-base text-gray-900 placeholder:text-gray-500 focus:outline-none sm:text-sm/6" />
                            </div>
                            @error('name')
                            <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="sm:col-span-4">
                        <label for="email" class="block text-sm/6 font-medium text-gray-500">Email</label>
                        <div class="mt-2">
                            <div class="flex items-center rounded-md bg-white/5 outline-1 -outline-offset-1 outline-white/10 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-500">
                                <input id="email"
                                       type="text"
                                       name="email"
                                       value="{{ $company->email }}"
                                       class="rounded-md border border-gray-400 block min-w-0 grow bg-transparent py-1.5 px-3 text-base text-gray-900 placeholder:text-gray-500 focus:outline-none sm:text-sm/6"
                                       required
                                />
                            </div>
                            @error('email')
                            <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="sm:col-span-4">
                        <label for="phone" class="block text-sm/6 font-medium text-gray-500">Phone</label>
                        <div class="mt-2">
                            <div class="flex items-center rounded-md bg-white/5 outline-1 -outline-offset-1 outline-white/10 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-500">
                                <input id="phone"
                                       type="text"
                                       name="phone"
                                       value="{{ $company->phone }}"
                                       class="rounded-md border border-gray-400 block min-w-0 grow bg-transparent py-1.5 px-3 text-base text-gray-900 placeholder:text-gray-500 focus:outline-none sm:text-sm/6"
                                       required
                                />
                            </div>
                            @error('phone')
                            <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="sm:col-span-4">
                        <label for="street" class="block text-sm/6 font-medium text-gray-500">Street</label>
                        <div class="mt-2">
                            <div class="flex items-center rounded-md bg-white/5 outline-1 -outline-offset-1 outline-white/10 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-500">
                                <input id="street"
                                       type="text"
                                       name="street"
                                       value="{{ $company->address['street'] }}"
                                       class="rounded-md border border-gray-400 block min-w-0 grow bg-transparent py-1.5 px-3 text-base text-gray-900 placeholder:text-gray-500 focus:outline-none sm:text-sm/6"
                                       required
                                />
                            </div>
                            @error('street')
                            <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="sm:col-span-4">
                        <label for="street_number" class="block text-sm/6 font-medium text-gray-500">Street Number</label>
                        <div class="mt-2">
                            <div class="flex items-center rounded-md bg-white/5 outline-1 -outline-offset-1 outline-white/10 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-500">
                                <input id="street_number"
                                       type="text"
                                       name="street_number"
                                       value="{{ $company->address['street_number'] }}"
                                       class="rounded-md border border-gray-400 block min-w-0 grow bg-transparent py-1.5 px-3 text-base text-gray-900 placeholder:text-gray-500 focus:outline-none sm:text-sm/6"
                                       required
                                />
                            </div>
                            @error('street_number')
                            <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="sm:col-span-4">
                        <label for="city" class="block text-sm/6 font-medium text-gray-500">City</label>
                        <div class="mt-2">
                            <div class="flex items-center rounded-md bg-white/5 outline-1 -outline-offset-1 outline-white/10 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-500">
                                <input id="city"
                                       type="text"
                                       name="city"
                                       value="{{ $company->address['city'] }}"
                                       class="rounded-md border border-gray-400 block min-w-0 grow bg-transparent py-1.5 px-3 text-base text-gray-900 placeholder:text-gray-500 focus:outline-none sm:text-sm/6"
                                       required
                                />
                            </div>
                            @error('city')
                            <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="sm:col-span-4">
                        <label for="postcode" class="block text-sm/6 font-medium text-gray-500">Postcode</label>
                        <div class="mt-2">
                            <div class="flex items-center rounded-md bg-white/5 outline-1 -outline-offset-1 outline-white/10 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-500">
                                <input id="postcode"
                                       type="text"
                                       name="postcode"
                                       value="{{ $company->address['postcode'] }}"
                                       class="rounded-md border border-gray-400 block min-w-0 grow bg-transparent py-1.5 px-3 text-base text-gray-900 placeholder:text-gray-500 focus:outline-none sm:text-sm/6"
                                       required
                                />
                            </div>
                            @error('postcode')
                            <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="sm:col-span-4">
                        <label for="country" class="block text-sm/6 font-medium text-gray-500">Country/State</label>
                        <div class="mt-2">
                            <div class="flex items-center rounded-md bg-white/5 outline-1 -outline-offset-1 outline-white/10 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-500">
                                <input id="country"
                                       type="text"
                                       name="country"
                                       value="{{ $company->address['country'] }}"
                                       class="rounded-md border border-gray-400 block min-w-0 grow bg-transparent py-1.5 px-3 text-base text-gray-900 placeholder:text-gray-500 focus:outline-none sm:text-sm/6"
                                       required
                                />
                            </div>
                            @error('country')
                            <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="sm:col-span-4">
                        <label class="block text-sm/6 font-medium text-gray-500">Activity</label>
                        <div class="mt-2 flex gap-4">
                            <label class="inline-flex items-center">
                                <input type="radio" name="is_active" value="1"
                                       class="form-radio text-indigo-600"
                                    {{ old('is_active', $company->is_active) == 1 ? 'checked' : '' }}>
                                <span class="ml-2 text-gray-500">Active</span>
                            </label>

                            <label class="inline-flex items-center">
                                <input type="radio" name="is_active" value="0"
                                       class="form-radio text-indigo-600"
                                    {{ old('is_active', $company->is_active) == 0 ? 'checked' : '' }}>
                                <span class="ml-2 text-gray-500">Not Active</span>
                            </label>
                        </div>
                        @error('is_active')
                        <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-6 flex items-center justify-between gap-x-6">
            <div class="flex items-center">
                <button form="delete-form" class="text-red-500 text-sm font-bold">Delete</button>
            </div>

            <div class="flex items-center gap-x-6">
                <a href="/companies/{{ $company->id }}" type="button"
                   class="rounded-md bg-gray-400 px-3 py-2 text-sm font-semibold text-white focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">
                    Cancel</a>
                <div>
                    <button type="submit"
                            class="rounded-md bg-indigo-500 px-3 py-2 text-sm font-semibold text-white focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">
                        Update</button>
                </div>

            </div>
        </div>
    </form>

    <form method="POST" action="/companies/{{ $company->id }}" id="delete-form" class="hidden">
        @csrf
        @method('DELETE')
    </form>

</x-app-layout>
