<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Information</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <x-navbar-logged-in />

    <div class="container mt-5 pt-5">
        <div class="row">
            <!-- Product Image -->
            <div class="col-md-6">
                <img src="{{ asset('storage/'.$product->image) }}" class="img-fluid rounded" alt="{{ $product->name }}">
            </div>

            <!-- Product Information -->
            <div class="col-md-6">
                <h2 class="mb-3">{{ $product->name }}</h2>
                <p class="text-muted mb-2">Mã SP: #{{ $product->id }}</p>
                <h3 class="text-danger mb-4">{{ number_format($product->price) }}đ</h3>
                
                <div class="mb-4">
                    <h5>Mô tả sản phẩm:</h5>
                    <p>{{ $product->description }}</p>
                </div>

                <div class="mb-4">
                    <h5>Số lượng còn lại:</h5>
                    <p>{{ $product->stock_quantity }} sản phẩm</p>
                </div>

                @if($product->stock_quantity > 0)
                    <form action="{{ route('cart.add', $product->id) }}" method="POST">
                        @csrf
                        <div class="d-flex align-items-center mb-4">
                            <label for="quantity" class="me-3">Số lượng:</label>
                            <div class="input-group" style="width: 150px;">
                                <button class="btn btn-outline-secondary" type="button" onclick="decrementQuantity()">-</button>
                                <input type="number" class="form-control text-center" id="quantity" name="quantity" value="1" min="1" max="{{ $product->stock_quantity }}">
                                <button class="btn btn-outline-secondary" type="button" onclick="incrementQuantity()">+</button>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg w-100">
                            <i class="fas fa-shopping-cart me-2"></i>Thêm vào giỏ hàng
                        </button>
                    </form>
                @else
                    <div class="alert alert-warning">
                        Sản phẩm hiện đang hết hàng
                    </div>
                @endif
            </div>
        </div>

        <!-- Product Details Tabs -->
        <div class="row mt-5">
            <div class="col-12">
                <ul class="nav nav-tabs" id="productTabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="details-tab" data-bs-toggle="tab" href="#details">Chi tiết sản phẩm</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="shipping-tab" data-bs-toggle="tab" href="#shipping">Thông tin vận chuyển</a>
                    </li>
                </ul>

                <div class="tab-content p-4 border border-top-0">
                    <div class="tab-pane fade show active" id="details">
                        <div class="row">
                            @if($product->category === 'keyboard' && $product->keyboardDetail)
                                <div class="col-md-6">
                                    <h5 class="mb-3">Thông số kỹ thuật:</h5>
                                    <table class="table">
                                        <tr>
                                            <th>Layout:</th>
                                            <td>{{ $product->keyboardDetail->layout }}</td>
                                        </tr>
                                        <tr>
                                            <th>Kết nối:</th>
                                            <td>{{ $product->keyboardDetail->connectivity }}</td>
                                        </tr>
                                        <tr>
                                            <th>Hãng sản xuất:</th>
                                            <td>{{ $product->keyboardDetail->manufacturer }}</td>
                                        </tr>
                                    </table>
                                </div>

                            @elseif($product->category === 'keycap' && $product->keycapDetail)
                                <div class="col-md-6">
                                    <h5 class="mb-3">Thông số kỹ thuật:</h5>
                                    <table class="table">
                                        <tr>
                                            <th>Chất liệu:</th>
                                            <td>{{ $product->keycapDetail->material }}</td>
                                        </tr>
                                        <tr>
                                            <th>Profile:</th>
                                            <td>{{ $product->keycapDetail->profile }}</td>
                                        </tr>
                                        <tr>
                                            <th>Layout:</th>
                                            <td>{{ $product->keycapDetail->layout }}</td>
                                        </tr>
                                        <tr>
                                            <th>Hãng sản xuất:</th>
                                            <td>{{ $product->keycapDetail->manufacturer }}</td>
                                        </tr>
                                    </table>
                                </div>

                            @elseif($product->category === 'switch' && $product->switchDetail)
                                <div class="col-md-6">
                                    <h5 class="mb-3">Thông số kỹ thuật:</h5>
                                    <table class="table">
                                        <tr>
                                            <th>Loại switch:</th>
                                            <td>{{ $product->switchDetail->type }}</td>
                                        </tr>
                                        <tr>
                                            <th>Lực nhấn:</th>
                                            <td>{{ $product->switchDetail->actuation_force }}g</td>
                                        </tr>
                                        <tr>
                                            <th>Lực tác động:</th>
                                            <td>{{ $product->switchDetail->bottom_out_force }}g</td>
                                        </tr>
                                        <tr>
                                            <th>Hãng sản xuất:</th>
                                            <td>{{ $product->switchDetail->manufacturer }}</td>
                                        </tr>
                                    </table>
                                </div>
                            @endif

                            <div class="col-md-6">
                                <h5 class="mb-3">Mô tả chi tiết:</h5>
                                <p>{{ $product->description }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="tab-pane fade" id="shipping">
                        <h5>Chính sách vận chuyển</h5>
                        <p>Thời gian giao hàng: 2-4 ngày làm việc</p>
                        <p>Phí vận chuyển: 30.000đ cho mọi đơn hàng</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function incrementQuantity() {
            const input = document.getElementById('quantity');
            const max = parseInt(input.getAttribute('max'));
            const currentValue = parseInt(input.value);
            if (currentValue < max) {
                input.value = currentValue + 1;
            }
        }

        function decrementQuantity() {
            const input = document.getElementById('quantity');
            const currentValue = parseInt(input.value);
            if (currentValue > 1) {
                input.value = currentValue - 1;
            }
        }
    </script>
</body>
</html>
