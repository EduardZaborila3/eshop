<x-app-layout>
    <x-slot:heading>
        Add New Product
    </x-slot:heading>
    <form method="POST" action="/products">
        @csrf
        <div class="space-y-12">
            <div class="border-b border-white/10 pb-12">
                <h2 class="text-base/7 font-semibold text-gray-500">Add a New Product</h2>

                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-6 sm:grid-cols-6">
                    <x-form-field>
                        <x-form-label for="name">Product Name</x-form-label>
                        <div class="mt-2">
                            <x-form-input id="name"  name="name" value="{{ old('name', $product->name ?? '') }}" placeholder="Product Name" />

                            <x-form-error name="name" />
                        </div>
                    </x-form-field>

                    <x-form-field>
                        <x-form-label for="price">Price</x-form-label>
                        <div class="mt-2">
                            <x-form-input id="price"  name="price" value="{{ old('price', $product->price ?? '') }}" placeholder="100" />

                            <x-form-error name="price" />
                        </div>
                    </x-form-field>

                    <x-form-field>
                        <x-form-label for="currency">Currency</x-form-label>
                        <div class="mt-2">
                            <x-form-input id="currency"  name="currency" value="{{ old('stock', $product->currency ?? '') }}" placeholder="EUR" />

                            <x-form-error name="currency" />
                        </div>
                    </x-form-field>

                    <x-form-field>
                        <x-form-label for="stock">Stock</x-form-label>
                        <div class="mt-2">
                            <x-form-input id="stock"  name="stock" value="{{ old('stock', $product->stock ?? '') }}" placeholder="60" />

                            <x-form-error name="stock" />
                        </div>
                    </x-form-field>

                    <x-form-field>
                        <x-form-label for="company_id">Company</x-form-label>
                        <div class="mt-2">
                            <select id="company_id" name="company_id" class="block w-full rounded-md border-gray-300 p-2 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                <option value="">Select a company</option>
                                @foreach($companies as $company)
                                    <option value="{{ $company->id }}" {{ old('company_id') == $company->id ? 'selected' : '' }}>
                                        {{ $company->name }}
                                    </option>
                                @endforeach
                            </select>

                            <x-form-error name="company_id" />
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
            <a href="/products" class="rounded-md bg-gray-400 px-3 py-2 text-sm font-semibold text-white focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">Cancel</a>
            <x-form-button>Save</x-form-button>
        </div>
    </form>

</x-app-layout>
