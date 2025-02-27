@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('contents')
    <div class="bg-white p-4 rounded-md">
        <h1 class="text-xl font-semibold mb-4">Welcome to Admin Dashboard</h1>
        
        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
            <!-- Total Products Card -->
            <div class="bg-blue-50 rounded-lg p-4 shadow">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-blue-500 text-white mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 font-medium">Tổng số sản phẩm</p>
                        <p class="text-2xl font-bold text-gray-800">{{ $totalProducts }}</p>
                    </div>
                </div>
            </div>
            
            <!-- Total Revenue Card -->
            <div class="bg-green-50 rounded-lg p-4 shadow">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-green-500 text-white mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 font-medium">Doanh thu</p>
                        <p class="text-2xl font-bold text-gray-800">{{ number_format($totalRevenue) }}đ</p>
                    </div>
                </div>
            </div>
            
            <!-- Total Orders Card -->
            <div class="bg-purple-50 rounded-lg p-4 shadow">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-purple-500 text-white mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 font-medium">Tổng đơn hàng</p>
                        <p class="text-2xl font-bold text-gray-800">{{ $totalOrders }}</p>
                    </div>
                </div>
            </div>
            
            <!-- Pending Orders Card -->
            <div class="bg-yellow-50 rounded-lg p-4 shadow">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-yellow-500 text-white mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 font-medium">Đơn chờ xử lý</p>
                        <p class="text-2xl font-bold text-gray-800">{{ $pendingOrders }}</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Best Selling Products -->
        @if(count($bestSellingProducts) > 0)
        <div class="mt-8">
            <h2 class="text-lg font-semibold mb-4">Sản phẩm bán chạy</h2>
            <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sản phẩm</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Đã bán</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Danh mục</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($bestSellingProducts as $item)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $item->product->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $item->total_sold }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ ucfirst($item->product->category) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif
    </div>
@endsection