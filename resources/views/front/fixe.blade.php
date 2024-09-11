<!DOCTYPE html>
<html class="no-js" lang="fr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title> @yield('titre') – {{ config('app.name') }}</title>
    <meta name="robots" content="index, follow" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon -->
    @if ($infos->icon)
        <link rel="shortcut icon" type="image/x-icon" href="{{ Storage::url($infos->icon) }}">
    @else
        <link rel="shortcut icon" type="image/x-icon" href="/icons/icon-black.png">
    @endif
    <meta name="csrf-token" id="csrf-token" content="{{ csrf_token() }}">
    <!-- CSS
 ============================================ -->

    <!-- Vendor CSS (Bootstrap & Icon Font) -->
    <link rel="stylesheet" href="/assets/css/vendor/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/vendor/fontawesome.min.css">
    <link rel="stylesheet" href="/assets/css/vendor/themify-icons.css">
    <link rel="stylesheet" href="/assets/css/vendor/customFonts.css">
    <link rel="stylesheet" href="/style.css?v={{ time() }}">

    <!-- Plugins CSS (All Plugins Files) -->
    <link rel="stylesheet" href="/assets/css/plugins/select2.min.css">
    <link rel="stylesheet" href="/assets/css/plugins/perfect-scrollbar.css">
    <link rel="stylesheet" href="/assets/css/plugins/swiper.min.css">
    <link rel="stylesheet" href="/assets/css/plugins/nice-select.css">
    <link rel="stylesheet" href="/assets/css/plugins/ion.rangeSlider.min.css">
    <link rel="stylesheet" href="/assets/css/plugins/photoswipe.css">
    <link rel="stylesheet" href="/assets/css/plugins/photoswipe-default-skin.css">
    <link rel="stylesheet" href="/assets/css/plugins/magnific-popup.css">
    <link rel="stylesheet" href="/assets/css/plugins/slick.css">
    <link rel="stylesheet" href="/assets/css/style.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @livewireStyles

    @yield('SEO')

    <style>
        .form-control-select-x{
            width: 100% !important;
            border: solid 1px white !important;
            height: 40px !important;
            margin-top: 10px !important;
            border-bottom: solid 1px rgba(68, 67, 67, 0.13) !important;
        }
    </style>
    
</head>

<body>
    @if ($infos->header_text)
        <!-- Topbar Section Start -->
        <div class="topbar-section section bg-dark">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <p class="text-center my-2 text-white">
                            {{ $infos->header_text }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Topbar Section End -->
    @endif

    <!-- Header Section Start -->
    <div class="header-section header-menu-center section bg-white d-none d-xl-block">
        <div class="container">
            <div class="row align-items-center">

                <!-- Header Logo Start -->
                <div class="col">
                    <div class="header-logo">
                        <a href="{{ route('home') }}">
                            <img src="/icons/logo-black.png" height="55" alt="{{ config('app.name') }} Logo">
                        </a>
                    </div>
                </div>
                <!-- Header Logo End -->

                <!-- Search Start -->
                <div class="col">
                    <nav class="site-main-menu menu-height-100 justify-content-center">
                        <x-FrontMenu></x-FrontMenu>
                    </nav>
                </div>
                <!-- Search End -->

                <!-- Header Tools Start -->
                <div class="col">
                    <div class="header-tools justify-content-end">
                        <div class="header-login">
                            @guest
                                <a href="{{ route('login') }}">
                                    <i class="far fa-user"></i>
                                </a>
                            @endguest
                            @auth
                                <a href="{{ route('profile') }}">
                                    {{ Str::limit(Auth::user()->nom, 7) }}
                                </a>
                            @endauth
                        </div>
                        <div class="header-search d-none d-sm-block">
                            <a href="#offcanvas-search" class="offcanvas-toggle"><i class="fas fa-search"></i></a>
                        </div>
                        @auth
                            <div class="header-wishlist">
                                <a href="#offcanvas-wishlist" class="offcanvas-toggle">
                                    <span class="wishlist-count">0</span>
                                    <i class="far fa-heart"></i>
                                </a>
                            </div>
                        @endauth
                        <div class="header-cart">
                            <a href="#offcanvas-cart" class="offcanvas-toggle">
                                <span class="cart-count">0</span>
                                <i class="fas fa-shopping-cart"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- Header Tools End -->

            </div>
        </div>

    </div>
    <!-- Header Section End -->

    <!-- Header Sticky Section Start -->
    <div class="sticky-header header-menu-center section bg-white d-none d-xl-block">
        <div class="container">
            <div class="row align-items-center">

                <!-- Header Logo Start -->
                <div class="col">
                    <div class="header-logo">
                        <a href="{{ route('home') }}">
                            <img src="/icons/logo-black.png" height="40" alt="{{ config('app.name') }} Logo">
                        </a>
                    </div>
                </div>
                <!-- Header Logo End -->

                <!-- Search Start -->
                <div class="col d-none d-xl-block">
                    <nav class="site-main-menu justify-content-center">
                        <x-FrontMenu></x-FrontMenu>
                    </nav>
                </div>
                <!-- Search End -->

                <!-- Header Tools Start -->
                <div class="col-auto">
                    <div class="header-tools justify-content-end">
                        <div class="header-login">
                            @guest
                                <a href="{{ route('login') }}">
                                    <i class="far fa-user"></i>
                                </a>
                            @endguest
                            @auth
                                <a href="{{ route('profile') }}">
                                    {{ Str::limit(Auth::user()->nom, 7) }}
                                </a>
                            @endauth
                        </div>
                        <div class="header-search d-none d-sm-block">
                            <a href="#offcanvas-search" class="offcanvas-toggle"><i class="fas fa-search"></i></a>
                        </div>
                        @auth
                            <div class="header-wishlist">
                                <a href="#offcanvas-wishlist" class="offcanvas-toggle">
                                    <span class="wishlist-count">0</span>
                                    <i class="far fa-heart"></i>
                                </a>
                            </div>
                        @endauth
                        <div class="header-cart">
                            <a href="#offcanvas-cart" class="offcanvas-toggle">
                                <span class="cart-count">0</span>
                                <i class="fas fa-shopping-cart"></i>
                            </a>
                        </div>
                        <div class="mobile-menu-toggle d-xl-none">
                            <a href="#offcanvas-mobile-menu" class="offcanvas-toggle">
                                <svg viewBox="0 0 800 600">
                                    <path
                                        d="M300,220 C300,220 520,220 540,220 C740,220 640,540 520,420 C440,340 300,200 300,200"
                                        class="top"></path>
                                    <path d="M300,320 L540,320" class="middle"></path>
                                    <path
                                        d="M300,210 C300,210 520,210 540,210 C740,210 640,530 520,410 C440,330 300,190 300,190"
                                        class="bottom"
                                        transform="translate(480, 320) scale(1, -1) translate(-480, -318) "></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- Header Tools End -->

            </div>
        </div>

    </div>
    <!-- Header Sticky Section End -->
    <!-- Mobile Header Section Start -->
    <div class="mobile-header bg-white section d-xl-none">
        <div class="container">
            <div class="row align-items-center">

                <!-- Header Logo Start -->
                <div class="col">
                    <div class="header-logo">
                        <a href="{{ route('home') }}">
                            <img src="/icons/logo-black.png" height="30" alt="{{ config('app.name') }} Logo">
                        </a>
                    </div>
                </div>
                <!-- Header Logo End -->

                <!-- Header Tools Start -->
                <div class="col-auto">
                    <div class="header-tools justify-content-end">
                        <div class="header-login d-none d-sm-block">
                            @guest
                                <a href="{{ route('login') }}">
                                    <i class="far fa-user"></i>
                                </a>
                            @endguest
                            @auth
                                <a href="{{ route('profile') }}">
                                    {{ Str::limit(Auth::user()->nom, 7) }}
                                </a>
                            @endauth
                        </div>
                        <div class="header-search d-none d-sm-block">
                            <a href="#offcanvas-search" class="offcanvas-toggle"><i class="fas fa-search"></i></a>
                        </div>
                        @auth
                            <div class="header-wishlist d-none d-sm-block">
                                <a href="#offcanvas-wishlist" class="offcanvas-toggle">
                                    <span class="wishlist-count">0</span>
                                    <i class="far fa-heart"></i>
                                </a>
                            </div>
                        @endauth
                        <div class="header-cart">
                            <a href="#offcanvas-cart" class="offcanvas-toggle">
                                <span class="cart-count">0</span>
                                <i class="fas fa-shopping-cart"></i>
                            </a>
                        </div>
                        <div class="mobile-menu-toggle">
                            <a href="#offcanvas-mobile-menu" class="offcanvas-toggle">
                                <svg viewBox="0 0 800 600">
                                    <path
                                        d="M300,220 C300,220 520,220 540,220 C740,220 640,540 520,420 C440,340 300,200 300,200"
                                        class="top"></path>
                                    <path d="M300,320 L540,320" class="middle"></path>
                                    <path
                                        d="M300,210 C300,210 520,210 540,210 C740,210 640,530 520,410 C440,330 300,190 300,190"
                                        class="bottom"
                                        transform="translate(480, 320) scale(1, -1) translate(-480, -318) "></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- Header Tools End -->
            </div>
        </div>
    </div>
    <!-- Mobile Header Section End -->

    <!-- Mobile Header Section Start -->
    <div class="mobile-header sticky-header bg-white section d-xl-none">
        <div class="container">
            <div class="row align-items-center">

                <!-- Header Logo Start -->
                <div class="col">
                    <div class="header-logo">
                        <a href="{{ route('home') }}">
                            <img src="/icons/logo-black.png" height="30" alt="{{ config('app.name') }} Logo">
                        </a>
                    </div>
                </div>
                <!-- Header Logo End -->

                <!-- Header Tools Start -->
                <div class="col-auto">
                    <div class="header-tools justify-content-end">
                        <div class="header-login d-none d-sm-block">
                            @guest
                                <a href="{{ route('login') }}">
                                    <i class="far fa-user"></i>
                                </a>
                            @endguest
                            @auth
                                <a href="{{ route('profile') }}">
                                    {{ Str::limit(Auth::user()->nom, 7) }}
                                </a>
                            @endauth
                        </div>
                        <div class="header-search d-none d-sm-block">
                            <a href="#offcanvas-search" class="offcanvas-toggle"><i class="fas fa-search"></i></a>
                        </div>
                        @auth
                            <div class="header-wishlist d-none d-sm-block">
                                <a href="#offcanvas-wishlist" class="offcanvas-toggle">
                                    <span class="wishlist-count">0</span>
                                    <i class="far fa-heart"></i>
                                </a>
                            </div>
                        @endauth
                        <div class="header-cart">
                            <a href="#offcanvas-cart" class="offcanvas-toggle">
                                <span class="cart-count">0</span>
                                <i class="fas fa-shopping-cart"></i>
                            </a>
                        </div>
                        <div class="mobile-menu-toggle">
                            <a href="#offcanvas-mobile-menu" class="offcanvas-toggle">
                                <svg viewBox="0 0 800 600">
                                    <path
                                        d="M300,220 C300,220 520,220 540,220 C740,220 640,540 520,420 C440,340 300,200 300,200"
                                        class="top"></path>
                                    <path d="M300,320 L540,320" class="middle"></path>
                                    <path
                                        d="M300,210 C300,210 520,210 540,210 C740,210 640,530 520,410 C440,330 300,190 300,190"
                                        class="bottom"
                                        transform="translate(480, 320) scale(1, -1) translate(-480, -318) "></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- Header Tools End -->

            </div>
        </div>
    </div>
    <!-- Mobile Header Section End -->
    <!-- OffCanvas Search Start -->
    <div id="offcanvas-search" class="offcanvas offcanvas-search">
        <div class="inner">
            <div class="offcanvas-search-form">
                <button class="offcanvas-close">×</button>
                <form action="{{ route('shop') }}" method="get">
                    <div class="row mb-n3">
                        <div class="col-lg-8 col-12 mb-3">
                            <input type="text" name="key" placeholder="Rechercher des produits...">
                        </div>
                        <div class="col-lg-4 col-12 mb-3">
                            <select class="search-select select2-basic">
                                <option value="0">All Categories</option>
                                <option value="kids-babies">Kids &amp; Babies</option>
                                <option value="home-decor">Home Decor</option>
                                <option value="gift-ideas">Gift ideas</option>
                                <option value="kitchen">Kitchen</option>
                                <option value="toys">Toys</option>
                                <option value="kniting-sewing">Kniting &amp; Sewing</option>
                                <option value="pots">Pots</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <p class="search-description text-body-light mt-2">
                <span># Tapez au moins 1 caractère pour rechercher</span>
                <span># Appuyez sur Entrée pour rechercher ou ESC pour fermer</span>
            </p>

        </div>
    </div>
    <!-- OffCanvas Search End -->

    <!-- OffCanvas Wishlist Start -->
    <div id="offcanvas-wishlist" class="offcanvas offcanvas-wishlist">
        <div class="inner">
            <div class="head">
                <span class="title">
                    liste de souhaits
                </span>
                <button class="offcanvas-close">×</button>
            </div>
            <div class="body customScroll" id="liste-wishlist">

            </div>
        </div>
    </div>
    <!-- OffCanvas Wishlist End -->

    <!-- OffCanvas Cart Start -->
    <div id="offcanvas-cart" class="offcanvas offcanvas-cart panier-modal">
        <div class="inner">
            <div class="head">
                <span class="title">Cart</span>
                <button class="offcanvas-close">×</button>
            </div>
            <div class="body customScroll">

            </div>
            <div class="foot">
                <div class="sub-total">
                    <strong>Sous-total :</strong>
                    <span class="amount">
                        <span class="montant">0</span>
                        <x-devise></x-devise>
                    </span>

                </div>
                <div class="buttons">
                    <a href="{{ route('cart') }}" class="btn btn-dark btn-hover-primary">
                        Voir le panier
                    </a>
                    <a href="{{ route('checkout') }}" class="btn btn-outline-dark">
                        Aller au paiement
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- OffCanvas Cart End -->

    <!-- OffCanvas Search Start -->
    <div id="offcanvas-mobile-menu" class="offcanvas offcanvas-mobile-menu">
        <div class="inner customScroll">
            <div class="offcanvas-menu-search-form">
                <form action="#">
                    <input type="text" placeholder="Search...">
                    <button><i class="fas fa-search"></i></button>
                </form>
            </div>
            <div class="offcanvas-menu">
                <x-FrontMenu></x-FrontMenu>
            </div>
            <div class="offcanvas-buttons">
                <div class="header-tools">
                    <div class="header-login">
                        @guest
                            <a href="{{ route('login') }}">
                                <i class="far fa-user"></i>
                            </a>
                        @endguest
                        @auth
                            <a href="{{ route('profile') }}">
                                {{ Str::limit(Auth::user()->nom, 7) }}
                            </a>
                        @endauth
                    </div>
                    @auth
                        <div class="header-wishlist">
                            <a href="{{ route('favoris_index') }}">
                                <span class="wishlist-count">0</span>
                                <i class="far fa-heart"></i>
                            </a>
                        </div>
                    @endauth
                    <div class="header-cart">
                        <a href="{{ route('cart') }}">
                            <span class="cart-count">0</span>
                            <i class="fas fa-shopping-cart"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="offcanvas-social">
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-youtube"></i></a>
            </div>
        </div>
    </div>
    <!-- OffCanvas Search End -->



    <div class="preloader-container">
        <div class="preloader-circle"></div>
        <div class="preloader-logo">Fresh Home</div>
    </div>



    @yield('body')



    <div class="footer2-section section section-padding">
        <div class="container">
            <div class="row {{ config('app.name') }}-mb-n40">

                <div class="col-lg-6 {{ config('app.name') }}-mb-40">
                    <div class="widget-about">
                        <img src="/icons/logo-black.png" height="50" alt="">
                        <p>
                            {{ $infos->footer_text ?? '' }}
                        </p>
                    </div>
                </div>

                <div class="col-lg-4 {{ config('app.name') }}-mb-40">
                    <div class="row">
                        <div class="col">
                            <ul class="widget-list">
                                <li><a href="{{ route('about') }}">à-propos</a></li>
                                <li><a href="{{ route('front-contact.index') }}">Contact</a></li>
                                <li><a href="{{ route('shop') }}">Shop</a></li>
                            </ul>
                        </div>
                        <div class="col">
                            <ul class="widget-list">
                                <li><a href="#">Returns</a></li>
                                <li><a href="#">Support Policy</a></li>
                                <li><a href="#">Size Guide</a></li>
                                <li><a href="#">FAQs</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-lg-2 {{ config('app.name') }}-mb-40">
                    <ul class="widget-list">
                        @if ($infos->tiktok)
                            <li>
                                <i class="fab fa-tiktok"></i>
                                <a href="{{ $infos->tiktok }}">tiktok</a>
                            </li>
                        @endif
                        @if ($infos->facebook)
                            <li>
                                <i class="fab fa-facebook-f"></i>
                                <a href="{{ $infos->facebook }}">Facebook</a>
                            </li>
                        @endif
                        @if ($infos->instagram)
                            <li>
                                <i class="fab fa-instagram"></i>
                                <a href="{{ $infos->instagram }}">Instagram</a>
                            </li>
                        @endif
                    </ul>
                </div>

            </div>
        </div>
    </div>

    <div class="footer2-copyright section">
        <div class="container">
            <p class="copyright text-center">
                &copy; 2024 . All Rights Reserved
                <a href="https://www.e-build.tn" target="__blank" style="color: #da1226;">
                    <b>Ebuild</b>
                </a>
            </p>
        </div>
    </div>
    <!-- Modal -->
    <div class="quickViewModal modal fade" id="quickViewModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <button class="close" data-bs-dismiss="modal">&times;</button>
                <div class="row {{ config('app.name') }}-mb-n30" id="Modal-view">
                    <div class="p-3 text-center">
                        <img src="/icons/ZKZg.gif" alt="loading" height="50" srcset="">
                    </div>
                </div>
            </div>
        </div>
    </div>

    @livewireScripts
    <!-- JS
============================================ -->

    <!-- Vendors JS -->
    <script src="/assets/js/vendor/modernizr-3.6.0.min.js"></script>
    <script src="/assets/js/vendor/jquery-3.4.1.min.js"></script>
    <script src="/assets/js/vendor/jquery-migrate-3.1.0.min.js"></script>
    <script src="/assets/js/vendor/bootstrap.bundle.min.js"></script>

    <!-- Plugins JS -->
    <script src="/assets/js/plugins/select2.min.js"></script>
    <script src="/assets/js/plugins/jquery.nice-select.min.js"></script>
    <script src="/assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="/assets/js/plugins/swiper.min.js"></script>
    <script src="/assets/js/plugins/slick.min.js"></script>
    <script src="/assets/js/plugins/mo.min.js"></script>
    <script src="/assets/js/plugins/jquery.ajaxchimp.min.js"></script>
    <script src="/assets/js/plugins/jquery.countdown.min.js"></script>
    <script src="/assets/js/plugins/imagesloaded.pkgd.min.js"></script>
    <script src="/assets/js/plugins/isotope.pkgd.min.js"></script>
    <script src="/assets/js/plugins/jquery.matchHeight-min.js"></script>
    <script src="/assets/js/plugins/ion.rangeSlider.min.js"></script>
    <script src="/assets/js/plugins/photoswipe.min.js"></script>
    <script src="/assets/js/plugins/photoswipe-ui-default.min.js"></script>
    <script src="/assets/js/plugins/jquery.zoom.min.js"></script>
    <script src="/assets/js/plugins/ResizeSensor.js"></script>
    <script src="/assets/js/plugins/jquery.sticky-sidebar.min.js"></script>
    <script src="/assets/js/plugins/product360.js"></script>
    <script src="/assets/js/plugins/jquery.magnific-popup.min.js"></script>
    <script src="/assets/js/plugins/jquery.scrollUp.min.js"></script>
    <script src="/assets/js/plugins/scrollax.min.js"></script>

    <!-- Use the minified version files listed below for better performance and remove the files listed above -->
    <!-- <script src="/assets/js/vendor/vendor.min.js"></script>
<script src="/assets/js/plugins/plugins.min.js"></script> -->

    <!-- Main Activation JS -->
    <script src="/assets/js/main.js"></script>


    @auth
        <script src="/assets/js/wishlist.js"></script>
    @endauth
    <script src="/assets/js/cart.js"></script>
    @yield('scripts')

    <script>
        $(window).on('load', function() {
            $('body').addClass('loaded');
        });
        $(document).ready(function() {
            $(document).on('mousemove', function(e) {
                $('.custom-cursor').css({
                    top: e.clientY + 'px',
                    left: e.clientX + 'px'
                });
            });
        });
    </script>

</body>

</html>
