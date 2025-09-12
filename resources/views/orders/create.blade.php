<x-app-layout>
    <x-slot:heading>
        Start Order
    </x-slot:heading>

    <form method="POST" action="/companies/{{ $company }}/orders">
        @csrf
        <input type="hidden" name="company_id" value="{{ $company }}">
        <input type="hidden" name="placed_at" value="{{ now() }}">
        <div class="space-y-12">
            <div class="border-b border-gray-200 pb-12">
                <h2 class="text-lg font-semibold text-gray-700">Create a New Order</h2>

                <div class="mt-8 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">

                    {{-- Select Recipient --}}
                    <div class="sm:col-span-3">
                        <label for="recipient_id" class="block text-sm font-medium text-gray-700 mb-2">
                            Recipient
                        </label>
                        <select class="w-full p-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 shadow-sm"
                                name="recipient_id" id="recipient_id">
                            <option value="">Select a recipient</option>
                            @foreach($recipients as $recipient)
                                <option value="{{ $recipient->id }}" {{ old('recipient_id') == $recipient->id ? 'selected' : '' }}>
                                    {{ $recipient->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Select Products with Checkboxes --}}
                    <div class="sm:col-span-6">
                        <label for="products" class="block text-sm font-medium text-gray-700 mb-3">
                            Products
                        </label>
                        <div class="bg-gray-50 p-4 rounded-xl border border-gray-200 shadow-sm">
                            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                                @foreach($products->chunk(10) as $chunk)
                                    <div class="space-y-2">
                                        @foreach($chunk as $product)
                                            <label class="flex items-center space-x-3">
                                                <input type="checkbox"
                                                       name="product_ids[]"
                                                       value="{{ $product->id }}"
                                                       class="h-5 w-5 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
                                                    {{ (collect(old('product_ids'))->contains($product->id)) ? 'checked' : '' }}>
                                                <span class="text-sm text-gray-700">
                                {{ $product->name }} –
                                <span class="font-semibold">{{ $product->price }} {{ $product->currency }}</span>
                            </span>
                                            </label>
                                        @endforeach
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

{{--                    Select status--}}
                    <div class="sm:col-span-4">
                        <label class="block text-sm/6 font-medium text-gray-500">Select Status</label>
                        <div class="mt-2 flex gap-4">
                            <label class="inline-flex items-center">
                                <input type="radio" name="status" value="draft"
                                       class="form-radio text-indigo-600"
                                    >
                                <span class="ml-2 text-gray-500">Draft</span>
                            </label>

                            <label class="inline-flex items-center">
                                <input type="radio" name="status" value="created"
                                       class="form-radio text-indigo-600"
                                    >
                                <span class="ml-2 text-gray-500">Created</span>
                            </label>
                        </div>
                        @error('is_active')
                        <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                </div>
            </div>
        </div>

        {{-- Buttons --}}
        <div class="mt-6 flex items-center justify-end gap-x-6">
            <a href="/orders"
               class="rounded-lg bg-gray-300 px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-400 transition">
                Cancel
            </a>
            <button type="submit"
                    class="rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-700 focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition">
                Save
            </button>
        </div>
    </form>
</x-app-layout>
