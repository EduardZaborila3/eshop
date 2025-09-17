<x-app-layout>
    <x-slot:heading>
        Edit Product: {{ $product->name }}
    </x-slot:heading>
    <form method="POST" action="{{ route('products.show', $product) }}">
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
                                       value="{{ $product->name }}"
                                       class="rounded-md border border-gray-400 block min-w-0 grow bg-transparent py-1.5 px-3 text-base text-gray-900 placeholder:text-gray-500 focus:outline-none sm:text-sm/6" />
                            </div>
                            @error('name')
                            <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="sm:col-span-4">
                        <label for="price" class="block text-sm/6 font-medium text-gray-500">Price</label>
                        <div class="mt-2">
                            <div class="flex items-center rounded-md bg-white/5 outline-1 -outline-offset-1 outline-white/10 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-500">
                                <input id="price"
                                       type="text"
                                       name="price"
                                       value="{{ $product->price }}"
                                       class="rounded-md border border-gray-400 block min-w-0 grow bg-transparent py-1.5 px-3 text-base text-gray-900 placeholder:text-gray-500 focus:outline-none sm:text-sm/6"
                                       required
                                />
                            </div>
                            @error('price')
                                <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <x-form-field>
                        <x-form-label for="currency">Currency</x-form-label>
                        <div class="mt-2">
                            <select id="currency" name="currency" class="w-full rounded border-gray-300 shadow-sm p-2">
                                @foreach(\App\Models\Product::CURRENCIES as $currency)
                                    <option value="{{ $currency }}" {{ old('currency', $product->currency ?? '') == $currency ? 'selected' : '' }}>
                                        {{ $currency }}
                                    </option>
                                @endforeach
                            </select>

                            <x-form-error name="currency" />
                        </div>
                    </x-form-field>

                    <div class="sm:col-span-4">
                        <label for="stock" class="block text-sm/6 font-medium text-gray-500">Stock</label>
                        <div class="mt-2">
                            <div class="flex items-center rounded-md bg-white/5 outline-1 -outline-offset-1 outline-white/10 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-500">
                                <input id="stock"
                                       type="text"
                                       name="stock"
                                       value="{{ $product->stock }}"
                                       class="rounded-md border border-gray-400 block min-w-0 grow bg-transparent py-1.5 px-3 text-base text-gray-900 placeholder:text-gray-500 focus:outline-none sm:text-sm/6"
                                       required
                                />
                            </div>
                            @error('stock')
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
                                    {{ old('is_active', $product->is_active) == 1 ? 'checked' : '' }}>
                                <span class="ml-2 text-gray-500">Active</span>
                            </label>

                            <label class="inline-flex items-center">
                                <input type="radio" name="is_active" value="0"
                                       class="form-radio text-indigo-600"
                                    {{ old('is_active', $product->is_active) == 0 ? 'checked' : '' }}>
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
                <a href="{{ route('products.show', $product) }}" type="button"
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

    <form method="POST" action="/products/{{ $product->id }}" id="delete-form" class="hidden">
        @csrf
        @method('DELETE')
    </form>

</x-app-layout>
