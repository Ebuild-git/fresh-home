@extends('front.fixe')
@section('titre', 'Accueil')
@section('body')


    <div class="offcanvas-overlay"></div>

    <!-- Slider main container Start -->
    <div class="section">
        <div>
            <div class="home4-slider swiper-container">
                <div class="swiper-wrapper">
                    @foreach ($banners as $banner)
                        <div class="home4-slide-item swiper-slide" data-swiper-autoplay="5000">
                            <div class="home4-slide-image">
                                <img src="{{ $banner['photo'] }}" alt="{{ $banner['titre_complet'] }}">
                            </div>
                            <div class="home4-slide-content">
                                @if ($banner['show_text'])
                                    <div class=" p-3" style="background-color: #00000056;">
                                        <span class="category text-white">
                                            {{ config('app.name') }}
                                        </span>
                                        <h2 class="title text-white">
                                            {!! $banner['titre'] !!}
                                        </h2>
                                    </div>
                                @endif
                                <div class="link">
                                    <a href="{{ route('shop') }}" class="btn btn-black btn-outline-hover-black">
                                        {{ __('shop_11') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="home4-slider-prev swiper-button-prev"><i class="ti-angle-left"></i></div>
                <div class="home4-slider-next swiper-button-next"><i class="ti-angle-right"></i></div>
                <div class="home4-slider-pagination swiper-pagination"></div>
            </div>
        </div>
    </div>
    <!-- Slider main container End -->

    <!-- About us Section Start -->
    <div class="section section-padding">
        <div class="container">
            <div class="row">
                <div class="col-12 mx-auto">
                    <div class="about-us2">
                        <div class="inner">
                            <h5 class="title">
                                {{ __('home_1') }}
                            </h5>
                            <h5 class="sub-title">
                                {{ __('home_2') }}
                            </h5>
                            <div class="desc">
                                <p>
                                    {{ __('home_3') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About us Section End -->

    <!-- Category Banner Section Start -->
    <div class="section section-padding pt-0">
        <div class="container">
            <div class="cat-scroll-wrapper">
                <button class="cat-scroll-button left">&lt;</button>
                <div class="cat-scroll-container learts-mb-n40">
                    @foreach ($categories as $categorie)
                        <div class="cat-item learts-mb-40">
                            <div class="cat-banner">
                                <a href="{{ route('shop') }}?IDcategorie={{ $categorie->id }}" class="cat-inner">
                                    <div class="cat-image">
                                        <img src="{{ Storage::url($categorie->photo) }}" alt="{{ $categorie->nom }}">
                                    </div>
                                    <div class="content p-2 text-center" data-bg-color="#f4ede7">
                                        <h6 class="title">
                                            {{ \App\Helpers\TranslationHelper::TranslateText($categorie->nom) }}
                                        </h6>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
                <button class="cat-scroll-button right">&gt;</button>
            </div>
        </div>
    </div>
    <!-- Category Banner Section End -->




    <div class="container">
        <div class="as-container">
            <div class="as-carousel">
                @foreach ($categories as $categorie)
                    <div class="as-item">
                        <label for="">
                            {{ \App\Helpers\TranslationHelper::TranslateText($categorie->nom) }}
                        </label>
                    </div>
                @endforeach
            </div>
        </div>
    </div>



    <!-- Product Section Start -->
    <div class="section section-padding">
        <div class="container">

            <!-- Product Tab Start -->
            <div class="row">
                <div class="col-12">
                    <div class="products row row-cols-lg-4 row-cols-md-3 row-cols-sm-2 row-cols-1">
                        @foreach ($news as $produit)
                            <div class="col">
                                <div class="product">
                                    <div class="product-thumb">
                                        <a href="{{ route('produit', ['id' => $produit->id, 'slug' => Str::slug($produit->nom)]) }}"
                                            class="image">
                                            @if ($produit->id_promotion)
                                                <span class="product-badges">
                                                    <span class="onsale">
                                                        {{ $produit->inPromotion->pourcentage }} %
                                                    </span>
                                                </span>
                                            @endif
                                            <img src="{{ Storage::url($produit->photo) }}" alt="{{ $produit->nom }}"
                                                alt="{{ $produit->nom }}">
                                            <img class="image-hover " src="{{ Storage::url($produit->photo) }}"
                                                alt="{{ $produit->nom }}" alt="Product Image">
                                        </a>
                                        @auth
                                            <a href="javascript:void();" class="add-to-wishlist hintT-left add-to-wish"
                                                data-id="{{ $produit->id }}" data-hint="Ajouter aux favoris">
                                                <i class="far fa-heart"></i>
                                            </a>
                                        @endauth
                                    </div>
                                    <div class="product-info">
                                        <h6 class="title">
                                            <a
                                                href="{{ route('produit', ['id' => $produit->id, 'slug' => Str::slug($produit->nom)]) }}">
                                                {{ Str::limit($produit->nom, 30) }}
                                            </a>
                                        </h6>
                                        <span class="price">
                                            @if ($produit->id_promotion)
                                                <span class="old">
                                                    {{ $produit->prix }}
                                                    <x-devise></x-devise>
                                                </span>
                                            @endif

                                            <span class="new">
                                                {{ $produit->getPrice() }}
                                                <x-devise></x-devise>
                                            </span>
                                        </span>
                                        <div class="product-buttons">
                                            <a href="#quickViewModal" data-bs-toggle="modal" data-id="{{ $produit->id }}"
                                                class="product-button hintT-top modal-view-open"
                                                data-hint="{{ __('regard_rapide') }}">
                                                <i class="fas fa-search"></i>
                                            </a>
                                            <a href="javascript:void();" class="product-button hintT-top add-to-cart"
                                                data-id="{{ $produit->id }}" data-hint="{{ __('add_cart') }}">
                                                <i class="fas fa-shopping-cart"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <!-- Product Tab End -->
            <div class="row g-0 justify-content-center learts-mt-50">
                <a href="{{ route('shop') }}" class="btn p-0">
                    <i class="ti-plus"></i> {{ __('voir_plus') }}
                </a>
            </div>

        </div>
    </div>
    <!-- Product Section End -->

    <!-- Separator -->
    <div class="section">
        <div class="container">
            <hr class="m-0">
        </div>
    </div>
    <!-- Separator -->

    <!-- Team Section Start -->
    <div class="section section-padding">
        <div class="container">

            <div class="section-title2 row justify-content-between align-items-center">
                <div class="col-md-auto col-12">
                    <!-- Section Title Start -->
                    <h2 class="title title-icon-right">
                        {{ __('home_4') }}
                    </h2>
                    <!-- Section Title End -->
                </div>
                <div class="col-md-auto col-12 mt-4 mt-md-0">
                    <a href="{{ route('shop') }}" class="btn btn-light btn-hover-black">
                        <i class="ti-plus"></i>
                        {{ __('voir_plus') }}
                    </a>
                </div>
            </div>

            <div class="row row-cols-lg-2 row-cols-1 learts-mb-n40">
                <div class="col learts-mb-40 pr-xl-5">
                    <div class="team">
                        <div class="image">
                            <img src="/icons/IMG_3977-jpg_2.webp" alt="">
                        </div>
                    </div>
                </div>

                <div class="col learts-mb-40">

                    <div class="row justify-content-between h-100">
                        <div class="col-12 learts-mb-50 mt-xl-5">
                            <blockquote class="learts-blockquote2">
                                <div class="icon"><img src="/assets/images/icons/quote.webp" alt=""></div>
                                <div class="content">
                                    <p>
                                        {{ __('home_5') }}
                                    </p>
                                </div>
                            </blockquote>
                        </div>
                        <div class="col-12 mt-auto">
                            <div class="row row-cols-sm-2 row-cols-1 learts-mb-n40">
                                <div class="col learts-mb-40">
                                    <div class="team">
                                        <div class="image">
                                            <img src="/icons/IMG_3947.webp" alt="">
                                        </div>
                                    </div>
                                </div>

                                <div class="col learts-mb-40">
                                    <div class="team">
                                        <div class="image">
                                            <img src="/icons/IMG_3962-jpg.webp" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </div>
    <!-- Team Section End -->

    <!-- Separator -->
    <div class="section">
        <div class="container">
            <hr class="m-0">
        </div>
    </div>
    <!-- Separator -->


    <script>
        $(document).ready(function() {
            $('.cat-scroll-button.left').click(function() {
                $('.cat-scroll-container').scrollLeft($('.cat-scroll-container').scrollLeft() - 300);
            });

            $('.cat-scroll-button.right').click(function() {
                $('.cat-scroll-container').scrollLeft($('.cat-scroll-container').scrollLeft() + 300);
            });
        });
        $(document).ready(function() {
            var $carousel = $('.as-carousel');
            var items = $carousel.children('.as-item');
            $carousel.append(items.clone());
            $carousel.hover(function() {
                $(this).css("animation-play-state", "paused");
            }, function() {
                $(this).css("animation-play-state", "running");
            });
        });
    </script>

@endsection
