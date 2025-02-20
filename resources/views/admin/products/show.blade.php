@extends('layouts.admin')

@section('title', 'Product Detail')

@section('contents')
    <div class="max-w-3xl mx-auto bg-white p-8 rounded-xl shadow-md">
        <h2 class="text-3xl font-semibold text-gray-800 mb-6 text-center">Product Detail</h2>
        <div class="border-b border-gray-900/10 pb-12">
            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">

                <div class="sm:col-span-full">
                    <label class="block text-sm font-medium leading-6 text-gray-900">Name</label>
                    <div class="mt-2">
                        <p class="text-gray-700 font-semibold">{{ $product->name }}</p>
                    </div>
                </div>

                <div class="sm:col-span-3">
                    <label class="block text-sm font-medium leading-6 text-gray-900">Price</label>
                    <div class="mt-2">
                        <p class="text-gray-700">{{ number_format($product->price, 2) }} VNĐ</p>
                    </div>
                </div>

                <div class="sm:col-span-3">
                    <label class="block text-sm font-medium leading-6 text-gray-900">Stock Quantity</label>
                    <div class="mt-2">
                        <p class="text-gray-700">{{ $product->stock_quantity }}</p>
                    </div>
                </div>

                <div class="sm:col-span-full">
                    <label class="block text-sm font-medium leading-6 text-gray-900">Category</label>
                    <div class="mt-2">
                        <p class="text-gray-700">{{ ucfirst($product->category) }}</p>
                    </div>
                </div>

                <div class="sm:col-span-full">
                    <label class="block text-sm font-medium leading-6 text-gray-900">Description</label>
                    <div class="mt-2">
                        <p class="text-gray-700">{{ $product->description ?? 'N/A' }}</p> {{-- N/A if description is null --}}
                    </div>
                </div>

                <div class="sm:col-span-full">
                    <label class="block text-sm font-medium leading-6 text-gray-900">Image</label>
                    <div class="mt-2">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="rounded-md max-w-full h-auto">
                        @else
                            <p class="text-gray-500 italic">No image available</p>
                        @endif
                    </div>
                </div>

            </div>
        </div>

        <div class="mt-6 flex justify-center">
            <a href="{{ route('admin.products.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Back to Product List
            </a>
        </div>
    </div>
@endsection