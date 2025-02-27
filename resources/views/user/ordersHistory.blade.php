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
                @foreach($order->orderItems as $item)
                <div class="row mb-3">
                    <div class="col-md-2">
                        <img src="{{ asset('storage/'.$item->product->image) }}" class="img-fluid rounded" alt="{{ $item->product->name }}">
                    </div>
                    <div class="col-md-6">
                        <h5>{{ $item->product->name }}</h5>
                        <p class="text-muted">Số lượng: {{ $item->quantity }}</p>
                    </div>
                    <div class="col-md-4 text-end">
                        <h6>{{ number_format($item->price) }}đ</h6>
                    </div>
                </div>
                @endforeach
                <hr>
                <div class="text-end">
                    <h5>Tổng tiền: {{ number_format($order->total_amount) }}đ</h5>
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