<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ hàng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .form-check-input {
            background-color: white;
            border-color: #000;
            cursor: pointer;
        }
        
        .form-check-input:checked {
            background-color: #000 !important;
            border-color: #000 !important;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20'%3e%3cpath fill='none' stroke='%23fff' stroke-linecap='round' stroke-linejoin='round' stroke-width='3' d='M6 10l3 3l6-6'/%3e%3c/svg%3e") !important;
        }
        
        .form-check-input:focus {
            border-color: #000;
            box-shadow: 0 0 0 0.25rem rgba(0, 0, 0, 0.25);
        }

        .form-check-input:hover {
            border-color: #000;
        }
    </style>
</head>
<body>
    <x-navbar-logged-in />

    <div style="margin-top: 80px;">
        <div class="container py-5">
            <h2 class="mb-4">Giỏ hàng của bạn</h2>
            
            <div class="row">
                <div class="col-md-8">
                    @if(count($cartItems) > 0)
                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="selectAll">
                                <label class="form-check-label" for="selectAll">
                                    Chọn tất cả
                                </label>
                            </div>
                        </div>
                        @foreach($cartItems as $id => $item)
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-1">
                                        <div class="form-check">
                                            <input class="form-check-input product-checkbox" 
                                                   type="checkbox" 
                                                   id="product-{{ $item['product']->id }}"
                                                   value="{{ $item['product']->id }}"
                                                   data-price="{{ $item['product']->price }}"
                                                   data-quantity="{{ $item['quantity'] }}">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <img src="{{ asset('storage/'.$item['product']->image) }}" class="img-fluid rounded" alt="{{ $item['product']->name }}">
                                    </div>
                                    <div class="col-md-6">
                                        <h5 class="card-title">{{ $item['product']->name }}</h5>
                                        <p class="card-text text-muted">Mã SP: #{{ $item['product']->id }}</p>
                                        <div class="input-group w-50">
                                            <form action="{{ route('cart.update', $item['product']->id) }}" method="POST" class="d-flex">
                                                @csrf
                                                @method('PATCH')
                                                <button class="btn btn-outline-secondary quantity-decrease" type="button">-</button>
                                                <input type="number" name="quantity" class="form-control text-center" 
                                                       value="{{ $item['quantity'] }}" 
                                                       min="1" 
                                                       max="{{ $item['product']->stock_quantity }}">
                                                <button class="btn btn-outline-secondary quantity-increase" type="button">+</button>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="text-end">
                                            <h6 class="mb-3">{{ number_format($item['product']->price * $item['quantity']) }}đ</h6>
                                            <form action="{{ route('cart.remove', ['id' => $item['product']->id]) }}" method="POST" class="d-inline">
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
                                <span id="subtotal">{{ number_format($subtotal) }}đ</span>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between mb-3">
                                <strong>Tổng thanh toán</strong>
                                <strong class="text-danger" id="total">{{ number_format($total) }}đ</strong>
                            </div>
                            <form action="{{ route('cart.checkout') }}" method="POST" id="checkoutForm">
                                @csrf
                                <div class="mb-3">
                                    <label for="address" class="form-label">Địa chỉ giao hàng</label>
                                    <input type="text" class="form-control" id="address" name="address" required>
                                </div>
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Số điện thoại</label>
                                    <input type="text" class="form-control" id="phone" name="phone_number" required>
                                </div>
                                <input type="hidden" name="selected_items" id="selectedItems">
                                <button type="submit" class="btn btn-primary w-100" id="checkoutButton" 
                                    @if(!session('buy_now_item')) disabled @endif>
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
                const maxValue = parseInt(input.getAttribute('max'));
                
                if(this.classList.contains('quantity-decrease')) {
                    if(currentValue > 1) {
                        input.value = currentValue - 1;
                    }
                } else {
                    // Nếu người dùng đang cố tăng số lượng vượt quá kho hàng
                    if(currentValue >= maxValue) {
                        // Hiển thị thông báo
                        showStockLimitAlert(maxValue);
                        return; // Ngừng xử lý để không gửi request
                    } else {
                        input.value = currentValue + 1;
                    }
                }

                try {
                    const formData = new FormData(form);
                    formData.append('_method', 'PATCH');

                    const response = await fetch(form.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json'
                        }
                    });

                    if (response.ok) {
                        window.location.reload();
                    }
                } catch (error) {
                    console.error('Error:', error);
                }
            });
        });

        // Tạo hàm hiển thị thông báo khi vượt quá số lượng tồn kho
        function showStockLimitAlert(maxStock) {
            console.log('Showing stock limit alert, max stock:', maxStock);
    
            try {
                // Tạo modal Bootstrap
                const modalHtml = `
                    <div class="modal fade" id="stockLimitModal" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-light">
                                    <h5 class="modal-title text-danger"><i class="fas fa-exclamation-circle me-2"></i>Sản phẩm cháy hàng</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p class="fw-bold">Rất tiếc, bạn chỉ có thể mua tối đa ${maxStock} sản phẩm này.</p>
                                    <p>Số lượng trong kho của chúng tôi hiện có hạn.</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                </div>
                            </div>
                        </div>
                    </div>
                `;

                // Remove any existing modals with the same ID
                const existingModal = document.getElementById('stockLimitModal');
                if (existingModal) {
                    existingModal.remove();
                }

                // Thêm modal vào trang
                document.body.insertAdjacentHTML('beforeend', modalHtml);

                // Hiển thị modal
                const modalElement = document.getElementById('stockLimitModal');
                const modal = new bootstrap.Modal(modalElement);
                modal.show();

                // Xóa modal khỏi DOM sau khi đóng
                modalElement.addEventListener('hidden.bs.modal', function() {
                    this.remove();
                });
            } catch (error) {
                console.error('Error showing stock limit alert:', error);
                alert(`Rất tiếc, bạn chỉ có thể mua tối đa ${maxStock} sản phẩm này.`);
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            const selectAll = document.getElementById('selectAll');
            const productCheckboxes = document.querySelectorAll('.product-checkbox');
            const checkoutButton = document.getElementById('checkoutButton');
            const checkoutForm = document.getElementById('checkoutForm');
            const selectedItemsInput = document.getElementById('selectedItems');

            function updateTotal() {
                let total = 0;
                const selectedItems = [];

                productCheckboxes.forEach(checkbox => {
                    if (checkbox.checked) {
                        const price = parseFloat(checkbox.dataset.price);
                        // Get the current quantity from the input field
                        const quantityInput = checkbox.closest('.card-body').querySelector('input[name="quantity"]');
                        const quantity = parseInt(quantityInput.value);
                        total += price * quantity;
                        selectedItems.push(checkbox.value);
                    }
                });

                document.getElementById('subtotal').textContent = new Intl.NumberFormat('vi-VN', {
                    style: 'currency',
                    currency: 'VND'
                }).format(total);
                document.getElementById('total').textContent = new Intl.NumberFormat('vi-VN', {
                    style: 'currency',
                    currency: 'VND'
                }).format(total);

                selectedItemsInput.value = JSON.stringify(selectedItems);
                checkoutButton.disabled = selectedItems.length === 0;
            }

            // Select All functionality
            selectAll.addEventListener('change', function() {
                productCheckboxes.forEach(checkbox => {
                    checkbox.checked = this.checked;
                });
                updateTotal();
            });

            // Individual checkbox functionality
            productCheckboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    const allChecked = Array.from(productCheckboxes).every(cb => cb.checked);
                    selectAll.checked = allChecked;
                    updateTotal();
                });
            });
            
            // Call updateTotal on page load to initialize with correct values
            updateTotal();

            // Add this to your DOMContentLoaded event handler
            document.querySelectorAll('input[name="quantity"]').forEach(input => {
                input.addEventListener('change', updateTotal);
            });

            // Add manual input handling
            document.querySelectorAll('input[name="quantity"]').forEach(input => {
                input.addEventListener('input', function() {
                    const maxValue = parseInt(this.getAttribute('max'));
                    const currentValue = parseInt(this.value);
                    
                    // Check if value exceeds stock limit
                    if (currentValue > maxValue) {
                        // Reset to max value
                        this.value = maxValue;
                        // Show notification
                        showStockLimitAlert(maxValue);
                    }
                });
            });

            // Real-time phone number validation
            const phoneInput = document.getElementById('phone');
            const phoneInputParent = phoneInput.parentElement;
            let feedbackElement = document.createElement('div');
            feedbackElement.className = 'invalid-feedback';
            feedbackElement.textContent = 'Số điện thoại không hợp lệ';
            phoneInputParent.appendChild(feedbackElement);

            phoneInput.addEventListener('input', function() {
                const phoneValue = this.value.trim();
                const phoneRegex = /^0\d{9}$/;
                
                if (phoneValue === '') {
                    // Empty field - reset validation state
                    this.classList.remove('is-invalid');
                    this.classList.remove('is-valid');
                } else if (!phoneRegex.test(phoneValue)) {
                    // Invalid phone number
                    this.classList.add('is-invalid');
                    this.classList.remove('is-valid');
                } else {
                    // Valid phone number
                    this.classList.remove('is-invalid');
                    this.classList.add('is-valid');
                }
            });
        });

        // Thêm event listener cho form checkout
        document.getElementById('checkoutForm').addEventListener('submit', function(e) {
            const selectedItems = document.getElementById('selectedItems').value;
            const phoneInput = document.getElementById('phone');
            const phoneValue = phoneInput.value.trim();
            const phoneRegex = /^0\d{9}$/;
            
            // Kiểm tra sản phẩm đã chọn
            if (!selectedItems || selectedItems === '[]') {
                e.preventDefault();
                alert('Vui lòng chọn ít nhất một sản phẩm để thanh toán');
                return;
            }
            
            // Kiểm tra số điện thoại
            if (!phoneRegex.test(phoneValue)) {
                e.preventDefault();
                // Add invalid class to show the error message
                phoneInput.classList.add('is-invalid');
                // Focus on the phone input
                phoneInput.focus();
            }
        });
    </script>
</body>
</html>