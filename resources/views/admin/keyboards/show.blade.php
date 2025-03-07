@extends('layouts.admin')

@section('title', 'Keyboard Detail')

@section('contents')
    <div class="max-w-3xl mx-auto">
        <!-- Fixed Header -->
        <div class="header-container">
            <h2>Keyboard Detail</h2>
        </div>

        <!-- Scrollable Content -->
        <div class="content-container">
            <div class="grid-cols-1 sm:grid-cols-6">
                <div class="border-b border-gray-900/10 pb-12">
                    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <!-- Basic Product Information -->
                        <div class="sm:col-span-full">
                            <label class="block text-sm font-medium leading-6 text-gray-900">Name</label>
                            <div class="mt-2">
                                <p class="text-gray-700 font-semibold">{{ $keyboard->product->name }}</p>
                            </div>
                        </div>

                        <div class="sm:col-span-3">
                            <label class="block text-sm font-medium leading-6 text-gray-900">Price</label>
                            <div class="mt-2">
                                <p class="text-gray-700">{{ number_format($keyboard->product->price, 2) }} VNĐ</p>
                            </div>
                        </div>

                        <div class="sm:col-span-3">
                            <label class="block text-sm font-medium leading-6 text-gray-900">Stock Quantity</label>
                            <div class="mt-2">
                                <p class="text-gray-700">{{ $keyboard->product->stock_quantity }}</p>
                            </div>
                        </div>

                        <!-- Keyboard Specific Information -->
                        <div class="sm:col-span-3">
                            <label class="block text-sm font-medium leading-6 text-gray-900">Layout</label>
                            <div class="mt-2">
                                <p class="text-gray-700">{{ $keyboard->layout }}</p>
                            </div>
                        </div>

                        <div class="sm:col-span-3">
                            <label class="block text-sm font-medium leading-6 text-gray-900">Case Material</label>
                            <div class="mt-2">
                                <p class="text-gray-700">{{ $keyboard->case_material }}</p>
                            </div>
                        </div>

                        <div class="sm:col-span-3">
                            <label class="block text-sm font-medium leading-6 text-gray-900">PCB Type</label>
                            <div class="mt-2">
                                <p class="text-gray-700">{{ $keyboard->pcb_type }}</p>
                            </div>
                        </div>

                        <div class="sm:col-span-3">
                            <label class="block text-sm font-medium leading-6 text-gray-900">Manufacturer</label>
                            <div class="mt-2">
                                <p class="text-gray-700">{{ $keyboard->manufacturer }}</p>
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="sm:col-span-full">
                            <label class="block text-sm font-medium leading-6 text-gray-900">Description</label>
                            <div class="mt-2">
                                <p class="text-gray-700">{{ $keyboard->product->description ?? 'N/A' }}</p>
                            </div>
                        </div>

                        <!-- Image -->
                        <div class="sm:col-span-full">
                            <label class="block text-sm font-medium leading-6 text-gray-900">Image</label>
                            <div class="mt-2">
                                @if($keyboard->product->image)
                                    <img src="{{ asset('storage/' . $keyboard->product->image) }}" 
                                         alt="{{ $keyboard->product->name }}" 
                                         class="rounded-md max-w-full h-auto">
                                @else
                                    <p class="text-gray-500 italic">No image available</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Fixed Footer -->
        <div class="footer-container">
            <a href="{{ route('admin.keyboards.index') }}" class="btn btn-back">
                Back to List
            </a>
            <a href="{{ route('admin.keyboards.edit', $keyboard->id) }}" class="btn btn-edit">
                Edit
            </a>
        </div>
    </div>
@endsection