@extends('front.fixe')
@section('titre', 'Shop')
@section('body')

    <div class="offcanvas-overlay"></div>

    <!-- Page Title/Header Start -->
    <div class="page-title-section section" data-bg-image="{{ isset($banner) && $banner->photo ? Storage::url($banner->photo) : '/assets/images/bg/page-title-1.webp' }}">

        <div class="container">
            <div class="row">
                <div class="col">

                    <div class="page-title">
                        <h1 class="title">Shop</h1>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('home') }}">Accueil</a>
                            </li>
                            <li class="breadcrumb-item active">
                                Shop
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- Page Title/Header End -->

    <!-- Shop Products Section Start -->
    <div class="section section-padding pt-0">

        <!-- Shop Toolbar Start -->
        <div class="shop-toolbar border-bottom">
            <div class="container">
                <div class="row learts-mb-n20">

                    <!-- Isotop Filter Start -->
                    <div class="col-md col-12 align-self-center learts-mb-20">
                        <div class="isotope-filter shop-product-filter" data-target="#shop-products">
                            <button class="active" data-filter="*">all</button>
                            <button data-filter=".featured">Hot Products</button>
                            <button data-filter=".new">New Products</button>
                            <button data-filter=".sales">Sales Products</button>
                        </div>
                    </div>
                    <!-- Isotop Filter End -->

                    <div class="col-md-auto col-12 learts-mb-20">
                        <ul class="shop-toolbar-controls">

                            <li>
                                <div class="product-sorting">
                                    <select class="nice-select" id="nice-select" onchange="nice_select()">
                                        <option value="menu_order" selected="selected">Tri par défaut</option>
                                        <option value="popularity">Trier par popularité</option>
                                        <option value="date">Trier par nouveauté</option>
                                        <option value="price">Trier par prix : du moins cher au plus cher</option>
                                        <option value="price-desc">Trier par prix : du plus cher au moins cher</option>
                                    </select>

                                </div>
                            </li>
                            <li>
                                <div class="product-column-toggle d-none d-xl-flex">
                                    <button class="toggle hintT-top" data-hint="5 Column" data-column="5"><i
                                            class="ti-layout-grid4-alt"></i></button>
                                    <button class="toggle active hintT-top" data-hint="4 Column" data-column="4"><i
                                            class="ti-layout-grid3-alt"></i></button>
                                    <button class="toggle hintT-top" data-hint="3 Column" data-column="3"><i
                                            class="ti-layout-grid2-alt"></i></button>
                                </div>
                            </li>

                        </ul>
                    </div>

                </div>
            </div>
        </div>
        <!-- Shop Toolbar End -->

        <!-- Product Filter Start -->
        <div id="product-filter" class="product-filter bg-light">
            <div class="container">
                <div class="row row-cols-lg-5 row-cols-md-3 row-cols-sm-2 row-cols-1 learts-mb-n30">


                </div>
            </div>
        </div>
        <!-- Product Filter End -->

        <div class="section learts-mt-70">
            <div class="container">
                <div class="row learts-mb-n50">

                    <div class="col-lg-9 col-12 learts-mb-50 order-lg-2">
                        <!-- Products Start -->
                        <div id="shop-products"
                            class=" row row-cols-xl-4 row-cols-md-3 row-cols-sm-2 row-cols-1">


                        </div>
                    </div>

                    <div class="col-lg-3 col-12 learts-mb-10 order-lg-1">

                        <!-- Search Start -->
                        <div class="single-widget learts-mb-40">
                            <div class="widget-search">
                                <form action="{{ route('shop') }}" method="get">
                                    <input type="text" placeholder="Rechercher des produits...."
                                        value="{{ $key }}" id="key-shop">
                                    <button><i class="fas fa-search"></i></button>
                                </form>
                            </div>
                        </div>
                        <!-- Search End -->

                        <!-- Categories Start -->
                        <div class="single-widget learts-mb-40">
                            <h3 class="widget-title product-filter-widget-title">
                                Catégories de produits
                            </h3>
                            <ul class="widget-list">
                                @foreach ($categories as $categorie)
                                    <li class="cusor">
                                        <span onclick="select_categorie({{ $categorie->id }})">
                                            {{ $categorie->nom }}
                                        </span>
                                        <span class="count">
                                            {{ $categorie->produits->count() }}
                                        </span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <!-- Categories End -->

                        <!-- Price Range Start -->
                        <div class="single-widget learts-mb-40">
                            <h3 class="widget-title product-filter-widget-title">
                                Filtres par prix
                            </h3>
                            <div class="widget-price-range">
                                <input class="range-slider" type="text" data-min="{{ $min_price }}" data-max="{{ $max_price+350 }}" data-from="0"
                                    data-to="350" />
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>

    </div>
    <!-- Shop Products Section End -->
    <input type="hidden" name="IDcategorie" id="IDcategorie" value="{{ $IDcategorie }}">

@endsection
@section('scripts')
    <script src="/assets/js/shop.js"></script>
@endsection
