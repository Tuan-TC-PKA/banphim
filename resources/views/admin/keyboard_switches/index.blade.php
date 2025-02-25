@extends('layouts.admin')

@section('title', 'Switch List') {{-- Specific title for Switches --}}

@section('contents')
    <div>
        <h1 class="font-bold text-2xl ml-3">Switch List</h1>
        <a href="{{ route('admin.keyboard_switches.create') }}"  {{-- Corrected route for Switch create --}}
            class="text-white float-right bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Add
            Switch</a>  {{-- Changed button text to "Add Switch" --}}
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
                    <th scope="col" class="px-6 py-3">Type</th>  
                    <th scope="col" class="px-6 py-3">Actuation Force</th> 
                    <th scope="col" class="px-6 py-3">Action</th>
                </tr>
            </thead>
            <tbody>
                @if($keyboardSwitches->count() > 0)  
                    @foreach($keyboardSwitches as $rs)  
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
                                {{ $rs->type }}  
                            </td>
                            <td class="px-6 py-4">
                                {{ $rs->actuation_force }} g 
                            </td>
                            <td class="px-6 py-4 w-36">
    <div class="action-buttons">
        <!-- Detail Button -->
        <a href="{{ route('admin.keyboard_switches.show', $rs->id) }}" class="detail-btn">
            <i class="fas fa-info-circle"></i> Detail
        </a>

        <!-- Edit Button -->
        <a href="#" class="edit-btn">
            <i class="fas fa-edit"></i> Edit
        </a>

        <!-- Delete Button -->
        <form action="#" method="POST"
              onsubmit="return confirm('Are you sure you want to delete this switch?')">
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
                            <div class="font-medium text-gray-900 dark:text-white">No Switches found</div> 
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
@endsection