@extends('front.fixe')
@section('titre', __('shop'))
@section('body')

    <div class="offcanvas-overlay"></div>

    <!-- Page Title/Header Start -->
    <div class="page-title-section section"
        data-bg-image="{{ isset($banner) && $banner->photo ? Storage::url($banner->photo) : '/assets/images/bg/page-title-1.webp' }}">

        <div class="container">
            <div class="row">
                <div class="col">

                    <div class="page-title">
                        <h1 class="title text-white">
                            {{ __('shop') }}
                        </h1>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item text-white">
                                <a href="{{ route('home') }}" class="text-white">
                                    {{ __('accueil') }}
                                </a>
                            </li>
                            <li class="breadcrumb-item active text-white">
                                {{ __('shop') }}
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- Page Title/Header End -->

    <!-- Shop Products Section Start -->
    <div class="container">
        <div class="row learts-mb-n50">
            <div class="col-lg-9  col-12 learts-mb-50 order-lg-2 pl-3">
                <div class="bg-light p-2">
                   <div class="row">
                    <div class="col-sm-4 ms-auto">
                        <ul class="shop-toolbar-controls ">
                            <li>
                                <div class="product-sorting">
                                    <select class="nice-select" id="nice-select" onchange="nice_select()">
                                        <option value="menu_order" selected="selected">
                                            {{ __('shop_6') }}
                                        </option>
                                        <option value="popularity">
                                            {{ __('shop_7') }}
                                        </option>
                                        <option value="date">
                                            {{ __('shop_8') }}
                                        </option>
                                        <option value="price">
                                            {{ __('shop_9') }}
                                        </option>
                                        <option value="price-desc">
                                            {{ __('shop_10') }}
                                        </option>
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
                    <!-- Products Start -->
                    <div id="shop-products" class=" row row-cols-xl-4 row-cols-md-3 row-cols-sm-2 row-cols-1">
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-12 bg-light pt-3 learts-mb-10 order-lg-1">

                <div class="isotope-filter  shop-product-filter" data-target="#shop-products">
                    <button class="active" type="button" onclick="show_normal()">
                        {{ __('shop_1') }}
                    </button>
                    <button type="button" onclick="show_promotion()">
                        {{ __('shop_2') }}
                    </button>
                </div>  
                <br>

                <!-- Search Start -->
                <div class="single-widget learts-mb-40">
                    <div class="widget-search">
                        <form action="{{ route('shop') }}" method="get">
                            <input type="text" placeholder="{{ __('shop_3') }}" value="{{ $key }}"
                                id="key-shop">
                            <button><i class="fas fa-search"></i></button>
                        </form>
                    </div>
                </div>
                <!-- Search End -->

                <!-- Categories Start -->
                <div class="learts-mb-40">
                    <h3 class="widget-title product-filter-widget-title">
                        {{ __('shop_4') }}
                    </h3>
                    <ul class="widget-list">
                        @foreach ($categories as $categorie)
                            <li class="cusor">
                                <span onclick="select_categorie({{ $categorie->id }})">
                                    {{ \App\Helpers\TranslationHelper::TranslateText($categorie->nom) }}
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
                        {{ __('prix') }}
                    </h3>
                    <div class="widget-price-range">
                        <input class="range-slider" type="text" data-min="{{ $min_price }}"
                            data-max="{{ $max_price + 350 }}" data-from="0" data-to="350" />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Shop Products Section End -->
    <input type="hidden" name="IDcategorie" id="IDcategorie" value="{{ $IDcategorie }}">


    <style>
        body {
            background: url('/icons/motif.webp')no-repeat;
            background-size: cover;
        }

        .bg-light {
            background-color: white !important;
        }
    </style>
<br><br><br>
@endsection

@section('scripts')
    <script src="/assets/js/shop.js"></script>

@endsection
