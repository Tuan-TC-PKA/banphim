@extends('layouts.admin')

@section('title', 'Product List')

@section('contents')
    <div>
        <h1 class="font-bold text-2xl ml-3">Product List</h1>
        {{-- Removed "Add Product" button --}}
        <hr />
        @if(Session::has('success'))
            <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                role="alert">
                {{ Session::get('success') }}
            </div>
        @endif

        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
               <tr>
                    <th scope="col" class="px-6 py-3">#</th>
                    <th scope="col" class="px-6 py-3">Name</th>
                    <th scope="col" class="px-6 py-3">Price</th>
                    <th scope="col" class="px-6 py-3">Category</th>
                    <th scope="col" class="px-6 py-3">Stock</th>
                    <th scope="col" class="px-6 py-3">Action</th>
                </tr>
            </thead>
            <tbody>
                @if($products->count() > 0)
                    @foreach($products as $rs)
                        <tr
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $loop->iteration }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $rs->name }}
                            </td>
                            <td class="px-6 py-4">
                                {{ number_format($rs->price, 2) }} VNĐ  {{-- Format price as Vietnamese Dong --}}
                            </td>
                            <td class="px-6 py-4">
                                {{ ucfirst($rs->category) }} {{-- Capitalize category for display --}}
                            </td>
                            <td class="px-6 py-4">
                                {{ $rs->stock_quantity }}
                            </td>
                            <td class="px-6 py-4 w-36">
    <div class="action-buttons">
        <!-- Detail Button -->
        <a href="{{ route('admin.products.show', $rs->id) }}" class="detail-btn">
            <i class="fas fa-info-circle"></i> Detail
        </a>

        <!-- Edit Button -->
        <a href="{{ route('admin.products.edit', $rs->id) }}" class="edit-btn">
            <i class="fas fa-edit"></i> Edit
        </a>

        <!-- Delete Button (inside form) -->
        <form action="{{ route('admin.products.destroy', $rs->id) }}" method="POST"
              onsubmit="return confirm('Are you sure you want to delete this product?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="delete-btn">
                <i class="fas fa-trash"></i> Delete
            </button>
        </form>
    </div>
</td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td class="px-6 py-4 text-center" colspan="6">
                            <div class="font-medium text-gray-900 dark:text-white">No Products found</div>
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
@endsection