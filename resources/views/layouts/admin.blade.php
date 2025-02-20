<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>@yield('title')</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/create.css') }}">
</head>

<body>
    <header class="px-4 py-2 shadow">
        <div class="flex justify-between">
            <div class="flex items-center">
                <button data-menu class="p-4 -ml-3 focus:outline-none" type="button">
                    <svg class="fill-current w-5" viewBox="0 -21 384 384">
                        <path
                            d="M362.668 0H21.332C9.578 0 0 9.578 0 21.332V64c0 11.754 9.578 21.332 21.332 21.332h341.336C374.422 85.332 384 75.754 384 64V21.332C384 9.578 374.422 0 362.668 0zm0 0M362.668 128H21.332C9.578 128 0 137.578 0 149.332V192c0 11.754 9.578 21.332 21.332 21.332h341.336c11.754 0 21.332-9.578 21.332-21.332v-42.668c0-11.754-9.578-21.332-21.332-21.332zm0 0M362.668 256H21.332C9.578 256 0 265.578 0 277.332V320c0 11.754 9.578 21.332 21.332 21.332h341.336c11.754 0 21.332-9.578 21.332-21.332v-42.668c0-11.754-9.578-21.332-21.332-21.332zm0 0" />
                    </svg>
                </button>
            </div>
        </div>
    </header>

    <div class="flex flex-row">
        <div
            class="flex flex-col w-64 h-screen overflow-y-auto bg-gray-900 border-r rtl:border-r-0 rtl:border-l dark:bg-gray-900 dark:border-gray-700">
            <div class="sidebar text-center bg-gray-900">
                <div class="text-gray-100 text-xl">
                    <div class="p-2.5 mt-1 flex items-center">
                        <i class="bi bi-app-indicator px-2 py-1 rounded-md bg-blue-600"></i>
                        <h1 class="font-bold text-gray-200 text-[15px] ml-3">Admin</h1>
                    </div>
                    <div class="my-2 bg-gray-600 h-[1px]"></div>
                </div>
                <div class="p-2.5 flex items-center rounded-md px-4 duration-300 cursor-pointer bg-gray-700 text-white">
                    <i class="bi bi-search text-sm"></i>
                    <input type="text" placeholder="Search"
                        class="text-[15px] ml-4 w-full bg-transparent focus:outline-none" />
                </div>
                <!-- Thêm lại các lựa chọn -->
                <nav class="mt-4 text-white">
                    <a href="{{ route('admin.dashboard') }}" class="block p-2.5 rounded-md hover:bg-gray-700">Dashboard</a>
                    {{-- Loại bỏ link "Product" cũ --}}
                    {{-- <a href="{{ route('admin.products.index') }}" class="block p-2.5 rounded-md hover:bg-gray-700">Products</a> --}}

                    <p class="px-4 mt-4 mb-2 text-gray-400 uppercase text-xs">Sản phẩm</p> {{-- Section header --}}
                    <a href="{{ route('admin.products.index') }}" class="block p-2.5 rounded-md hover:bg-gray-700">All Products</a>
                    <a href="{{ route('admin.keycaps.index') }}" class="block p-2.5 rounded-md hover:bg-gray-700">Keycaps</a> 
                    <a href="{{ route('admin.keyboards.index') }}" class="block p-2.5 rounded-md hover:bg-gray-700">Keyboards</a> 
                    <a href="{{ route('admin.keyboard-switches.index') }}" class="block p-2.5 rounded-md hover:bg-gray-700">Switches</a> 

                    <p class="px-4 mt-4 mb-2 text-gray-400 uppercase text-xs">Orders</p>
                    <a href="{{ route('admin.orders.index') }}" class="block p-2.5 rounded-md hover:bg-gray-700">Orders</a>

                    <p class="px-4 mt-4 mb-2 text-gray-400 uppercase text-xs">Account</p>
                    <a href="{{ route('profile.edit') }}" class="block p-2.5 rounded-md hover:bg-gray-700">Profile</a>
                </nav>
            </div>
        </div>
        <div class="flex flex-col w-full h-screen px-4 py-8 mt-10">
            <div>@yield('contents')</div>
        </div>
    </div>
</body>

</html>