@extends('layouts.admin')

@section('title', 'Add Product')

@section('contents')
    <div class="max-w-5xl mx-auto bg-white p-10 rounded-xl shadow-lg border-2 border-gray-100">
        <h2 class="text-3xl font-extrabold text-gray-800 mb-6 text-center">Create New Product</h2>
        <p class="text-gray-600 text-center mb-8 italic">Fill in the details below to add a new product to your store.</p>

        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data"
            class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
            @csrf

            {{-- Hidden Input for Category --}}
            <input type="hidden" name="product[category]" value="{{ $category ?? '' }}">

            {{-- **Product Information Section (Always Visible)** --}}
            <section class="col-span-full">
                <h3 class="text-xl font-semibold text-gray-800 mb-4 border-b-2 border-gray-200 pb-2">General Product Information</h3>

                <div class="form-group">
                    <label for="product_name" class="form-label">Product Name <span class="text-red-500">*</span></label>
                    <input type="text" name="product[name]" id="product_name" value="{{ old('product.name') }}" class="form-input">
                    @error('product.name') <p class="error-message">{{ $errors->first('product.name') }}</p> @enderror
                </div>

                <div class="form-group">
                    <label for="product_price" class="form-label">Price (VNĐ) <span class="text-red-500">*</span></label>
                    <input id="product_price" name="product[price]" type="number" value="{{ old('product.price') }}" class="form-input">
                    @error('product.price') <p class="error-message">{{ $errors->first('product.price') }}</p> @enderror
                </div>

                <div class="form-group">
                    <label for="product_stock_quantity" class="form-label">Stock Quantity <span class="text-red-500">*</span></label>
                    <input id="product_stock_quantity" name="product[stock_quantity]" type="number" value="{{ old('product.stock_quantity') }}" class="form-input">
                    @error('product.stock_quantity') <p class="error-message">{{ $errors->first('product.stock_quantity') }}</p> @enderror
                </div>

                <div class="form-group md:col-span-2">
                    <label for="product_image" class="form-label">Product Image</label>
                    <input type="file" name="product[image]" id="product_image" class="form-input">
                    @error('product.image') <p class="error-message">{{ $errors->first('product.image') }}</p> @enderror
                </div>

                <div class="form-group md:col-span-full">
                    <label for="product_description" class="form-label">Description</label>
                    <textarea name="product[description]" id="product_description" rows="5" class="form-input">{{ old('product.description') }}</textarea>
                    @error('product.description') <p class="error-message">{{ $errors->first('product.description') }}</p> @enderror
                </div>
            </section>


            {{-- **Keycap Specific Fields Section (Conditional Rendering)** --}}
            @if($category == 'keycap')
                <section class="col-span-full">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4 border-b-2 border-gray-200 pb-2">Keycap Specific Details</h3>
                    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                        <div class="form-group">
                            <label for="keycap_material" class="form-label">Material</label>
                            <input type="text" name="keycap[material]" id="keycap_material" value="{{ old('keycap.material') }}" class="form-input">
                            @error('keycap.material') <p class="error-message">{{ $errors->first('keycap.material') }}</p> @enderror
                        </div>
                        <div class="form-group">
                            <label for="keycap_profile" class="form-label">Profile</label>
                            <input type="text" name="keycap[profile]" id="keycap_profile" value="{{ old('keycap.profile') }}" class="form-input">
                            @error('keycap.profile') <p class="error-message">{{ $errors->first('keycap.profile') }}</p> @enderror
                        </div>
                        <div class="form-group">
                            <label for="keycap_layout" class="form-label">Layout</label>
                            <input type="text" name="keycap[layout]" id="keycap_layout" value="{{ old('keycap.layout') }}" class="form-input">
                            @error('keycap.layout') <p class="error-message">{{ $errors->first('keycap.layout') }}</p> @enderror
                        </div>
                        <div class="form-group">
                            <label for="keycap_manufacturer" class="form-label">Manufacturer</label>
                            <input type="text" name="keycap[manufacturer]" id="keycap_manufacturer" value="{{ old('keycap.manufacturer') }}" class="form-input">
                            @error('keycap.manufacturer') <p class="error-message">{{ $errors->first('keycap.manufacturer') }}</p> @enderror
                        </div>
                    </div>
                </section>
            @endif

            {{-- **Keyboard Specific Fields Section (Conditional Rendering)** --}}
            @if($category == 'keyboard')
                <section class="col-span-full">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4 border-b-2 border-gray-200 pb-2">Keyboard Specific Details</h3>
                    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                        <div class="form-group">
                            <label for="keyboard_layout" class="form-label">Layout</label>
                            <input type="text" name="keyboard[layout]" id="keyboard_layout" value="{{ old('keyboard.layout') }}" class="form-input">
                            @error('keyboard.layout') <p class="error-message">{{ $errors->first('keyboard.layout') }}</p> @enderror
                        </div>
                        <div class="form-group">
                            <label for="keyboard_case_material" class="form-label">Case Material</label>
                            <input type="text" name="keyboard[case_material]" id="keyboard_case_material" value="{{ old('keyboard.case_material') }}" class="form-input">
                            @error('keyboard.case_material') <p class="error-message">{{ $errors->first('keyboard.case_material') }}</p> @enderror
                        </div>
                        <div class="form-group">
                            <label for="keyboard_pcb_type" class="form-label">PCB Type</label>
                            <input type="text" name="keyboard[pcb_type]" id="keyboard_pcb_type" value="{{ old('keyboard.pcb_type') }}" class="form-input">
                            @error('keyboard.pcb_type') <p class="error-message">{{ $errors->first('keyboard.pcb_type') }}</p> @enderror
                        </div>
                        <div class="form-group">
                            <label for="keyboard_manufacturer" class="form-label">Manufacturer</label>
                            <input type="text" name="keyboard[manufacturer]" id="keyboard_manufacturer" value="{{ old('keyboard.manufacturer') }}" class="form-input">
                            @error('keyboard.manufacturer') <p class="error-message">{{ $errors->first('keyboard.manufacturer') }}</p> @enderror
                        </div>
                    </div>
                </section>
            @endif

            {{-- **Switch Specific Fields Section (Conditional Rendering)** --}}
            @if($category == 'switch')
                <section class="col-span-full">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4 border-b-2 border-gray-200 pb-2">Switch Specific Details</h3>
                    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                        <div class="form-group">
                            <label for="switch_type" class="form-label">Type</label>
                            <input type="text" name="switch[type]" id="switch_type" value="{{ old('switch.type') }}" class="form-input">
                            @error('switch.type') <p class="error-message">{{ $errors->first('switch.type') }}</p> @enderror
                        </div>
                        <div class="form-group">
                            <label for="switch_actuation_force" class="form-label">Actuation Force</label>
                            <input type="number" name="switch[actuation_force]" id="switch_actuation_force" value="{{ old('switch.actuation_force') }}" class="form-input">
                            @error('switch.actuation_force') <p class="error-message">{{ $errors->first('switch.actuation_force') }}</p> @enderror
                        </div>
                        <div class="form-group">
                            <label for="switch_bottom_out_force" class="form-label">Bottom Out Force</label>
                            <input type="number" name="switch[bottom_out_force]" id="switch_bottom_out_force" value="{{ old('switch.bottom_out_force') }}" class="form-input">
                            @error('switch.bottom_out_force') <p class="error-message">{{ $errors->first('switch.bottom_out_force') }}</p> @enderror
                        </div>
                        <div class="form-group">
                            <label for="switch_manufacturer" class="form-label">Manufacturer</label>
                            <input type="text" name="switch[manufacturer]" id="switch_manufacturer" value="{{ old('switch.manufacturer') }}" class="form-input">
                            @error('switch.manufacturer') <p class="error-message">{{ $errors->first('switch.manufacturer') }}</p> @enderror
                        </div>
                    </div>
                </section>
            @endif


            {{-- Submit Button - Centered below all sections --}}
            <div class="mt-12 col-span-full flex justify-center">
                <button type="submit"
                    class="bg-green-500 hover:bg-green-600 text-white font-bold py-3 px-8 rounded-xl focus:outline-none focus:shadow-outline uppercase tracking-wider">
                    Add Product
                </button>
            </div>
        </form>
    </div>
@endsection