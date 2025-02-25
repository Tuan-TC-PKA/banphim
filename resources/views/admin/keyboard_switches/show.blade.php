@extends('layouts.admin')

@section('title', 'Switch Detail')

@section('contents')
    <div class="max-w-3xl mx-auto bg-white p-8 rounded-xl shadow-md">
        <h2 class="text-3xl font-semibold text-gray-800 mb-6 text-center">Switch Detail</h2>
        <div class="border-b border-gray-900/10 pb-12">
            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                <!-- Basic Product Information -->
                <div class="sm:col-span-full">
                    <label class="block text-sm font-medium leading-6 text-gray-900">Name</label>
                    <div class="mt-2">
                        <p class="text-gray-700 font-semibold">{{ $switch->product->name }}</p>
                    </div>
                </div>

                <div class="sm:col-span-3">
                    <label class="block text-sm font-medium leading-6 text-gray-900">Price</label>
                    <div class="mt-2">
                        <p class="text-gray-700">{{ number_format($switch->product->price, 2) }} VNĐ</p>
                    </div>
                </div>

                <div class="sm:col-span-3">
                    <label class="block text-sm font-medium leading-6 text-gray-900">Stock Quantity</label>
                    <div class="mt-2">
                        <p class="text-gray-700">{{ $switch->product->stock_quantity }}</p>
                    </div>
                </div>

                <!-- Switch Specific Information -->
                <div class="sm:col-span-3">
                    <label class="block text-sm font-medium leading-6 text-gray-900">Type</label>
                    <div class="mt-2">
                        <p class="text-gray-700">{{ $switch->type }}</p>
                    </div>
                </div>

                <div class="sm:col-span-3">
                    <label class="block text-sm font-medium leading-6 text-gray-900">Manufacturer</label>
                    <div class="mt-2">
                        <p class="text-gray-700">{{ $switch->manufacturer }}</p>
                    </div>
                </div>

                <div class="sm:col-span-3">
                    <label class="block text-sm font-medium leading-6 text-gray-900">Actuation Force</label>
                    <div class="mt-2">
                        <p class="text-gray-700">{{ $switch->actuation_force }}g</p>
                    </div>
                </div>

                <div class="sm:col-span-3">
                    <label class="block text-sm font-medium leading-6 text-gray-900">Bottom Out Force</label>
                    <div class="mt-2">
                        <p class="text-gray-700">{{ $switch->bottom_out_force }}g</p>
                    </div>
                </div>

                <!-- Description -->
                <div class="sm:col-span-full">
                    <label class="block text-sm font-medium leading-6 text-gray-900">Description</label>
                    <div class="mt-2">
                        <p class="text-gray-700">{{ $switch->product->description ?? 'N/A' }}</p>
                    </div>
                </div>

                <!-- Image -->
                <div class="sm:col-span-full">
                    <label class="block text-sm font-medium leading-6 text-gray-900">Image</label>
                    <div class="mt-2">
                        @if($switch->product->image)
                            <img src="{{ asset('storage/' . $switch->product->image) }}" 
                                 alt="{{ $switch->product->name }}" 
                                 class="rounded-md max-w-full h-auto">
                        @else
                            <p class="text-gray-500 italic">No image available</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-6 flex justify-center">
            <a href="{{ route('admin.keyboard_switches.index') }}" 
               class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Back to Switch List
            </a>
        </div>
    </div>
@endsection