<x-app-layout>
    <x-slot:heading>
        Edit Order: {{ $order->id }}
    </x-slot:heading>
    <form method="POST" action="/orders/{{ $order->id }}">
        <input type="hidden" name="updated_at" value="{{ now() }}">
        @csrf
        @method('PATCH')
        <div class="space-y-12">
            <div class="border-b border-white/10 pb-12">
                <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-6">
                        <p class="mb-2"><strong>Recipient:</strong> {{ $order->recipient->name }}</p>
                        <p class="mb-6"><strong>Company:</strong> {{ $order->company->name }}</p>
                        <label for="products" class="block text-sm font-medium text-gray-700 mb-2">Products</label>
                        <div class="bg-gray-50 p-4 rounded-xl border border-gray-200 shadow-sm">
                            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                                @foreach($companyProducts->chunk(10) as $chunk)
                                    <div class="space-y-2">
                                        @foreach($chunk as $product)
                                            <label class="flex items-center space-x-3">
                                                <input type="checkbox"
                                                       name="product_ids[]"
                                                       value="{{ $product->id }}"
                                                    {{ in_array($product->id, old('product_ids', $orderProductIds)) ? 'checked' : '' }}>
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
                        @error('product_ids')
                        <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    @if($order->status == 'draft' || $order->status == 'created')
                        <div class="sm:col-span-4">
                            <label class="block text-sm/6 font-medium text-gray-500">Status</label>
                            <div class="mt-2 flex gap-4">
                                <label class="inline-flex items-center">
                                    <input type="radio" name="status" value="draft"
                                           class="form-radio text-indigo-600"
                                        {{ old('status', $order->status) == 'draft' ? 'checked' : '' }}>
                                    <span class="ml-2 text-gray-500">Draft</span>
                                </label>

                                <label class="inline-flex items-center">
                                    <input type="radio" name="status" value="created"
                                           class="form-radio text-indigo-600"
                                        {{ old('status', $order->status) == 'created' ? 'checked' : '' }}>
                                    <span class="ml-2 text-gray-500">Created</span>
                                </label>
                            </div>
                            @error('status')
                            <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    @endif


                </div>
            </div>
        </div>

        <div class="mt-6 flex items-center justify-between gap-x-6">
            <div class="flex items-center">
                <button form="delete-form" class="text-red-500 text-sm font-bold">Delete</button>
            </div>

            <div class="flex items-center gap-x-6">
                <a href="/orders/{{ $order->id }}" type="button"
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

    <form method="POST" action="/orders/{{ $order->id }}" id="delete-form" class="hidden">
        @csrf
        @method('DELETE')
    </form>

</x-app-layout>
