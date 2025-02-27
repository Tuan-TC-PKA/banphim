<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop - DROP Keyboard Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/shop.css') }}">
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
            <h1 class="display-4 fw-bold mb-4">Discover Your Perfect Setup</h1>
            <p class="lead">Premium Mechanical Keyboards, Keycaps & Switches</p>
        </div>
    </div>

    <!-- Categories -->
    <div class="category-wrapper">
        <div class="container">
            <h2 class="section-title">Browse Categories</h2>
            <div class="row g-4">
                @foreach(['keyboard' => 'Keyboards', 'keycap' => 'Keycaps', 'switch' => 'Switches'] as $key => $value)
                <div class="col-md-4">
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
                    <h5 class="section-title">Filters</h5>
                    <form action="{{ route('shop.index') }}" method="GET">
                        <!-- Add search field at the top -->
                        <div class="mb-4">
                            <label class="form-label">Search Products</label>
                            <div class="input-group">
                                <input type="text" name="search" class="form-control" 
                                       value="{{ request('search') }}" placeholder="Enter product name...">
                                <button class="btn btn-outline-secondary" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Price Range</label>
                            <div class="input-group mb-2">
                                <span class="input-group-text bg-white">From</span>
                                <input type="number" name="min_price" class="form-control" 
                                       value="{{ request('min_price') }}" placeholder="0" min="0">
                                <span class="input-group-text bg-white">đ</span>
                            </div>
                            <div class="input-group">
                                <span class="input-group-text bg-white">To</span>
                                <input type="number" name="max_price" class="form-control" 
                                       value="{{ request('max_price') }}" placeholder="2000000" max="2000000">
                                <span class="input-group-text bg-white">đ</span>
                            </div>
                        </div>

                        <div class="mb-4">
                            <h6>Category</h6>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="category[]" value="all" 
                                       id="all" {{ in_array('all', (array)request('category')) ? 'checked' : '' }}>
                                <label class="form-check-label" for="all">All Products</label>
                            </div>
                            @foreach(['keyboard' => 'Keyboards', 'keycap' => 'Keycaps', 'switch' => 'Switches'] as $key => $value)
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
                                <label class="form-check-label" for="inStock">In Stock Only</label>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Apply Filters</button>
                    </form>
                </div>
            </div>

            <!-- Products Grid -->
            <div class="col-lg-9">
                <!-- Sort Options -->
                <div class="sort-section d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <span class="me-3">Sort by:</span>
                        <form action="{{ route('shop.index') }}" method="GET" class="d-inline">
                            <select name="sort" class="form-select form-select-sm d-inline-block w-auto" onchange="this.form.submit()">
                                <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest</option>
                                <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Price: Low to High</option>
                                <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Price: High to Low</option>
                                <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Name: A to Z</option>
                            </select>
                        </form>
                    </div>
                    <small class="text-muted">
                        Showing {{ $products->firstItem() ?? 0 }} - {{ $products->lastItem() ?? 0 }} 
                        of {{ $products->total() ?? 0 }} products
                    </small>
                </div>

                <!-- Products -->
                <div class="row g-4">
                    @forelse($products as $product)
                    <div class="col-md-6 col-lg-4">
                        <div class="product-card h-100 product-link" data-href="{{ route('products.info', $product->id) }}">
                            @if($product->stock_quantity <= 0)
                                <span class="badge bg-danger badge-stock">Out of Stock</span>
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
                        <div class="alert alert-info">No products found.</div>
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