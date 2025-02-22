<!DOCTYPE html>

<html lang="en"> <head> <meta charset="UTF-8"> <meta name="viewport" content="width=device-width, initial-scale=1.0"> <title>Shop All Products</title> <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"> 
<style>
    .card {
        transition: transform 0.2s;
    }
    
    .card:hover {
        transform: translateY(-5px);
    }

    .card-img-top {
        border-bottom: 1px solid rgba(0,0,0,.125);
    }

    .text-truncate {
        max-width: 100%;
    }
</style>
</head> <body> 
@auth
    <x-navbar-logged-in />
@else
    <x-navbar-logged-out />
@endauth
<div class="container-fluid mt-5 pt-5">
    <!-- Category Navigation -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex overflow-auto pb-3">
                <a href="{{ route('shop.index') }}" class="btn btn-outline-primary me-2">All Products</a>
                <a href="{{ route('shop.category', 'keyboard') }}" class="btn btn-outline-primary me-2">Mechanical Keyboards</a>
                <a href="{{ route('shop.category', 'keycap') }}" class="btn btn-outline-primary me-2">Keycaps</a>
                <a href="{{ route('shop.category', 'switch') }}" class="btn btn-outline-primary me-2">Switches</a>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Filters Sidebar -->
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Filters</h5>
                    
                    <!-- Availability Filter -->
                    <div class="mb-4">
                        <h6 class="mb-2">Availability</h6>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="inStock">
                            <label class="form-check-label" for="inStock">
                                In Stock
                            </label>
                        </div>
                    </div>

                    <!-- Price Range Filter -->
                    <div class="mb-4">
                        <h6 class="mb-2">Price Range</h6>
                        <div class="form-group">
                            <input type="range" class="form-range" min="0" max="1000000" step="100000" id="priceRange">
                            <div class="d-flex justify-content-between">
                                <span>0đ</span>
                                <span>1.000.000đ</span>
                            </div>
                        </div>
                    </div>

                    <!-- Category Filter -->
                    <div class="mb-4">
                        <h6 class="mb-2">Category</h6>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="categoryAll">
                            <label class="form-check-label" for="categoryAll">
                                All Products
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="categoryKeyboards">
                            <label class="form-check-label" for="categoryKeyboards">
                                Keyboards
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="categoryKeycaps">
                            <label class="form-check-label" for="categoryKeycaps">
                                Keycaps
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="categorySwitches">
                            <label class="form-check-label" for="categorySwitches">
                                Switches
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Products Grid -->
        <div class="col-md-9">
            <!-- Sort Options -->
            <div class="row mb-4">
                <div class="col-12 d-flex justify-content-between align-items-center">
                    <div>
                        <form action="{{ route('shop.index') }}" method="GET" class="d-inline">
                            <span class="me-2">Sort by:</span>
                            <select name="sort" class="form-select form-select-sm d-inline-block w-auto" onchange="this.form.submit()">
                                <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest</option>
                                <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Price: Low to High</option>
                                <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Price: High to Low</option>
                                <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Name: A to Z</option>
                            </select>
                        </form>
                    </div>
                    <div>
                        <span>Showing {{ $products->firstItem() }} - {{ $products->lastItem() }} of {{ $products->total() }} products</span>
                    </div>
                </div>
            </div>

            <!-- Products -->
            <div class="row row-cols-1 row-cols-md-3 g-4">
                @foreach($products as $product)
                <div class="col">
                    <div class="card h-100 shadow-sm">
                        <!-- Product Image -->
                        <div class="position-relative">
                            <img src="{{ asset('storage/'.$product->image) }}" 
                                 class="card-img-top" 
                                 alt="{{ $product->name }}"
                                 style="height: 200px; object-fit: cover;">
                            @if($product->stock_quantity <= 0)
                                <div class="position-absolute top-0 end-0 m-2">
                                    <span class="badge bg-danger">Out of Stock</span>
                                </div>
                            @endif
                        </div>

                        <!-- Product Info -->
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title text-truncate">{{ $product->name }}</h5>
                            <p class="card-text text-truncate text-muted mb-3">{{ $product->description }}</p>
                            <div class="mt-auto">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="h5 text-danger mb-0">{{ number_format($product->price) }}đ</span>
                                    <a href="{{ route('products.info', $product->id) }}" 
                                       class="btn btn-outline-primary">
                                        <i class="fas fa-info-circle"></i> Chi tiết
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="row mt-4">
                <div class="col-12 d-flex justify-content-center">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js">

</script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body> </html>