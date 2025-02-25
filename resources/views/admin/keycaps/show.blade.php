@extends('layouts.admin')

@section('title', 'Keycap Detail')

@section('contents')
    <div class="max-w-3xl mx-auto bg-white p-8 rounded-xl shadow-md">
        <h2 class="text-3xl font-semibold text-gray-800 mb-6 text-center">Keycap Detail</h2>
        <div class="border-b border-gray-900/10 pb-12">
            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                <!-- Basic Product Information -->
                <div class="sm:col-span-full">
                    <label class="block text-sm font-medium leading-6 text-gray-900">Name</label>
                    <div class="mt-2">
                        <p class="text-gray-700 font-semibold">{{ $keycap->product->name }}</p>
                    </div>
                </div>

                <div class="sm:col-span-3">
                    <label class="block text-sm font-medium leading-6 text-gray-900">Price</label>
                    <div class="mt-2">
                        <p class="text-gray-700">{{ number_format($keycap->product->price, 2) }} VNĐ</p>
                    </div>
                </div>

                <div class="sm:col-span-3">
                    <label class="block text-sm font-medium leading-6 text-gray-900">Stock Quantity</label>
                    <div class="mt-2">
                        <p class="text-gray-700">{{ $keycap->product->stock_quantity }}</p>
                    </div>
                </div>

                <!-- Keycap Specific Information -->
                <div class="sm:col-span-3">
                    <label class="block text-sm font-medium leading-6 text-gray-900">Material</label>
                    <div class="mt-2">
                        <p class="text-gray-700">{{ $keycap->material }}</p>
                    </div>
                </div>

                <div class="sm:col-span-3">
                    <label class="block text-sm font-medium leading-6 text-gray-900">Profile</label>
                    <div class="mt-2">
                        <p class="text-gray-700">{{ $keycap->profile }}</p>
                    </div>
                </div>

                <div class="sm:col-span-3">
                    <label class="block text-sm font-medium leading-6 text-gray-900">Layout</label>
                    <div class="mt-2">
                        <p class="text-gray-700">{{ $keycap->layout }}</p>
                    </div>
                </div>

                <div class="sm:col-span-3">
                    <label class="block text-sm font-medium leading-6 text-gray-900">Manufacturer</label>
                    <div class="mt-2">
                        <p class="text-gray-700">{{ $keycap->manufacturer }}</p>
                    </div>
                </div>

                <!-- Description -->
                <div class="sm:col-span-full">
                    <label class="block text-sm font-medium leading-6 text-gray-900">Description</label>
                    <div class="mt-2">
                        <p class="text-gray-700">{{ $keycap->product->description ?? 'N/A' }}</p>
                    </div>
                </div>

                <!-- Image -->
                <div class="sm:col-span-full">
                    <label class="block text-sm font-medium leading-6 text-gray-900">Image</label>
                    <div class="mt-2">
                        @if($keycap->product->image)
                            <img src="{{ asset('storage/' . $keycap->product->image) }}" 
                                 alt="{{ $keycap->product->name }}" 
                                 class="rounded-md max-w-full h-auto">
                        @else
                            <p class="text-gray-500 italic">No image available</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-6 flex justify-center gap-4">
            <a href="{{ route('admin.keycaps.index') }}" 
               class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Back to List
            </a>
            <a href="{{ route('admin.keycaps.edit', $keycap->id) }}" 
               class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Edit
            </a>
        </div>
    </div>
@endsection