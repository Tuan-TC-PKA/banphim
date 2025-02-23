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

    .category-card {
        transition: transform 0.2s, box-shadow 0.2s;
        overflow: hidden;
    }
    
    .category-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.3);
    }
    
    .category-card img {
        transition: transform 0.3s;
    }
    
    .category-card:hover img {
        transform: scale(1.1);
    }
    
    .category-card span {
        font-size: 1.2rem;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
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
    <div class="row mb-5">
        <div class="col-12">
            <div class="d-flex justify-content-center gap-4">
                <!-- All Products -->
                <a href="{{ route('shop.index') }}" class="text-decoration-none">
                    <div class="category-card position-relative" style="width: 200px; height: 150px;">
                        <img src="{{ asset('storage/categories/all.jpg') }}" 
                             class="w-100 h-100 object-fit-cover rounded" 
                             alt="All Products">
                        <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center" 
                             style="background: rgba(0,0,0,0.4);">
                            <span class="text-white fw-bold">All Products</span>
                        </div>
                    </div>
                </a>

                <!-- Keyboards -->
                <a href="{{ route('shop.category', 'keyboard') }}" class="text-decoration-none">
                    <div class="category-card position-relative" style="width: 200px; height: 150px;">
                        <img src="{{ asset('storage/categories/keyboard.jpg') }}" 
                             class="w-100 h-100 object-fit-cover rounded" 
                             alt="Mechanical Keyboards">
                        <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center" 
                             style="background: rgba(0,0,0,0.4);">
                            <span class="text-white fw-bold">Keyboards</span>
                        </div>
                    </div>
                </a>

                <!-- Keycaps -->
                <a href="{{ route('shop.category', 'keycap') }}" class="text-decoration-none">
                    <div class="category-card position-relative" style="width: 200px; height: 150px;">
                        <img src="{{ asset('storage/categories/keycap.jpg') }}" 
                             class="w-100 h-100 object-fit-cover rounded" 
                             alt="Keycaps">
                        <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center" 
                             style="background: rgba(0,0,0,0.4);">
                            <span class="text-white fw-bold">Keycaps</span>
                        </div>
                    </div>
                </a>

                <!-- Switches -->
                <a href="{{ route('shop.category', 'switch') }}" class="text-decoration-none">
                    <div class="category-card position-relative" style="width: 200px; height: 150px;">
                        <img src="{{ asset('storage/categories/switch.jpg') }}" 
                             class="w-100 h-100 object-fit-cover rounded" 
                             alt="Switches">
                        <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center" 
                             style="background: rgba(0,0,0,0.4);">
                            <span class="text-white fw-bold">Switches</span>
                        </div>
                    </div>
                </a>
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