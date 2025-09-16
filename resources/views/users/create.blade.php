<x-app-layout>
    <x-slot:heading>
        Create a New User
    </x-slot:heading>
    <form method="POST" action="/users">
        @csrf
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
                                       value="{{ old('name', $user->name ?? '') }}"
                                       class="rounded-md border border-gray-400 block min-w-0 grow bg-transparent py-1.5 px-3 text-base text-gray-900 placeholder:text-gray-500 focus:outline-none sm:text-sm/6" />
                            </div>
                            @error('name')
                            <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    @if(auth()->user()->role === 'admin')
                        <div class="sm:col-span-4">
                            <label for="email" class="block text-sm/6 font-medium text-gray-500">Email</label>
                            <div class="mt-2">
                                <div class="flex items-center rounded-md bg-white/5 outline-1 -outline-offset-1 outline-white/10 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-500">
                                    <input id="email"
                                           type="text"
                                           name="email"
                                           value="{{ old('email', $user->email ?? '') }}"
                                           class="rounded-md border border-gray-400 block min-w-0 grow bg-transparent py-1.5 px-3 text-base text-gray-900 placeholder:text-gray-500 focus:outline-none sm:text-sm/6"
                                           required
                                    />
                                </div>
                                @error('email')
                                <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    @endif

                    <div class="sm:col-span-4">
                        <label for="phone" class="block text-sm/6 font-medium text-gray-500">Phone</label>
                        <div class="mt-2">
                            <div class="flex items-center rounded-md bg-white/5 outline-1 -outline-offset-1 outline-white/10 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-500">
                                <input id="phone"
                                       type="text"
                                       name="phone"
                                       value="{{ old('phone', $user->phone ?? '') }}"
                                       class="rounded-md border border-gray-400 block min-w-0 grow bg-transparent py-1.5 px-3 text-base text-gray-900 placeholder:text-gray-500 focus:outline-none sm:text-sm/6"
                                       required
                                />
                            </div>
                            @error('phone')
                                <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <hr class="sm:col-span-4 mt-6 mb-4 border-gray-300" />

                    <h1 class="text-sm font-semibold text-gray-700 sm:col-span-6">Address</h1>


                    <div class="sm:col-span-4">
                        <label for="street" class="block text-sm/6 font-medium text-gray-500">Street</label>
                        <div class="mt-2">
                            <div class="flex items-center rounded-md bg-white/5 outline-1 -outline-offset-1 outline-white/10 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-500">
                                <input id="street"
                                       type="text"
                                       name="street"
                                       value="{{ old('street', $user->address_data['street'] ?? '') }}"
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
                                       value="{{ old('street_number', $user->address_data['street_number'] ?? '') }}"
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
                                       value="{{ old('city', $user->address_data['city'] ?? '') }}"
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
                        <label for="country" class="block text-sm/6 font-medium text-gray-500">Country/State</label>
                        <div class="mt-2">
                            <div class="flex items-center rounded-md bg-white/5 outline-1 -outline-offset-1 outline-white/10 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-500">
                                <input id="country"
                                       type="text"
                                       name="country"
                                       value="{{ old('country', $user->address_data['country'] ?? '') }}"
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
                        <label for="postcode" class="block text-sm/6 font-medium text-gray-500">Postcode</label>
                        <div class="mt-2">
                            <div class="flex items-center rounded-md bg-white/5 outline-1 -outline-offset-1 outline-white/10 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-500">
                                <input id="postcode"
                                       type="text"
                                       name="postcode"
                                       value="{{ old('postcode', $user->address_data['postcode'] ?? '') }}"
                                       class="rounded-md border border-gray-400 block min-w-0 grow bg-transparent py-1.5 px-3 text-base text-gray-900 placeholder:text-gray-500 focus:outline-none sm:text-sm/6"
                                       required
                                />
                            </div>
                            @error('postcode')
                            <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>


                    @if(auth()->user()->role === 'admin')
                        <div class="sm:col-span-4">
                            <label class="block text-sm/6 font-medium text-gray-500">Role</label>
                            <div class="mt-2 flex gap-4">
                                <label class="inline-flex items-center">
                                    <input type="radio" name="role" value="staff"
                                           class="form-radio text-indigo-600"
                                        {{ old('role', $user->role ?? '') == 'staff' ? 'checked' : '' }}
                                    >
                                    <span class="ml-2 text-gray-500">Staff</span>
                                </label>

                                <label class="inline-flex items-center">
                                    <input type="radio" name="role" value="admin"
                                           class="form-radio text-indigo-600"
                                        {{ old('role', $user->role ?? '') == 'staff' ? 'checked' : '' }}>
                                    <span class="ml-2 text-gray-500">Admin</span>
                                </label>
                            </div>
                            @error('is_active')
                            <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    @else
                        <input type="hidden" name="role" value="{{ $user->role }}">
                    @endif

                    <div class="sm:col-span-4">
                        <label class="block text-sm/6 font-medium text-gray-500">Activity</label>
                        <div class="mt-2 flex gap-4">
                            <label class="inline-flex items-center">
                                <input type="radio" name="is_active" value="1"
                                       class="form-radio text-indigo-600"
                                    {{ old('is_active', $user->is_active ?? '') == 1 ? 'checked' : '' }}
                                >
                                <span class="ml-2 text-gray-500">Active</span>
                            </label>

                            <label class="inline-flex items-center">
                                <input type="radio" name="is_active" value="0"
                                       class="form-radio text-indigo-600"
                                    {{ old('is_active', $user->is_active ?? '') == 0 ? 'checked' : '' }}
                                >
                                <span class="ml-2 text-gray-500">Not Active</span>
                            </label>
                        </div>
                        @error('is_active')
                        <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="sm:col-span-4">
                        <label for="password" class="block text-sm/6 font-medium text-gray-500">Password</label>
                        <div class="mt-2">
                            <div class="flex items-center rounded-md bg-white/5 outline-1 -outline-offset-1 outline-white/10 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-500">
                                <x-text-input id="password" class="block mt-1 w-full"
                                              type="password"
                                              name="password"
                                              class="rounded-md border border-gray-400 block min-w-0 grow bg-transparent py-1.5 px-3 text-base text-gray-900 placeholder:text-gray-500 focus:outline-none sm:text-sm/6"
                                              required autocomplete="new-password" />
                            </div>
                            @error('password')
                            <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="sm:col-span-4">
                        <label for="password_confirmation" class="block text-sm/6 font-medium text-gray-500">Confirm Password</label>
                        <div class="mt-2">
                            <div class="flex items-center rounded-md bg-white/5 outline-1 -outline-offset-1 outline-white/10 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-500">
                                <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                              type="password"
                                              name="password_confirmation"
                                              class="rounded-md border border-gray-400 block min-w-0 grow bg-transparent py-1.5 px-3 text-base text-gray-900 placeholder:text-gray-500 focus:outline-none sm:text-sm/6"
                                              required autocomplete="new-password" />
                            </div>
                            @error('password_confirmation')
                            <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-6 flex items-center justify-between gap-x-6">

            <div class="flex items-center gap-x-6">
                <a href="/users" type="button"
                   class="rounded-md bg-gray-400 px-3 py-2 text-sm font-semibold text-white focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">
                    Cancel</a>
                <div>
                    <button type="submit"
                            class="rounded-md bg-indigo-500 px-3 py-2 text-sm font-semibold text-white focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">
                        Create</button>
                </div>

            </div>
        </div>
    </form>
</x-app-layout>
