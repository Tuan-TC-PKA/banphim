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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <link rel="stylesheet" href="{{ asset('css/create.css') }}">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <link rel="stylesheet" href="{{ asset('css/show.css') }}">
    <style>
        body {
            overflow: hidden; /* Prevent scrolling on the body */
            height: 100vh;
        }

        .admin-layout {
            display: flex;
            flex-direction: column;
            height: 100vh;
        }

        .header {
            flex-shrink: 0; /* Prevent header from shrinking */
        }

        .main-content {
            display: flex;
            flex: 1;
            overflow: hidden; /* Prevent content area from scrolling */
        }

        .sidebar {
            flex-shrink: 0; /* Prevent sidebar from shrinking */
            width: 16rem; /* w-64 = 16rem */
            overflow-y: auto; /* Allow sidebar content to scroll if needed */
        }

        .content-area {
            flex: 1;
            overflow-y: auto; /* Allow main content to scroll */
            padding: 2rem 1rem;
        }
    </style>
</head>

<body>
    <div class="admin-layout">
        <header class="header px-4 py-2 shadow">
            <div class="flex justify-between">
                <div class="flex items-center">
                </div>

                <div class="flex items-center">
                    

                    <button data-dropdown class="flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150 hover:bg-gray-200 hover:rounded-md" type="button" x-data="{ open: false }" @click="open = !open" :class="{ 'bg-gray-200 rounded-md': open }">
                        <!-- <img src="https://images.unsplash.com/photo-1544005313-94ddf0286df2?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=100&h=100&q=80" alt="Profle" class="h-8 w-8 rounded-full">
  -->
                        <div >{{ Auth::user()->name }}</div>
                        <div class="ms-1">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </div>


                        <div data-dropdown-items class="text-sm text-left absolute top-0 right-0 mt-16 mr-4 bg-white rounded border border-gray-400 shadow origin-top-right right-0 mt-2 w-48 rounded-md shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" x-show="open" @click.away="open = false"
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 scale-95"
                             x-transition:enter-end="opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-75"
                             x-transition:leave-start="opacity-100 scale-100"
                             x-transition:leave-end="opacity-0 scale-95">
                            <ul class="py-1">
                                <li>
                                    <a href="{{ route('profile.edit') }}" class="block w-full px-4 py-2 text-left text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out">
                                        {{ __('Profile') }}
                                    </a>
                                </li>

                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <a href="{{ route('logout') }}"
                                                 onclick="event.preventDefault();
                                                                this.closest('form').submit();" class="block w-full px-4 py-2 text-left text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out">
                                            {{ __('Log Out') }}
                                        </a>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </button>

                </div>
            </div>
        </header>

        <div class="main-content">
            <div class="sidebar bg-gray-900 border-r rtl:border-r-0 rtl:border-l dark:bg-gray-900 dark:border-gray-700">
                <div class="sidebar text-center bg-gray-900">
                    <div class="text-gray-100 text-xl">
                        <div class="p-2.5 mt-1 flex items-center">
                            <i class="bi bi-app-indicator px-2 py-1 rounded-md bg-blue-600"></i>
                            <h1 class="font-bold text-gray-200 text-[15px] ml-3">Admin</h1>
                        </div>
                        <div class="my-2 bg-gray-600 h-[1px]"></div>
                    </div>
                    <!-- <div class="p-2.5 flex items-center rounded-md px-4 duration-300 cursor-pointer bg-gray-700 text-white">
                        <i class="bi bi-search text-sm"></i>
                        <input type="text" placeholder="Search"
                            class="text-[15px] ml-4 w-full bg-transparent focus:outline-none" />
                    </div> -->
                    <!-- Thêm lại các lựa chọn -->
                    <nav class="mt-4 text-white">
                        <a href="{{ route('admin.dashboard') }}" class="block p-2.5 rounded-md hover:bg-gray-700">Dashboard</a>
                        {{-- Loại bỏ link "Product" cũ --}}
                        {{-- <a href="{{ route('admin.products.index') }}" class="block p-2.5 rounded-md hover:bg-gray-700">Products</a> --}}

                        <p class="px-4 mt-4 mb-2 text-gray-400 uppercase text-xs">Sản phẩm</p> {{-- Section header --}}
                        <a href="{{ route('admin.products.index') }}" class="block p-2.5 rounded-md hover:bg-gray-700">All Products</a>
                        <a href="{{ route('admin.keycaps.index') }}" class="block p-2.5 rounded-md hover:bg-gray-700">Keycaps</a>
                        <a href="{{ route('admin.keyboards.index') }}" class="block p-2.5 rounded-md hover:bg-gray-700">Keyboards</a>
                        <a href="{{ route('admin.keyboard_switches.index') }}" class="block p-2.5 rounded-md hover:bg-gray-700">Switches</a>

                        <p class="px-4 mt-4 mb-2 text-gray-400 uppercase text-xs">Orders</p>
                        <a href="{{ route('admin.orders.index') }}" class="block p-2.5 rounded-md hover:bg-gray-700">Orders</a>

                        <p class="px-4 mt-4 mb-2 text-gray-400 uppercase text-xs">Account</p>
                        <a href="{{ route('profile.edit') }}" class="block p-2.5 rounded-md hover:bg-gray-700">Profile</a>
                    </nav>
                </div>
            </div>
            <div class="content-area">
                @yield('contents')
            </div>
        </div>
    </div>
</body>

</html>