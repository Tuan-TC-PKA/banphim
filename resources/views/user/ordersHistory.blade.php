<!-- resources/views/user/orders/history.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Lịch sử mua hàng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <x-navbar-logged-in />

    <div class="container" style="margin-top: 80px;">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <h2 class="mb-4">Lịch sử mua hàng</h2>

        @foreach($orders as $order)
        <div class="card mb-4">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="mb-0">Đơn hàng #{{ $order->id }}</h5>
                        <small class="text-muted">Ngày đặt: {{ $order->created_at->format('d/m/Y H:i') }}</small>
                    </div>
                    <div>
                        <span class="badge bg-{{ $order->status === 'completed' ? 'success' : 'warning' }}">
                            {{ ucfirst($order->status) }}
                        </span>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <!-- Thông tin giao hàng -->
                <div class="mb-3 p-3 bg-light rounded">
                    <div class="row">
                        <div class="col-md-6">
                            <p class="mb-1"><strong><i class="fas fa-map-marker-alt me-2 text-danger"></i>Địa chỉ giao hàng:</strong></p>
                            <p class="mb-2">{{ $order->address }}</p>
                        </div>
                        <div class="col-md-6">
                            <p class="mb-1"><strong><i class="fas fa-phone me-2 text-primary"></i>Số điện thoại:</strong></p>
                            <p class="mb-2">{{ $order->phone_number }}</p>
                        </div>
                    </div>
                </div>
                
                @foreach($order->orderItems as $item)
                <div class="row mb-3">
                    <div class="col-md-2">
                        <a href="{{ route('products.info', $item->product->id) }}" title="Xem thông tin sản phẩm">
                            <img src="{{ asset('storage/'.$item->product->image) }}" class="img-fluid rounded" alt="{{ $item->product->name }}">
                        </a>
                    </div>
                    <div class="col-md-6">
                        <h5>
                            <a href="{{ route('products.info', $item->product->id) }}" class="text-decoration-none text-dark">
                                {{ $item->product->name }}
                            </a>
                        </h5>
                        <p class="text-muted">Số lượng: {{ $item->quantity }}</p>
                    </div>
                    <div class="col-md-4 text-end">
                        <h6>{{ number_format($item->price) }}đ</h6>
                    </div>
                </div>
                @endforeach
                <hr>
                <div class="text-end">
                    @php
                        $subtotal = $order->total_amount;
                        $shippingFee = 0;
                        
                        // Check if the order was under 2 million VND
                        if ($subtotal < 2000000 && $subtotal > 0) {
                            $shippingFee = 30000;
                            $subtotal = $order->total_amount + $shippingFee;
                        }
                    @endphp
                    
                    <div class="mb-2">Tổng tiền hàng: {{ number_format($order->total_amount) }}đ</div>
                    
                    @if($shippingFee > 0)
                        <div class="mb-2">Phí vận chuyển: {{ number_format($shippingFee) }}đ</div>
                    @else
                        <div class="mb-2 text-success"><i class="fas fa-truck me-1"></i> Miễn phí vận chuyển</div>
                    @endif
                    
                    <h5 class="mt-2">Tổng thanh toán: {{ number_format($subtotal) }}đ</h5>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Tự động ẩn alert sau 3 giây
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                const alert = document.querySelector('.alert');
                if (alert) {
                    const bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                }
            }, 3000);
        });
    </script>
</body>
</html>