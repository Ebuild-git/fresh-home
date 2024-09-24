@extends('front.fixe')
@section('titre', $produit->nom)

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
                                <a href="{{ route('home') }}">
                                    {{ __('accueil') }}
                                </a>
                            </li>
                            <li class="breadcrumb-item text-white">
                                <a href="{{ route('shop') }}">
                                    {{ __('produit') }}
                                </a>
                            </li>
                            <li class="breadcrumb-item text-white active">
                                {{ $produit->nom }}
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- Page Title/Header End -->

    <!-- Single Products Section Start -->
    <div class="section section-fluid section-padding border-bottom">
        <div class="container">
            <div class="row learts-mb-n40">

                <!-- Product Images Start -->
                <div class="col-lg-6 col-12 learts-mb-40">
                    <div class="product-images vertical">
                        <button class="product-gallery-popup hintT-left" data-hint="Click to enlarge"
                            data-images='[
                                    {"src": "{{ Storage::url($produit->photo) }}", "w": 810, "h": 1080},
                                     @foreach (json_decode($produit->photos) ?? [] as $item)
                                    {"src": "{{ Storage::url($item) }}"", "w": 810, "h": 1080}, @endforeach
                                ]'><i
                                class="fas fa-expand"></i></button>

                        <div class="product-gallery-slider">
                            <div class="product-zoom" data-image="{{ Storage::url($produit->photo) }}">
                                <img src="{{ Storage::url($produit->photo) }}" alt="">
                            </div>
                            @foreach (json_decode($produit->photos) ?? [] as $item)
                                <div class="product-zoom" data-image="{{ Storage::url($item) }}">
                            @endforeach
                        </div>
                        <div class="product-thumb-slider-vertical">
                            <div class="item">
                                <img src="{{ Storage::url($produit->photo) }}" alt="">
                            </div>
                            @foreach (json_decode($produit->photos) ?? [] as $item)
                                <div class="item">
                                    <img src="{{ Storage::url($item) }}" alt="">
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <!-- Product Images End -->

                <!-- Product Summery Start -->
                <div class="col-lg-6 col-12 learts-mb-40">
                    <div class="product-summery product-summery-center">
                        <h3 class="product-title">
                            {{ $produit->nom }}
                        </h3>
                        <div class="product-price">
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
                        </div>
                        <div class="product-description">
                            <p>
                                {{ \App\Helpers\TranslationHelper::TranslateText($produit->description) }}
                            </p>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div>
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td class="label">
                                                    <b>
                                                        <span>{{ __('quantite') }}</span>
                                                        &nbsp; &nbsp; &nbsp; &nbsp;
                                                    </b>
                                                </td>
                                                <td class="value">
                                                    <div class="product-quantity">
                                                        <span class="qty-btn minus">
                                                            <i class="ti-minus"></i>
                                                        </span>
                                                        <input type="text" class="input-qty" id="input-qty"
                                                            value="1">
                                                        <span class="qty-btn plus">
                                                            <i class="ti-plus"></i>
                                                        </span>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="product-buttons">
                                    @auth
                                        <a href="javascript:void();"
                                            class="btn btn-icon btn-outline-body btn-hover-dark hintT-top add-to-wish"
                                            data-id="{{ $produit->id }}" data-hint="Ajouter aux favoris">
                                            <i class="far fa-heart"></i>
                                        </a>
                                    @endauth
                                    <a href="javascript:void();" class="btn btn-dark btn-outline-hover-dark add-to-cart"
                                        data-id="{{ $produit->id }}">
                                        <i class="fas fa-shopping-cart"></i>
                                        {{ __('add_cart') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div style="text-align: left !important;">
                            <table>
                                <tbody>
                                    <tr>
                                        <td class="label">
                                            <b>
                                                <span>{{ __('reference') }} </span> :
                                            </b>
                                        </td>
                                        <td class="value">{{ $produit->reference }}</td>
                                    </tr>
                                    <tr>
                                        <td class="label">
                                            <b>
                                                <span>{{ __('categorie') }}</span> :
                                            </b>
                                        </td>
                                        <td class="value">
                                            <ul class="product-category">
                                                <li>
                                                    <a href="#">
                                                        {{ \App\Helpers\TranslationHelper::TranslateText($produit->categorie->nom) }}
                                                    </a>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- Product Summery End -->

            </div>
        </div>

    </div>
    <!-- Single Products Section End -->

    <!-- Single Products Infomation Section Start -->
    <div class="section section-padding border-bottom">
        <div class="container">

            <ul class="nav product-info-tab-list">
                <li><a class="active" data-bs-toggle="tab" href="#tab-description">Description</a></li>
            </ul>
            <div class="tab-content product-infor-tab-content">
                <div class="tab-pane fade show active" id="tab-description">
                    <div class="row">
                        <div class="col-lg-10 col-12 mx-auto">
                            <p>
                                {{ \App\Helpers\TranslationHelper::TranslateText( $produit->description) }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- Single Products Infomation Section End -->

    <!-- Recommended Products Section Start -->
    <div class="section section-padding">
        <div class="container">

            <!-- Section Title Start -->
            <div class="section-title2 text-center">
                <h2 class="title">
                    {{ __('aussi_aimer') }}
                </h2>
            </div>
            <!-- Section Title End -->

            <!-- Products Start -->
            <div class="product-carousel">
                @foreach ($autres as $produit)
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
                                        {{ \App\Helpers\TranslationHelper::TranslateText(Str::limit($produit->nom, 30)) }}
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
                                    <a href="#quickViewModal" data-bs-toggle="modal"
                                        class="product-button hintT-top modal-view-open" data-id="{{ $produit->id }}"
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
            <!-- Products End -->

        </div>
    </div>
    <!-- Recommended Products Section End -->

@endsection


@section('SEO')
    @php
        $productDescription = $produit->description
            ? strip_tags($produit->description)
            : config('app.name') . ' - ' . $produit->nom;
    @endphp

    <meta name="description" content="{{ Str::limit($productDescription, 160) }}">
    <meta name="keywords"
        content="{{ $produit->nom }}, {{ $produit->reference ?? $produit->nom }}, {{ config('app.name') }}, acheter, prix {{ $produit->getPrice() }}">
    <meta property="og:title" content="{{ $produit->nom }} | {{ config('app.name') }}">
    <meta property="og:description" content="{{ Str::limit($productDescription, 160) }}">
    <meta property="og:image" content="{{ Storage::url($produit->photo) }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="product">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $produit->nom }} | {{ config('app.name') }}">
    <meta name="twitter:description" content="{{ Str::limit($productDescription, 160) }}">
    <meta name="twitter:image" content="{{ Storage::url($produit->photo) }}">

    <!-- Balises de Schema.org pour l'enrichissement SEO -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org/",
        "@type": "Product",
        "name": "{{ $produit->nom }}",
        "image": "{{ Storage::url($produit->photo) }}",
        "description": "{{ $productDescription }}",
        "sku": "{{ $produit->reference ?? '' }}",
        "offers": {
            "@type": "Offer",
            "priceCurrency": "DNT",
            "price": "{{ $produit->getPrice() }}",
            "availability": "{{ $produit->statut == 'disponible' ? 'https://schema.org/InStock' : 'https://schema.org/OutOfStock' }}",
            "url": "{{ url()->current() }}"
        }
    }
    </script>

    <style>
        .product-gallery-slider {
            border: solid 1px black;
        }
    </style>
@endsection
