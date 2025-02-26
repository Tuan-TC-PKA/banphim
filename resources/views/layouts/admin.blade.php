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
                    <button data-menu class="p-4 -ml-3 focus:outline-none" type="button">
                        <svg class="fill-current w-5" viewBox="0 -21 384 384">
                            <path d="M362.668 0H21.332C9.578 0 0 9.578 0 21.332V64c0 11.754 9.578 21.332 21.332 21.332h341.336C374.422 85.332 384 75.754 384 64V21.332C384 9.578 374.422 0 362.668 0zm0 0M362.668 128H21.332C9.578 128 0 137.578 0 149.332V192c0 11.754 9.578 21.332 21.332 21.332h341.336c11.754 0 21.332-9.578 21.332-21.332v-42.668c0-11.754-9.578-21.332-21.332-21.332zm0 0M362.668 256H21.332C9.578 256 0 265.578 0 277.332V320c0 11.754 9.578 21.332 21.332 21.332h341.336c11.754 0 21.332-9.578 21.332-21.332v-42.668c0-11.754-9.578-21.332-21.332-21.332zm0 0" />
                        </svg>
                    </button>

                    <!-- <button data-search class="p-4 md:hidden focus:outline-none" type="button">
                        <svg data-search-icon class="fill-current w-4" viewBox="0 0 512 512" style="top: 0.7rem; left: 1rem;">
                            <path d="M225.474 0C101.151 0 0 101.151 0 225.474c0 124.33 101.151 225.474 225.474 225.474 124.33 0 225.474-101.144 225.474-225.474C450.948 101.151 349.804 0 225.474 0zm0 409.323c-101.373 0-183.848-82.475-183.848-183.848S124.101 41.626 225.474 41.626s183.848 82.475 183.848 183.848-82.475 183.849-183.848 183.849z" />
                            <path d="M505.902 476.472L386.574 357.144c-8.131-8.131-21.299-8.131-29.43 0-8.131 8.124-8.131 21.306 0 29.43l119.328 119.328A20.74 20.74 0 00491.187 512a20.754 20.754 0 0014.715-6.098c8.131-8.124 8.131-21.306 0-29.43z" />
                        </svg>
                    </button> -->

                    <!-- <div data-search-form class="relative mr-3 hidden md:inline-block">
                        <div class="text-gray-500">
                            <svg data-search-icon class="absolute fill-current w-4" viewBox="0 0 512 512" style="top: 0.7rem; left: 1rem;">
                                <path d="M225.474 0C101.151 0 0 101.151 0 225.474c0 124.33 101.151 225.474 225.474 225.474 124.33 0 225.474-101.144 225.474-225.474C450.948 101.151 349.804 0 225.474 0zm0 409.323c-101.373 0-183.848-82.475-183.848-183.848S124.101 41.626 225.474 41.626s183.848 82.475 183.848 183.848-82.475 183.849-183.848 183.849z" />
                                <path d="M505.902 476.472L386.574 357.144c-8.131-8.131-21.299-8.131-29.43 0-8.131 8.124-8.131 21.306 0 29.43l119.328 119.328A20.74 20.74 0 00491.187 512a20.754 20.754 0 0014.715-6.098c8.131-8.124 8.131-21.306 0-29.43z" />
                            </svg>
                        </div>
                        <input type="text" placeholder="Search" name="search" id="search" class="h-auto pl-10 py-2 bg-gray-200 text-sm border border-gray-500 rounded-full focus:outline-none focus:bg-white">
                    </div> -->
                </div>

                <div class="flex items-center">
                    <button data-messages class="p-3 mr-2 focus:outline-none hover:bg-gray-200 hover:rounded-md" typle="button">
                        <svg class="fill-current w-5" viewBox="0 0 512 512">
                            <path d="M339.392 258.624L512 367.744V144.896zM0 144.896v222.848l172.608-109.12zM480 80H32C16.032 80 3.36 91.904.96 107.232L256 275.264l255.04-168.032C508.64 91.904 495.968 80 480 80zM310.08 277.952l-45.28 29.824a15.983 15.983 0 01-8.8 2.624c-3.072 0-6.112-.864-8.8-2.624l-45.28-29.856L1.024 404.992C3.488 420.192 16.096 432 32 432h448c15.904 0 28.512-11.808 30.976-27.008L310.08 277.952z" />
                        </svg>
                    </button>
                    <button data-notifications class="p-3 mr-3 focus:outline-none hover:bg-gray-200 hover:rounded-md" typle="button">
                        <svg class="fill-current w-5" viewBox="-21 0 512 512">
                            <path d="M213.344 512c38.636 0 70.957-27.543 78.379-64H134.965c7.426 36.457 39.746 64 78.379 64zm0 0M362.934 255.98c-.086 0-.172.02-.258.02-82.324 0-149.332-66.988-149.332-149.332 0-22.637 5.207-44.035 14.273-63.277-4.695-.446-9.453-.723-14.273-.723-82.473 0-149.332 66.855-149.332 149.332v59.477c0 42.218-18.496 82.07-50.946 109.503C2.25 370.22-2.55 384.937 1.332 399.297c4.523 16.703 21.035 27.371 38.36 27.371H386.89c18.175 0 35.308-11.777 38.996-29.59 2.86-13.781-2.047-27.543-12.735-36.523-31.02-26.004-48.96-64.215-50.218-104.575zm0 0" />
                            <path style="fill: red;" d="M469.344 106.668c0 58.91-47.754 106.664-106.668 106.664-58.91 0-106.664-47.754-106.664-106.664C256.012 47.758 303.766 0 362.676 0c58.914 0 106.668 47.758 106.668 106.668zm0 0" />
                        </svg>
                    </button>

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