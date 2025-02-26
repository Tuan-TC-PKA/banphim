@extends('layouts.admin')

@section('title', 'Edit Switch')

@section('contents')
    <div class="max-w-5xl mx-auto bg-white p-10 rounded-xl shadow-lg border-2 border-gray-100">
        <h2 class="text-3xl font-extrabold text-gray-800 mb-6 text-center tracking-tight">Edit Switch</h2>
        <p class="text-gray-600 text-center mb-8 italic">Update switch product information.</p>

        <form action="{{ route('admin.keyboard_switches.update', $switch->id) }}" method="POST" enctype="multipart/form-data"
            class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
            @csrf
            @method('PUT')

            {{-- Hidden Input for Category --}}
            <input type="hidden" name="product[category]" value="switch">

            {{-- Product Information Section --}}
            <section class="col-span-full">
                <h3 class="text-lg font-semibold text-gray-800 mb-5 border-b-2 border-gray-200 pb-3">General Product Information</h3>

                <div class="form-group">
                    <label for="product_name" class="form-label">Product Name <span class="text-red-500">*</span></label>
                    <input type="text" name="product[name]" id="product_name" 
                           value="{{ old('product.name', $product->name) }}" class="form-input rounded-lg">
                    @error('product.name') <p class="error-message">{{ $message }}</p> @enderror
                </div>

                <div class="form-group">
                    <label for="product_price" class="form-label">Price (VNĐ) <span class="text-red-500">*</span></label>
                    <input id="product_price" name="product[price]" type="number" 
                           value="{{ old('product.price', $product->price) }}" class="form-input rounded-lg">
                    @error('product.price') <p class="error-message">{{ $message }}</p> @enderror
                </div>

                <div class="form-group">
                    <label for="product_stock_quantity" class="form-label">Stock Quantity <span class="text-red-500">*</span></label>
                    <input id="product_stock_quantity" name="product[stock_quantity]" type="number" 
                           value="{{ old('product.stock_quantity', $product->stock_quantity) }}" class="form-input rounded-lg">
                    @error('product.stock_quantity') <p class="error-message">{{ $message }}</p> @enderror
                </div>

                <div class="form-group md:col-span-2">
                    <label for="product_image" class="form-label">Product Image</label>
                    @if($product->image)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $product->image) }}" alt="Current image" class="w-32 h-32 object-cover rounded">
                        </div>
                    @endif
                    <input type="file" name="product[image]" id="product_image" class="form-input rounded-lg">
                    @error('product.image') <p class="error-message">{{ $message }}</p> @enderror
                </div>

                <div class="form-group md:col-span-full">
                    <label for="product_description" class="form-label">Description</label>
                    <textarea name="product[description]" id="product_description" rows="5" 
                              class="form-input rounded-lg">{{ old('product.description', $product->description) }}</textarea>
                    @error('product.description') <p class="error-message">{{ $message }}</p> @enderror
                </div>
            </section>

            {{-- Switch Specific Fields Section --}}
            <section class="col-span-full">
                <h3 class="text-xl font-semibold text-gray-800 mb-4 border-b-2 border-gray-200 pb-3">Switch Specific Details</h3>
                <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                    <div class="form-group">
                        <label for="switch_type" class="form-label">Type</label>
                        <input type="text" name="switch[type]" id="switch_type" 
                               value="{{ old('switch.type', $product->switchDetail->type ?? '') }}" class="form-input rounded-lg">
                        @error('switch.type') <p class="error-message">{{ $message }}</p> @enderror
                    </div>

                    <div class="form-group">
                        <label for="switch_actuation_force" class="form-label">Actuation Force (g)</label>
                        <input type="number" name="switch[actuation_force]" id="switch_actuation_force" 
                               value="{{ old('switch.actuation_force', $product->switchDetail->actuation_force ?? '') }}" class="form-input rounded-lg">
                        @error('switch.actuation_force') <p class="error-message">{{ $message }}</p> @enderror
                    </div>

                    <div class="form-group">
                        <label for="switch_bottom_out_force" class="form-label">Bottom Out Force (g)</label>
                        <input type="number" name="switch[bottom_out_force]" id="switch_bottom_out_force" 
                               value="{{ old('switch.bottom_out_force', $product->switchDetail->bottom_out_force ?? '') }}" class="form-input rounded-lg">
                        @error('switch.bottom_out_force') <p class="error-message">{{ $message }}</p> @enderror
                    </div>

                    <div class="form-group">
                        <label for="switch_manufacturer" class="form-label">Manufacturer</label>
                        <input type="text" name="switch[manufacturer]" id="switch_manufacturer" 
                               value="{{ old('switch.manufacturer', $product->switchDetail->manufacturer ?? '') }}" class="form-input rounded-lg">
                        @error('switch.manufacturer') <p class="error-message">{{ $message }}</p> @enderror
                    </div>
                </div>
            </section>

            {{-- Submit Button --}}
            <div class="mt-12 col-span-full flex justify-center">
                <button type="submit"
                    class="bg-teal-500 hover:bg-teal-600 active:bg-teal-700 text-white font-bold py-3 px-8 rounded-xl focus:outline-none focus:ring-2 focus:ring-teal-500 uppercase tracking-wider shadow-md">
                    Update Switch
                </button>
            </div>
        </form>
    </div>
@endsection