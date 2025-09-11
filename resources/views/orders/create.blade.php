<x-layout>
    <x-slot:heading>
        Start Order
    </x-slot:heading>
    <form method="POST" action="/companies/{{ $company->id }}/orders">
        @csrf
        <div class="space-y-12">
            <div class="border-b border-white/10 pb-12">
                <h2 class="text-base/7 font-semibold text-gray-500">Create a New Order</h2>

                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-6 sm:grid-cols-6">

{{--                    <hr class="sm:col-span-6 mt-2 border-gray-300" />--}}

{{--                    <h2 class="text-base/7 font-semibold text-gray-500 sm:col-span-6">Address</h2>--}}

{{--                     Select Recipient--}}
                    <select class="p-3 rounded-lg border border-gray-300" name="recipient_id" id="recipient_id">
                        <option value="">Select a recipient</option>
                        @foreach($recipients as $recipient)
                            <option value="{{ $recipient->id }}" {{ old('recipient_id') == $recipient->id ? 'selected' : '' }}>
                                {{ $recipient->name }}
                            </option>
                        @endforeach
                    </select>

{{--                     Select Products (multiple)--}}
                    <select class="p-3 rounded-lg border border-gray-300" name="product_ids[]" id="product_ids" multiple>
                        @foreach($products as $product)
                            <option value="{{ $product->id }}" {{ (collect(old('product_ids'))->contains($product->id)) ? 'selected':'' }}>
                                {{ $product->name }} - {{ $product->price }} {{ $product->currency }}
                            </option>
                        @endforeach
                    </select>
{{--                     Select Status (draft/created)--}}

{{--                     Display total amount (read-only) and currency (read-only)--}}


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
