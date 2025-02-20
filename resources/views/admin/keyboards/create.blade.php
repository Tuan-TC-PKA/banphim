@extends('layouts.admin')

@section('title', 'Create Keyboard') {{-- Specific title for Keyboard create page --}}

@section('contents')
    <div class="max-w-5xl mx-auto bg-white p-10 rounded-xl shadow-lg border-2 border-gray-100">
        <h2 class="text-3xl font-extrabold text-gray-800 mb-6 text-center tracking-tight">Create New Keyboard</h2> {{-- Specific title for Keyboard --}}
        <p class="text-gray-600 text-center mb-8 italic">Craft a new listing for your amazing keyboard product.</p>

        <form action="{{ route('admin.keyboards.store') }}" method="POST" enctype="multipart/form-data"  {{-- Specific route for Keyboard store --}}
            class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
            @csrf

            {{-- Hidden Input for Category - Set to 'keyboard' --}}
            <input type="hidden" name="product[category]" value="keyboard"> {{-- Hidden input with category 'keyboard' --}}

            {{-- **Product Information Section (Always Visible)** --}}
            <section class="col-span-full">
                <h3 class="text-xl font-semibold text-gray-800 mb-5 border-b-2 border-gray-200 pb-3">General Product Information</h3>

                <div class="form-group">
                    <label for="product_name" class="form-label">Product Name <span class="text-red-500">*</span></label>
                    <input type="text" name="product[name]" id="product_name" value="{{ old('product.name') }}" class="form-input rounded-lg">
                    @error('product.name') <p class="error-message">{{ $message }}</p> @enderror
                </div>

                <div class="form-group">
                    <label for="product_price" class="form-label">Price (VNĐ) <span class="text-red-500">*</span></label>
                    <input id="product_price" name="product[price]" type="number" value="{{ old('product.price') }}" class="form-input rounded-lg">
                    @error('product.price') <p class="error-message">{{ $message }}</p> @enderror
                </div>

                <div class="form-group">
                    <label for="product_stock_quantity" class="form-label">Stock Quantity <span class="text-red-500">*</span></label>
                    <input id="product_stock_quantity" name="product[stock_quantity]" type="number" value="{{ old('product.stock_quantity') }}" class="form-input rounded-lg">
                    @error('product.stock_quantity') <p class="error-message">{{ $message }}</p> @enderror
                </div>

                <div class="form-group md:col-span-2">
                    <label for="product_image" class="form-label">Product Image</label>
                    <input type="file" name="product[image]" id="product_image" class="form-input rounded-lg">
                    @error('product.image') <p class="error-message">{{ $message }}</p> @enderror
                </div>

                <div class="form-group md:col-span-full">
                    <label for="product_description" class="form-label">Description</label>
                    <textarea name="product[description]" id="product_description" rows="5" class="form-input rounded-lg">{{ old('product.description') }}</textarea>
                    @error('product.description') <p class="error-message">{{ $message }}</p> @enderror
                </div>
            </section>


            {{-- **Keyboard Specific Fields Section (Always Visible - as this is keyboard create form)** --}}
            <section class="col-span-full">
                <h3 class="text-xl font-semibold text-gray-800 mb-4 border-b-2 border-gray-200 pb-3">Keyboard Specific Details</h3>
                <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                    <div class="form-group">
                        <label for="keyboard_layout" class="form-label">Layout</label>
                        <input type="text" name="keyboard[layout]" id="keyboard_layout" value="{{ old('keyboard.layout') }}" class="form-input rounded-lg">
                        @error('keyboard.layout') <p class="error-message">{{ $message }}</p> @enderror
                    </div>
                    <div class="form-group">
                        <label for="keyboard_case_material" class="form-label">Case Material</label>
                        <input type="text" name="keyboard[case_material]" id="keyboard_case_material" value="{{ old('keyboard.case_material') }}" class="form-input rounded-lg">
                        @error('keyboard.case_material') <p class="error-message">{{ $message }}</p> @enderror
                    </div>
                    <div class="form-group">
                        <label for="keyboard_pcb_type" class="form-label">PCB Type</label>
                        <input type="text" name="keyboard[pcb_type]" id="keyboard_pcb_type" value="{{ old('keyboard.pcb_type') }}" class="form-input rounded-lg">
                        @error('keyboard.pcb_type') <p class="error-message">{{ $message }}</p> @enderror
                    </div>
                    <div class="form-group">
                        <label for="keyboard_manufacturer" class="form-label">Manufacturer</label>
                        <input type="text" name="keyboard[manufacturer]" id="keyboard_manufacturer" value="{{ old('keyboard.manufacturer') }}" class="form-input rounded-lg">
                        @error('keyboard.manufacturer') <p class="error-message">{{ $message }}</p> @enderror
                    </div>
                </div>
            </section>

            {{-- Submit Button --}}
            <div class="mt-12 col-span-full flex justify-center">
                <button type="submit"
                    class="bg-teal-500 hover:bg-teal-600 active:bg-teal-700 text-white font-bold py-3 px-8 rounded-xl focus:outline-none focus:ring-2 focus:ring-teal-500 uppercase tracking-wider shadow-md">
                    Add Keyboard
                </button> 
            </div>
        </form>
    </div>
@endsection