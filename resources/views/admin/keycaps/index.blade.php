@extends('layouts.admin')

@section('title', 'Keycap List') {{-- Specific title for Keycaps --}}

@section('contents')
    <div>
        <h1 class="font-bold text-2xl ml-3">Keycap List</h1>
        <a href="{{ route('admin.keycaps.create') }}"  {{-- Corrected route for Keycap create --}}
            class="text-white float-right bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Add
            Keycap</a>  {{-- Changed button text to "Add Keycap" --}}
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
                    <th scope="col" class="px-6 py-3">Material</th> 
                    <th scope="col" class="px-6 py-3">Profile</th>  
                    <th scope="col" class="px-6 py-3">Action</th>
                </tr>
            </thead>
            <tbody>
                @if($keycaps->count() > 0)  
                    @foreach($keycaps as $rs)  
                        <tr
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $loop->iteration }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $rs->product->name }} 
                            </td>
                            <td class="px-6 py-4">
                                {{ number_format($rs->product->price, 2) }} VNĐ  
                            </td>
                            <td class="px-6 py-4">
                                {{ $rs->material }} 
                            </td>
                            <td class="px-6 py-4">
                                {{ $rs->profile }}  
                            </td>
                            <td class="px-6 py-4 w-36">
                                <div class="h-14 pt-5">
                                    <a href="{{ route('admin.products.show', $rs->product->id) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Detail</a> 
                                    <a href="{{ route('admin.products.edit', $rs->product->id)}}" class="font-medium text-green-600 dark:text-green-500 hover:underline pl-2">Edit</a> 
                                    <form action="{{ route('admin.products.destroy', $rs->product->id) }}" method="POST"  
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="font-medium text-red-600 dark:text-red-500 hover:underline">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td class="px-6 py-4 text-center" colspan="6">
                            <div class="font-medium text-gray-900 dark:text-white">No Keycaps found</div> 
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
@endsection