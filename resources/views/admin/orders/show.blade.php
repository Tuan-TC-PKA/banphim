@extends('layouts.admin')

@section('title', 'Order Details')

@section('contents')
<div class="bg-white p-4 rounded-md">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-xl font-semibold">Chi tiết đơn hàng #{{ $order->id }}</h1>
        <a href="{{ route('admin.orders.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600">
            Quay lại
        </a>
    </div>

    <div class="grid grid-cols-2 gap-6 mb-6">
        <div class="bg-gray-50 p-4 rounded-md">
            <h2 class="text-lg font-semibold mb-4">Thông tin khách hàng</h2>
            <dl class="space-y-2">
                <div class="flex">
                    <dt class="w-1/3 text-gray-500">Tên khách hàng:</dt>
                    <dd class="w-2/3">{{ $order->user->name }}</dd>
                </div>
                <div class="flex">
                    <dt class="w-1/3 text-gray-500">Email:</dt>
                    <dd class="w-2/3">{{ $order->user->email }}</dd>
                </div>
                <div class="flex">
                    <dt class="w-1/3 text-gray-500">Số điện thoại:</dt>
                    <dd class="w-2/3">{{ $order->phone_number }}</dd>
                </div>
                <div class="flex">
                    <dt class="w-1/3 text-gray-500">Địa chỉ:</dt>
                    <dd class="w-2/3">{{ $order->address }}</dd>
                </div>
            </dl>
        </div>

        <div class="bg-gray-50 p-4 rounded-md">
            <h2 class="text-lg font-semibold mb-4">Thông tin đơn hàng</h2>
            <dl class="space-y-2">
                <div class="flex">
                    <dt class="w-1/3 text-gray-500">Mã đơn hàng:</dt>
                    <dd class="w-2/3">#{{ $order->id }}</dd>
                </div>
                <div class="flex">
                    <dt class="w-1/3 text-gray-500">Ngày đặt:</dt>
                    <dd class="w-2/3">{{ $order->created_at->format('d/m/Y H:i') }}</dd>
                </div>
                <div class="flex">
                    <dt class="w-1/3 text-gray-500">Trạng thái:</dt>
                    <dd class="w-2/3">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                            {{ $order->status === 'completed' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                            {{ ucfirst($order->status) }}
                        </span>
                    </dd>
                </div>
                <div class="flex">
                    <dt class="w-1/3 text-gray-500">Tổng tiền:</dt>
                    <dd class="w-2/3 font-semibold">{{ number_format($order->total_amount) }}đ</dd>
                </div>
            </dl>
        </div>
    </div>

    <div class="mt-8">
        <h2 class="text-lg font-semibold mb-4">Chi tiết sản phẩm</h2>
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Sản phẩm
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Giá
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Số lượng
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Tổng
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($order->orderItems as $item)
                <tr>
                    <td class="px-6 py-4">
                        <div class="flex items-center">
                            <div class="h-10 w-10 flex-shrink-0">
                                <img class="h-10 w-10 rounded-full" src="{{ asset('storage/'.$item->product->image) }}" alt="">
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900">
                                    {{ $item->product->name }}
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ number_format($item->price) }}đ
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $item->quantity }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ number_format($item->price * $item->quantity) }}đ
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection