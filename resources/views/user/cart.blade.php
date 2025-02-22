<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ hàng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <x-navbar-logged-in />

    <div style="margin-top: 80px;">
        <div class="container py-5">
            <h2 class="mb-4">Giỏ hàng của bạn</h2>
            
            <div class="row">
                <div class="col-md-8">
                    @if(count($cartItems) > 0)
                        @foreach($cartItems as $id => $item)
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <img src="{{ asset('storage/'.$item['product']->image) }}" class="img-fluid rounded" alt="{{ $item['product']->name }}">
                                    </div>
                                    <div class="col-md-6">
                                        <h5 class="card-title">{{ $item['product']->name }}</h5>
                                        <p class="card-text text-muted">Mã SP: #{{ $item['product']->id }}</p>
                                        <div class="input-group w-50">
                                            <form action="{{ route('cart.update', $id) }}" method="POST" class="d-flex">
                                                @csrf
                                                @method('PATCH')
                                                <button class="btn btn-outline-secondary quantity-decrease" type="button" data-id="{{ $id }}">-</button>
                                                <input type="number" name="quantity" class="form-control text-center" value="{{ $item['quantity'] }}" min="1">
                                                <button class="btn btn-outline-secondary quantity-increase" type="button" data-id="{{ $id }}">+</button>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="text-end">
                                            <h6 class="mb-3">{{ number_format($item['product']->price * $item['quantity']) }}đ</h6>
                                            <form action="{{ route('cart.remove', $id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger btn-sm">
                                                    <i class="fas fa-trash"></i> Xóa
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @else
                        <div class="alert alert-info">Giỏ hàng trống</div>
                    @endif
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title mb-4">Tóm tắt đơn hàng</h5>
                            <div class="d-flex justify-content-between mb-3">
                                <span>Tổng tiền hàng</span>
                                <span>{{ number_format($subtotal) }}đ</span>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between mb-3">
                                <strong>Tổng thanh toán</strong>
                                <strong class="text-danger">{{ number_format($total) }}đ</strong>
                            </div>
                            <form action="{{ route('cart.checkout') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="address" class="form-label">Địa chỉ giao hàng</label>
                                    <input type="text" class="form-control" id="address" name="address" required>
                                </div>
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Số điện thoại</label>
                                    <input type="text" class="form-control" id="phone" name="phone_number" required>
                                </div>
                                <button type="submit" class="btn btn-primary w-100" {{ count($cartItems) == 0 ? 'disabled' : '' }}>
                                    Thanh toán
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Xử lý tăng giảm số lượng
        document.querySelectorAll('.quantity-decrease, .quantity-increase').forEach(button => {
            button.addEventListener('click', async function(e) {
                e.preventDefault();
                const form = this.closest('form');
                const input = form.querySelector('input[name="quantity"]');
                const currentValue = parseInt(input.value);
                
                if(this.classList.contains('quantity-decrease')) {
                    if(currentValue > 1) input.value = currentValue - 1;
                } else {
                    input.value = currentValue + 1;
                }

                try {
                    const formData = new FormData(form);
                    const response = await fetch(form.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    });

                    if (response.ok) {
                        // Reload only the cart items section
                        window.location.reload();
                    }
                } catch (error) {
                    console.error('Error updating quantity:', error);
                }
            });
        });
    </script>
</body>
</html>