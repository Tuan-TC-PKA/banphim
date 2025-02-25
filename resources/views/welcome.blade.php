<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Drop Clone - Welcome</title>
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    
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
                <button class="hero-button secondary">SHOP DCX COLLECTION</button>
            </div>
        </div>
    </section>

    <section class="product-cards-section">
        <div class="product-card product-card-1">
            <div class="card-content">
                <h3 class="card-title">YOUR RAINY-DAY KEYBOARD</h3>
                <button class="shop-button">SHOP WOBKEY RAINY75 KEYBOARD</button>
            </div>
        </div>

        <div class="product-card product-card-2">
            <div class="card-content">
                <h3 class="card-title">DROP + XDUOO TA-84 OTL AMP/DAC</h3>
                <button class="shop-button">SHOP TA-84 OTL AMP/DAC</button>
                <button class="shop-button" style="margin-top: 10px;">SHOP HD 6XX HEADPHONES</button>
            </div>
        </div>
    </section>

    <section class="category-section">
        <h2 class="category-title">SHOP BY CATEGORY</h2>
        <div class="category-cards-container">
            <div class="category-card">
                <img src="{{ asset('build/assets/images/home.avif') }}" alt="Keyboards Category">
                <div class="category-name">Keyboards</div>
            </div>
            <div class="category-card">
                <img src="{{ asset('build/assets/images/home.avif') }}" alt="Headphones Category">
                <div class="category-name">Headphones</div>
            </div>
            <div class="category-card">
                <img src="{{ asset('build/assets/images/home.avif') }}" alt="Desk Mats Category">
                <div class="category-name">Desk Mats</div>
            </div>
        </div>
    </section>

    <section class="deskscapes-section">
        <h2 class="deskscapes-title">SHOP OUR DESKSCAPES</h2>
        <div class="deskscapes-filter-bar">
            <button class="filter-button">All</button>
            <button class="filter-button">New</button>
            <button class="filter-button">Bright</button>
            <button class="filter-button">Cozy</button>
            <button class="filter-button">Monochrome</button>
            <button class="filter-button">Dark</button>
            <button class="filter-button">RGB</button>
            <button class="filter-button">The Lord of The Rings™</button>
        </div>
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
                    <li><a href="#">About Drop Studio</a></li>
                    <li><a href="#">Student Discount</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                    <li><a href="#">Terms of Use</a></li>
                    <li><a href="#">Cookie Settings</a></li>
                </ul>
            </div>

            <div class="footer-column">
                <div class="footer-heading">DROP REWARDS</div>
                <ul class="footer-links">
                    <li>Get $5 for every 500 points</li>
                    <li>you earn! <a href="#">Learn more</a></li>
                </ul>
                <div class="footer-heading">DROP REFURBISHED</div>
                <ul class="footer-links">
                    <li>Like-new products you can trust</li>
                </ul>
            </div>

            <div class="footer-column">
                <div class="footer-heading">DROP KEYBOARD CLUB SUPPORT</div>
                <ul class="footer-links">
                    <li>Become a member and expand</li>
                    <li>your keycap collection</li>
                </ul>
            </div>

            <div class="footer-column">
                <div class="footer-heading">COLLABORATE WITH US FOLLOW DROP</div>
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