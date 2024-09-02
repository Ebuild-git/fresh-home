@extends('front.fixe')
@section('titre', 'à-propos')
@section('body')


    <div class="offcanvas-overlay"></div>

    <!-- Page Title/Header Start -->
    <div class="page-title-section section" data-bg-image="{{ Storage::url($infos->about_cover) }}">
        <div class="container">
            <div class="row">
                <div class="col">

                    <div class="page-title">
                        <h1 class="title">à-propos</h1>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('home') }}">Accueil</a>
                            </li>
                            <li class="breadcrumb-item active">à-propos</li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- Page Title/Header End -->

    <!-- About Section Start -->
    <div class="section section-padding pb-0">
        <div class="container">
            <div class="row learts-mb-n30">

                <div class="col-md-6 col-12 align-self-center learts-mb-30">
                    <div class="about-us3">
                        <span class="sub-title">
                            {{ config('app.name') }}
                        </span>
                        <h2 class="title">
                            {{ $infos->about_titre ?? '' }}
                        </h2>
                        <div class="desc">
                            <p>
                                {{ $infos->about_description ?? '' }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-12 text-center learts-mb-30">
                    <img src="{{ Storage::url($infos->about_image) }}" alt="">
                </div>

            </div>
        </div>

    </div>
    <!-- About Section End -->

    <!-- Feature Section Start -->
    <div class="section section-padding">
        <div class="container">
            <div class="row row-cols-md-3 row-cols-1 learts-mb-n30">

                <div class="col learts-mb-30">
                    <div class="icon-box4">
                        <div class="inner">
                            <div class="content">
                                <h6 class="title">
                                    LIVRAISON GRATUITE
                                </h6>
                                <p>
                                    Une fois votre commande reçue, nous retournerons vos produits dans un délai de 3 à 5
                                    jours ouvrables.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col border-left border-right learts-mb-30">
                    <div class="icon-box4">
                        <div class="inner">
                            <div class="content">
                                <h6 class="title">
                                    RETOURS GRATUITS
                                </h6>
                                <p>
                                    Nous acceptons les retours de produits fraîchement achetés dans les 7 jours suivant le
                                    paiement.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col learts-mb-30">
                    <div class="icon-box4">
                        <div class="inner">
                            <div class="content">
                                <h6 class="title">
                                    PAIEMENT SÉCURISÉ
                                </h6>
                                <img class="img-hover-color " src="{{ Storage::url($infos->about_image) }}" alt="">
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- Feature Section End -->

    <!-- Video Banner Section Start -->
    <div class="section">
        <div class="container">
            <div class="video-banner2" data-bg-image="{{ Storage::url($infos->about_cover_video) }}">
                <div class="content">
                    @if ($infos->about_video)
                        <a href="{{ Storage::url($infos->about_video) }}" class="video-popup">
                            <img src="{{ Storage::url($infos->about_cover_video) }}" alt="">
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- Video Banner Section End -->

    <!-- Feature Section Start -->
    <div class="section section-padding">
        <div class="container">

            <div class="row learts-mb-n30">

                <div class="col-xl-3 col-lg-4 col-12 me-auto learts-mb-30">
                    <h1 class="fw-400">The difference when you shop Learts!</h1>
                </div>
                <div class="col-lg-8 col-12 learts-mb-30">
                    <div class="row learts-mb-n30">

                        <div class="col-md-6 col-12 learts-mb-30">
                            <p class="text-heading fw-600 learts-mb-10">Free Shipping</p>
                            <p>Once receiving your order, we will turn your products around in 3-5 business days.</p>
                        </div>

                        <div class="col-md-6 col-12 learts-mb-30">
                            <p class="text-heading fw-600 learts-mb-10">Free Returns</p>
                            <p>We accept returns for freshly purchased products within 7 days from the payment.</p>
                        </div>

                        <div class="col-md-6 col-12 learts-mb-30">
                            <p class="text-heading fw-600 learts-mb-10">Superb Quality</p>
                            <p>We make commitments that the quality of our products will and always will be superb.</p>
                        </div>

                        <div class="col-md-6 col-12 learts-mb-30">
                            <p class="text-heading fw-600 learts-mb-10">Free Wrapping</p>
                            <p>Upon request, items bought as gifts from our store can receive free wrapping service.</p>
                        </div>

                    </div>
                </div>

            </div>

        </div>
    </div>
    <!-- Feature Section End -->

    <!-- Instagram Section Start -->
    <div class="section section-padding border-top">
        <div class="container">

            <!-- Section Title Start -->
            <div class="section-title2 text-center">
                <h3 class="sub-title">Follow us on Instagram</h3>
                <h2 class="title">@learts_shop</h2>
            </div>
            <!-- Section Title End -->

            <div class="instafeed instafeed-carousel instafeed-carousel1">
                <a class="instafeed-item" href="#">
                    <img src="/assets/images/instagram/instagram-1.webp" alt="instagram image" />
                    <i class="fab fa-instagram"></i>
                </a>
                <a class="instafeed-item" href="#">
                    <img src="/assets/images/instagram/instagram-2.webp" alt="instagram image" />
                    <i class="fab fa-instagram"></i>
                </a>
                <a class="instafeed-item" href="#">
                    <img src="/assets/images/instagram/instagram-3.webp" alt="instagram image" />
                    <i class="fab fa-instagram"></i>
                </a>
                <a class="instafeed-item" href="#">
                    <img src="/assets/images/instagram/instagram-4.webp" alt="instagram image" />
                    <i class="fab fa-instagram"></i>
                </a>
                <a class="instafeed-item" href="#">
                    <img src="/assets/images/instagram/instagram-2.webp" alt="instagram image" />
                    <i class="fab fa-instagram"></i>
                </a>
                <a class="instafeed-item" href="#">
                    <img src="/assets/images/instagram/instagram-3.webp" alt="instagram image" />
                    <i class="fab fa-instagram"></i>
                </a>
            </div>

        </div>
    </div>
    <!-- Instagram Section End -->

@endsection
