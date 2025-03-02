<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TC Clone - Welcome</title>
    <link rel="stylesheet" href="{{ asset('css/home.css') }}?v={{ config('app.version') }}">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>

    

    @include('components.navbar-logged-out')

    <section class="hero-section">
        <div class="hero-content">
            <h1 class="hero-title">KEYCAP SET—OR CUTE ROBOT?</h1>
            <p class="hero-subtitle">How about a bit of both? Boot up Bim: a DCX set by designer Balance.</p>
            <div class="hero-buttons">
                <a href="{{ route('shop.index') }}"><button class="hero-button">SHOP NOW</button></a>
                
            </div>
        </div>
    </section>

    <section class="product-cards-section">
        <div class="product-card product-card-1">
            <div class="card-content">
                <h3 class="card-title">YOUR RAINY-DAY KEYBOARD</h3>
                <a href="{{ route('shop.index') }}"><button class="shop-button">SHOP WOBKEY RAINY75 KEYBOARD</button></a>
            </div>
        </div>

        <div class="product-card product-card-2">
        <div class="card-content">
                <h3 class="card-title">THE LỎD OF THE RINGS</h3>
                <a href="{{ route('shop.index') }}"><button class="shop-button">BUY NOW</button></a>
            </div>
        </div>
    </section>

    <section class="category-section">
        <h2 class="category-title">SHOP BY CATEGORY</h2>
        <div class="category-cards-container">
            <div class="category-card">
                <a href="{{ route('shop.category', 'keyboard') }}" class="text-decoration-none">
                    @if($randomKeyboard && $randomKeyboard->image)
                        <img src="{{ asset('storage/'.$randomKeyboard->image) }}" alt="Keyboards Category">
                    @else
                        <img src="{{ asset('build/assets/images/home.avif') }}" alt="Keyboards Category">
                    @endif
                    <div class="category-name">Keyboards</div>
                </a>
            </div>
            <div class="category-card">
                <a href="{{ route('shop.category', 'keycap') }}" class="text-decoration-none">
                    @if($randomKeycap && $randomKeycap->image)
                        <img src="{{ asset('storage/'.$randomKeycap->image) }}" alt="Keycaps Category">
                    @else
                        <img src="{{ asset('build/assets/images/home.avif') }}" alt="Keycaps Category">
                    @endif
                    <div class="category-name">Keycaps</div>
                </a>
            </div>
            <div class="category-card">
                <a href="{{ route('shop.category', 'switch') }}" class="text-decoration-none">
                    @if($randomSwitch && $randomSwitch->image)
                        <img src="{{ asset('storage/'.$randomSwitch->image) }}" alt="Switches Category">
                    @else
                        <img src="{{ asset('build/assets/images/home.avif') }}" alt="Switches Category">
                    @endif
                    <div class="category-name">Switches</div>
                </a>
            </div>
        </div>
    </section>

    <section class="deskscapes-section">
        <h2 class="deskscapes-title" style="padding: 20px;">SHOP OUR DESKSCAPES</h2>
        <div class="deskscapes-grid">
            <div class="deskscape-item" style="grid-row-end: span 2;">
                <img src="{{ asset('images/anh1.jpg') }}" alt="Deskscape 1">
            </div>
            <div class="deskscape-item">
                <img src="{{ asset('images/anh2.jpg') }}" alt="Deskscape 2">
            </div>
            <div class="deskscape-item">
                <img src="{{ asset('images/anh3.jpg') }}" alt="Deskscape 3">
            </div>
            <!-- <div class="deskscape-item" style="grid-row-end: span 1.5;">
                <img src="{{ asset('images/anh4.jpg') }}" alt="Deskscape 4">
            </div>
            <div class="deskscape-item" style="grid-row-end: span 2;">
                <img src="{{ asset('images/anh5.jpg') }}" alt="Deskscape 5">
            </div>
            <div class="deskscape-item">
                <img src="{{ asset('images/anh4.jpg') }}" alt="Deskscape 6">
            </div> -->
             <!-- Add more deskscape items here, adjust grid-row-end style as needed -->
        </div>
    </section>

    <footer class="footer-section">
        <div class="footer-container">
            <div class="footer-column">
                <div class="footer-heading">COMPANY</div>
                <ul class="footer-links">
                    <li><a href="#">About TC Studio</a></li>
                    <li><a href="#">Student Discount</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                    <li><a href="#">Terms of Use</a></li>
                    <li><a href="#">Cookie Settings</a></li>
                </ul>
            </div>

            <div class="footer-column">
                <div class="footer-heading">TC REWARDS</div>
                <ul class="footer-links">
                    <li>Get $5 for every 500 points</li>
                    <li>you earn! <a href="#">Learn more</a></li>
                </ul>
                <div class="footer-heading">TC REFURBISHED</div>
                <ul class="footer-links">
                    <li>Like-new products you can trust</li>
                </ul>
            </div>

            <div class="footer-column">
                <div class="footer-heading">TC KEYBOARD CLUB SUPPORT</div>
                <ul class="footer-links">
                    <li>Become a member and expand</li>
                    <li>your keycap collection</li>
                </ul>
            </div>

            <div class="footer-column">
                <div class="footer-heading">COLLABORATE WITH US FOLLOW TC</div>
                <ul class="footer-links">
                    <li><a href="#">Become an Affiliate</a></li>
                    <li><a href="#">For Brands & Designers</a></li>
                </ul>
                <div class="footer-social-icons">
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-tiktok"></i></a>
                    <a href="#"><i class="fab fa-discord"></i></a>
                    <a href="#"><i class="fab fa-facebook"></i></a>
                    <a href="#"><i class="fab fa-x-twitter"></i></a>
                </div>
            </div>

            <div class="footer-column">
                <ul class="footer-links">
                    <li><a href="#">Contact</a></li>
                    <li><a href="#">Community Guidelines</a></li>
                    <li><a href="#">Help Center</a></li>
                    <li><a href="#">Sitemap</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
        </div>
    </footer>

</body>
</html>