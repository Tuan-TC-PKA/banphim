<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cửa Hàng - DROP Keyboard Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/shop.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}?v={{ time() }}">
</head>
<body>
    @auth
        <x-navbar-logged-in />
    @else
        <x-navbar-logged-out />
    @endauth

    <!-- Banner -->
    <div class="banner text-center text-white">
        <div class="container">
            <h1 class="display-4 fw-bold mb-4">Khám Phá Thiết Lập Hoàn Hảo Của Bạn</h1>
            <p class="lead">Bàn Phím Cơ, Keycap & Switch Cao Cấp</p>
        </div>
    </div>

    <!-- Categories -->
    <div class="category-wrapper">
        <div class="container">
            <h2 class="section-title">Danh Mục Sản Phẩm</h2>
            <div class="row g-4">
                @foreach(['keyboard' => 'Keyboard', 'keycap' => 'Keycap', 'switch' => 'Switch'] as $key => $value)
                <div class="col-12 col-sm-6 col-md-4">
                    <a href="{{ route('shop.category', $key) }}" class="text-decoration-none">
                        <div class="category-item shadow-sm">
                            <img src="{{ asset('images/categories/' . $key . '.jpg') }}" alt="{{ $value }}">
                            <div class="category-overlay">
                                <h4 class="mb-0">{{ $value }}</h4>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <!-- Filters Sidebar -->
            <div class="col-lg-3 mb-4">
                <div class="filter-card">
                    <h5 class="section-title">Bộ Lọc</h5>
                    <form action="{{ route('shop.index') }}" method="GET">
                        <!-- Add search field at the top -->
                        <div class="mb-4">
                            <label class="form-label">Tìm Kiếm Sản Phẩm</label>
                            <div class="input-group">
                                <input type="text" name="search" class="form-control" 
                                       value="{{ request('search') }}" placeholder="Nhập tên sản phẩm...">
                                <button class="btn btn-outline-secondary" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Khoảng Giá</label>
                            <div class="input-group mb-2">
                                <span class="input-group-text bg-white">Từ</span>
                                <input type="number" name="min_price" class="form-control" 
                                       value="{{ request('min_price') }}" placeholder="0" min="0">
                                <span class="input-group-text bg-white">đ</span>
                            </div>
                            <div class="input-group">
                                <span class="input-group-text bg-white">Đến</span>
                                <input type="number" name="max_price" class="form-control" 
                                       value="{{ request('max_price') }}" placeholder="2000000" max="2000000">
                                <span class="input-group-text bg-white">đ</span>
                            </div>
                        </div>

                        <div class="mb-4">
                            <h6>Danh Mục</h6>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="category[]" value="all" 
                                       id="all" {{ in_array('all', (array)request('category')) ? 'checked' : '' }}>
                                <label class="form-check-label" for="all">All</label>
                            </div>
                            @foreach(['keyboard' => 'Keyboards', 'keycap' => 'Keycaps', 'switch' => 'Switchs'] as $key => $value)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="category[]" value="{{ $key }}" 
                                       id="{{ $key }}" {{ in_array($key, (array)request('category')) ? 'checked' : '' }}>
                                <label class="form-check-label" for="{{ $key }}">{{ $value }}</label>
                            </div>
                            @endforeach
                        </div>

                        <div class="mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="in_stock" id="inStock" 
                                       {{ request('in_stock') ? 'checked' : '' }}>
                                <label class="form-check-label" for="inStock">Còn Hàng</label>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Áp Dụng Bộ Lọc</button>
                    </form>
                </div>
            </div>

            <!-- Products Grid -->
            <div class="col-lg-9">
                <!-- Sort Options -->
                <div class="sort-section d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <span class="me-3">Sắp xếp theo:</span>
                        <form action="{{ route('shop.index') }}" method="GET" class="d-inline">
                            <select name="sort" class="form-select form-select-sm d-inline-block w-auto" onchange="this.form.submit()">
                                <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Mới Nhất</option>
                                <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Giá: Thấp đến Cao</option>
                                <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Giá: Cao đến Thấp</option>
                                <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Tên: A đến Z</option>
                            </select>
                        </form>
                    </div>
                    <small class="text-muted">
                        Hiển thị {{ $products->firstItem() ?? 0 }} - {{ $products->lastItem() ?? 0 }} 
                        của {{ $products->total() ?? 0 }} sản phẩm
                    </small>
                </div>

                <!-- Products -->
                <div class="row g-4">
                    @forelse($products as $product)
                    <div class="col-12 col-sm-6 col-lg-4">
                        <div class="product-card h-100 product-link" data-href="{{ route('products.info', $product->id) }}">
                            @if($product->stock_quantity <= 0)
                                <span class="badge bg-danger badge-stock">Hết Hàng</span>
                            @endif
                            <div class="product-image">
                                <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}">
                            </div>
                            <div class="p-3">
                                <h5 class="mb-2 text-truncate">{{ $product->name }}</h5>
                                <p class="text-muted small mb-3 text-truncate">{{ $product->description }}</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="price-display">{{ number_format($product->price) }}đ</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-12">
                        <div class="alert alert-info">Không tìm thấy sản phẩm nào.</div>
                    </div>
                    @endforelse
                </div>

                <div class="section-divider"></div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>

    <!-- Add some spacing at the bottom -->
    <div class="mb-5"></div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    document.querySelectorAll('.product-link').forEach(card => {
        card.addEventListener('click', function(e) {
            // Chỉ chuyển hướng nếu click không phải vào các elements có class specific
            if (!e.target.closest('.navbar-nav, .dropdown-menu')) {
                window.location.href = this.dataset.href;
            }
        });
    });
    </script>
</body>
</html>