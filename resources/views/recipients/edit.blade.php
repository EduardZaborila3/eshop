<x-app-layout>
    <x-slot:heading>
        Edit Recipient: {{ $recipient->name }}
    </x-slot:heading>
    <form method="POST" action="/recipients/{{ $recipient->id }}">
        @csrf
        @method('PATCH')
        <div class="space-y-12">
            <div class="border-b border-white/10 pb-12">
                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-4">
                        <label for="name" class="block text-sm/6 font-medium text-gray-500">Name</label>
                        <div class="mt-2">
                            <div class="flex items-center rounded-md bg-white/5 outline-1 -outline-offset-1 outline-white/10 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-500">
                                <input id="name"
                                       type="text"
                                       name="name"
                                       required
                                       value="{{ $recipient->name }}"
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
                                       value="{{ $recipient->email }}"
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
                                       value="{{ $recipient->phone }}"
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
                                       value="{{ data_get($recipient, 'address_data.street') }}"
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
                                       value="{{ data_get($recipient, 'address_data.street_number') }}"
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
                                       value="{{ data_get($recipient, 'address_data.city') }}"
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
                        <label for="country" class="block text-sm/6 font-medium text-gray-500">Country</label>
                        <div class="mt-2">
                            <div class="flex items-center rounded-md bg-white/5 outline-1 -outline-offset-1 outline-white/10 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-500">
                                <input id="country"
                                       type="text"
                                       name="country"
                                       value="{{ data_get($recipient, 'address_data.country') }}"
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
                        <label for="postal_code" class="block text-sm/6 font-medium text-gray-500">Postcode</label>
                        <div class="mt-2">
                            <div class="flex items-center rounded-md bg-white/5 outline-1 -outline-offset-1 outline-white/10 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-500">
                                <input id="postal_code"
                                       type="text"
                                       name="postal_code"
                                       value="{{ data_get($recipient, 'address_data.postal_code') }}"
                                       class="rounded-md border border-gray-400 block min-w-0 grow bg-transparent py-1.5 px-3 text-base text-gray-900 placeholder:text-gray-500 focus:outline-none sm:text-sm/6"
                                       required
                                />
                            </div>
                            @error('postal_code')
                            <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <x-form-field>
                        <x-form-label for="notes">Notes</x-form-label>
                            <div class="mt-2">
                                <textarea id="notes" name="notes" rows="4"
                                          class="block w-full rounded-md placeholder-gray-300 border-gray-300 shadow-sm p-2 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                          placeholder="Enter notes here...">{{ old('notes', $recipient->notes ?? '') }}
                                </textarea>
                            </div>
                    </x-form-field>
                </div>
            </div>
        </div>

        <div class="mt-6 flex items-center justify-between gap-x-6">
            <div class="flex items-center">
                <button form="delete-form" class="text-red-500 text-sm font-bold">Delete</button>
            </div>

            <div class="flex items-center gap-x-6">
                <a href="/recipients/{{ $recipient->id }}" type="button"
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

    <form method="POST" action="/recipients/{{ $recipient->id }}" id="delete-form" class="hidden">
        @csrf
        @method('DELETE')
    </form>

</x-app-layout>
