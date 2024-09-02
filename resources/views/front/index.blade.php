@extends('front.fixe')
@section('titre', 'Accueil')
@section('body')


    <div class="offcanvas-overlay"></div>

    <!-- Slider main container Start -->
    <div class="section">
        <div class="container">
            <div class="home4-slider swiper-container">
                <div class="swiper-wrapper">
                    @foreach ($banners as $banner)
                        @php
                            function addBreaksAfterWords($text, $wordsPerLine = 4)
                            {
                                $words = explode(' ', $text);
                                $lines = [];
                                foreach (array_chunk($words, $wordsPerLine) as $chunk) {
                                    $lines[] = implode(' ', $chunk);
                                }
                                return implode('<br>', $lines);
                            }
                        @endphp
                        <div class="home4-slide-item swiper-slide" data-swiper-autoplay="5000">
                            <div class="home4-slide-image">
                                <img src="{{ Storage::url($banner->photo) }}" alt="{{ $banner->titre }}">
                            </div>
                            <div class="home4-slide-content">
                                <span class="category">
                                    {{ config('app.name') }}
                                </span>
                                <h2 class="title">*
                                    {!! addBreaksAfterWords($banner->titre) !!}
                                </h2>
                                <div class="link">
                                    <a href="{{ route('shop') }}" class="btn btn-black btn-outline-hover-black">
                                        Acheter maintenant !
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
                <div class="col-xl-7 col-lg-8 col-12 mx-auto">
                    <div class="about-us2">
                        <div class="inner">
                            <h2 class="title">Live out your life</h2>
                            <h5 class="sub-title">WELCOME TO LEARTS STORE</h5>
                            <div class="desc">
                                <p>Learts is an online shop of two passionate craftsmen where they sell handicrafts and
                                    arts’ works in the US. We provide high-end unique vases, wall arts, home accessories,
                                    and furniture pieces.</p>
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
            <div class="row row-cols-lg-4 row-cols-sm-2 row-cols-1 learts-mb-n40">

                @foreach ($categories as $categorie)
                    <div class="col learts-mb-40">
                        <div class="category-banner4">
                            <a href="{{ route('shop') }}?IDcategorie={{ $categorie->id }}" class="inner">
                                <div class="image">
                                    <img src="{{ Storage::url($categorie->photo) }}" alt="{{ $categorie->nom }}">
                                </div>
                                <div class="content" data-bg-color="#f4ede7">
                                    <h3 class="title">
                                        {{ $categorie->nom }}
                                    </h3>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
    <!-- Category Banner Section End -->

    <!-- Separator -->
    <div class="section">
        <div class="container">
            <hr class="m-0">
        </div>
    </div>
    <!-- Separator -->

    <!-- Product Section Start -->
    <div class="section section-padding">
        <div class="container">

            <!-- Product Tab Start -->
            <div class="row">
                <div class="col-12">
                    <ul class="product-tab-list nav">
                        <li><a class="active" data-bs-toggle="tab" href="#tab-new-sale">Nouveautés</a></li>
                        <li><a data-bs-toggle="tab" href="#tab-sale-items">Articles en solde</a></li>
                        <li><a data-bs-toggle="tab" href="#tab-best-sellers">Meilleures ventes</a></li>
                    </ul>
                    <div class="prodyct-tab-content1 tab-content">
                        <div class="tab-pane fade show active" id="tab-new-sale">
                            <!-- Products Start -->
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
                                                    <img src="{{ Storage::url($produit->photo) }}"
                                                        alt="{{ $produit->nom }}" alt="{{ $produit->nom }}">
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
                                                    <a href="#quickViewModal" data-bs-toggle="modal"
                                                        data-id="{{ $produit->id }}"
                                                        class="product-button hintT-top modal-view-open"
                                                        data-hint="Regard rapide">
                                                        <i class="fas fa-search"></i>
                                                    </a>
                                                    <a href="javascript:void();"
                                                        class="product-button hintT-top add-to-cart"
                                                        data-id="{{ $produit->id }}" data-hint="Add to Cart">
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
                        <div class="tab-pane fade" id="tab-sale-items">
                            <!-- Products Start -->
                            <div class="products row row-cols-lg-4 row-cols-md-3 row-cols-sm-2 row-cols-1">

                                @foreach ($randoms as $produit)
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
                                                    <img src="{{ Storage::url($produit->photo) }}"
                                                        alt="{{ $produit->nom }}" alt="{{ $produit->nom }}">
                                                    <img class="image-hover " src="{{ Storage::url($produit->photo) }}"
                                                        alt="{{ $produit->nom }}" alt="Product Image">
                                                </a>
                                                @auth
                                                    <a href="javascript:void();"
                                                        class="add-to-wishlist hintT-left add-to-wish"
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
                                                    <a href="#quickViewModal" data-bs-toggle="modal"
                                                        data-id="{{ $produit->id }}"
                                                        class="product-button hintT-top modal-view-open"
                                                        data-hint="Regard rapide">
                                                        <i class="fas fa-search"></i>
                                                    </a>
                                                    <a href="javascript:void();"
                                                        class="product-button hintT-top add-to-cart"
                                                        data-id="{{ $produit->id }}" data-hint="Ajouter au panier">
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
                        <div class="tab-pane fade" id="tab-best-sellers">
                            <!-- Products Start -->
                            <div class="products row row-cols-lg-4 row-cols-md-3 row-cols-sm-2 row-cols-1">

                                <div class="col">
                                    <div class="product">
                                        <div class="product-thumb">
                                            <a href="product-details.html" class="image">
                                                <img src="/assets/images/product/s270/product-6.webp" alt="Product Image">
                                                <img class="image-hover "
                                                    src="/assets/images/product/s270/product-6-hover.webp"
                                                    alt="Product Image">
                                            </a>
                                            <a href="wishlist.html" class="add-to-wishlist hintT-left"
                                                data-hint="Add to wishlist"><i class="far fa-heart"></i></a>
                                        </div>
                                        <div class="product-info">
                                            <h6 class="title"><a href="product-details.html">Clear Silicate Teapot</a>
                                            </h6>
                                            <span class="price">
                                                $140.00
                                            </span>
                                            <div class="product-buttons">
                                                <a href="#quickViewModal" data-bs-toggle="modal"
                                                    class="product-button hintT-top" data-hint="Regard rapide"><i
                                                        class="fas fa-search"></i></a>
                                                <a href="#" class="product-button hintT-top"
                                                    data-hint="Add to Cart"><i class="fas fa-shopping-cart"></i></a>
                                                <a href="#" class="product-button hintT-top" data-hint="Compare"><i
                                                        class="fas fa-random"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="product">
                                        <div class="product-thumb">
                                            <a href="product-details.html" class="image">
                                                <span class="product-badges">
                                                    <span class="hot">hot</span>
                                                </span>
                                                <img src="/assets/images/product/s270/product-7.webp" alt="Product Image">
                                                <img class="image-hover "
                                                    src="/assets/images/product/s270/product-7-hover.webp"
                                                    alt="Product Image">
                                            </a>
                                            <a href="wishlist.html" class="add-to-wishlist hintT-left"
                                                data-hint="Add to wishlist"><i class="far fa-heart"></i></a>
                                        </div>
                                        <div class="product-info">
                                            <h6 class="title"><a href="product-details.html">Lucky Wooden Elephant</a>
                                            </h6>
                                            <span class="price">
                                                $35.00
                                            </span>
                                            <div class="product-buttons">
                                                <a href="#quickViewModal" data-bs-toggle="modal"
                                                    class="product-button hintT-top" data-hint="Regard rapide"><i
                                                        class="fas fa-search"></i></a>
                                                <a href="#" class="product-button hintT-top"
                                                    data-hint="Add to Cart"><i class="fas fa-shopping-cart"></i></a>
                                                <a href="#" class="product-button hintT-top" data-hint="Compare"><i
                                                        class="fas fa-random"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="product">
                                        <div class="product-thumb">
                                            <a href="product-details.html" class="image">
                                                <span class="product-badges">
                                                    <span class="outofstock"><i class="far fa-frown"></i></span>
                                                    <span class="hot">hot</span>
                                                </span>
                                                <img src="/assets/images/product/s270/product-8.webp" alt="Product Image">
                                                <img class="image-hover "
                                                    src="/assets/images/product/s270/product-8-hover.webp"
                                                    alt="Product Image">
                                            </a>
                                            <a href="wishlist.html" class="add-to-wishlist hintT-left"
                                                data-hint="Add to wishlist"><i class="far fa-heart"></i></a>
                                            <div class="product-options">
                                                <ul class="colors">
                                                    <li style="background-color: #000000;">color one</li>
                                                    <li style="background-color: #b2483c;">color two</li>
                                                </ul>
                                                <ul class="sizes">
                                                    <li>Large</li>
                                                    <li>Medium</li>
                                                    <li>Small</li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="product-info">
                                            <h6 class="title"><a href="product-details.html">Decorative Christmas Fox</a>
                                            </h6>
                                            <span class="price">
                                                $50.00
                                            </span>
                                            <div class="product-buttons">
                                                <a href="#quickViewModal" data-bs-toggle="modal"
                                                    class="product-button hintT-top" data-hint="Regard rapide"><i
                                                        class="fas fa-search"></i></a>
                                                <a href="#" class="product-button hintT-top"
                                                    data-hint="Add to Cart"><i class="fas fa-shopping-cart"></i></a>
                                                <a href="#" class="product-button hintT-top" data-hint="Compare"><i
                                                        class="fas fa-random"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="product">
                                        <div class="product-thumb">
                                            <a href="product-details.html" class="image">
                                                <img src="/assets/images/product/s270/product-9.webp" alt="Product Image">
                                                <img class="image-hover "
                                                    src="/assets/images/product/s270/product-9-hover.webp"
                                                    alt="Product Image">
                                            </a>
                                            <a href="wishlist.html" class="add-to-wishlist hintT-left"
                                                data-hint="Add to wishlist"><i class="far fa-heart"></i></a>
                                        </div>
                                        <div class="product-info">
                                            <h6 class="title"><a href="product-details.html">Aluminum Equestrian</a></h6>
                                            <span class="price">
                                                $100.00
                                            </span>
                                            <div class="product-buttons">
                                                <a href="#quickViewModal" data-bs-toggle="modal"
                                                    class="product-button hintT-top" data-hint="Regard rapide"><i
                                                        class="fas fa-search"></i></a>
                                                <a href="#" class="product-button hintT-top"
                                                    data-hint="Add to Cart"><i class="fas fa-shopping-cart"></i></a>
                                                <a href="#" class="product-button hintT-top" data-hint="Compare"><i
                                                        class="fas fa-random"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="product">
                                        <div class="product-thumb">
                                            <a href="product-details.html" class="image">
                                                <img src="/assets/images/product/s270/product-10.webp"
                                                    alt="Product Image">
                                                <img class="image-hover "
                                                    src="/assets/images/product/s270/product-10-hover.webp"
                                                    alt="Product Image">
                                            </a>
                                            <a href="wishlist.html" class="add-to-wishlist hintT-left"
                                                data-hint="Add to wishlist"><i class="far fa-heart"></i></a>
                                        </div>
                                        <div class="product-info">
                                            <h6 class="title"><a href="product-details.html">Fish Cut Out Set</a></h6>
                                            <span class="price">
                                                $9.00
                                            </span>
                                            <div class="product-buttons">
                                                <a href="#quickViewModal" data-bs-toggle="modal"
                                                    class="product-button hintT-top" data-hint="Regard rapide"><i
                                                        class="fas fa-search"></i></a>
                                                <a href="#" class="product-button hintT-top"
                                                    data-hint="Add to Cart"><i class="fas fa-shopping-cart"></i></a>
                                                <a href="#" class="product-button hintT-top" data-hint="Compare"><i
                                                        class="fas fa-random"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="product">
                                        <div class="product-thumb">
                                            <a href="product-details.html" class="image">
                                                <span class="product-badges">
                                                    <span class="onsale">-13%</span>
                                                </span>
                                                <img src="/assets/images/product/s270/product-1.webp" alt="Product Image">
                                                <img class="image-hover "
                                                    src="/assets/images/product/s270/product-1-hover.webp"
                                                    alt="Product Image">
                                            </a>
                                            <a href="wishlist.html" class="add-to-wishlist hintT-left"
                                                data-hint="Add to wishlist"><i class="far fa-heart"></i></a>
                                        </div>
                                        <div class="product-info">
                                            <h6 class="title"><a href="product-details.html">Boho Beard Mug</a></h6>
                                            <span class="price">
                                                <span class="old">$45.00</span>
                                                <span class="new">$39.00</span>
                                            </span>
                                            <div class="product-buttons">
                                                <a href="#quickViewModal" data-bs-toggle="modal"
                                                    class="product-button hintT-top" data-hint="Regard rapide"><i
                                                        class="fas fa-search"></i></a>
                                                <a href="#" class="product-button hintT-top"
                                                    data-hint="Add to Cart"><i class="fas fa-shopping-cart"></i></a>
                                                <a href="#" class="product-button hintT-top" data-hint="Compare"><i
                                                        class="fas fa-random"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="product">
                                        <div class="product-thumb">
                                            <a href="product-details.html" class="image">
                                                <img src="/assets/images/product/s270/product-2.webp" alt="Product Image">
                                                <img class="image-hover "
                                                    src="/assets/images/product/s270/product-2-hover.webp"
                                                    alt="Product Image">
                                            </a>
                                            <a href="wishlist.html" class="add-to-wishlist hintT-left"
                                                data-hint="Add to wishlist"><i class="far fa-heart"></i></a>
                                        </div>
                                        <div class="product-info">
                                            <h6 class="title"><a href="product-details.html">Motorized Tricycle</a></h6>
                                            <span class="price">
                                                $35.00
                                            </span>
                                            <div class="product-buttons">
                                                <a href="#quickViewModal" data-bs-toggle="modal"
                                                    class="product-button hintT-top" data-hint="Regard rapide"><i
                                                        class="fas fa-search"></i></a>
                                                <a href="#" class="product-button hintT-top"
                                                    data-hint="Add to Cart"><i class="fas fa-shopping-cart"></i></a>
                                                <a href="#" class="product-button hintT-top" data-hint="Compare"><i
                                                        class="fas fa-random"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="product">
                                        <div class="product-thumb">
                                            <span class="product-badges">
                                                <span class="hot">hot</span>
                                            </span>
                                            <a href="product-details.html" class="image">
                                                <img src="/assets/images/product/s270/product-3.webp" alt="Product Image">
                                                <img class="image-hover "
                                                    src="/assets/images/product/s270/product-3-hover.webp"
                                                    alt="Product Image">
                                            </a>
                                            <a href="wishlist.html" class="add-to-wishlist hintT-left"
                                                data-hint="Add to wishlist"><i class="far fa-heart"></i></a>
                                        </div>
                                        <div class="product-info">
                                            <h6 class="title"><a href="product-details.html">Walnut Cutting Board</a>
                                            </h6>
                                            <span class="price">
                                                $100.00
                                            </span>
                                            <div class="product-buttons">
                                                <a href="#quickViewModal" data-bs-toggle="modal"
                                                    class="product-button hintT-top" data-hint="Regard rapide"><i
                                                        class="fas fa-search"></i></a>
                                                <a href="#" class="product-button hintT-top"
                                                    data-hint="Add to Cart"><i class="fas fa-shopping-cart"></i></a>
                                                <a href="#" class="product-button hintT-top" data-hint="Compare"><i
                                                        class="fas fa-random"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!-- Products End -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- Product Tab End -->
            <div class="row g-0 justify-content-center learts-mt-50">
                <a href="{{ route('shop') }}" class="btn p-0">
                    <i class="ti-plus"></i> Voir plus
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
                    <h2 class="title title-icon-right">Meet our team</h2>
                    <!-- Section Title End -->
                </div>
                <div class="col-md-auto col-12 mt-4 mt-md-0">
                    <a href="#" class="btn btn-light btn-hover-black">view all</a>
                </div>
            </div>

            <div class="row row-cols-lg-2 row-cols-1 learts-mb-n40">
                <div class="col learts-mb-40 pr-xl-5">
                    <div class="team">
                        <div class="image">
                            <img src="/assets/images/team/team-1.webp" alt="">
                            <div class="social">
                                <a href="#"><i class="fab fa-facebook-f"></i></a>
                                <a href="#"><i class="fab fa-twitter"></i></a>
                                <a href="#"><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                        <div class="content">
                            <h6 class="name">Albert McKinney</h6>
                            <span class="title">CEO & CO-FOUNDER</span>
                        </div>
                    </div>
                </div>

                <div class="col learts-mb-40">

                    <div class="row justify-content-between h-100">
                        <div class="col-12 learts-mb-50 mt-xl-5">
                            <blockquote class="learts-blockquote2">
                                <div class="icon"><img src="/assets/images/icons/quote.webp" alt=""></div>
                                <div class="content">
                                    <p>Take the lead and dare to dream big, even when it seems difficult & far. Now we
                                        finally did it.</p>
                                </div>
                            </blockquote>
                        </div>
                        <div class="col-12 mt-auto">
                            <div class="row row-cols-sm-2 row-cols-1 learts-mb-n40">
                                <div class="col learts-mb-40">
                                    <div class="team">
                                        <div class="image">
                                            <img src="/assets/images/team/team-2.webp" alt="">
                                            <div class="social">
                                                <a href="#"><i class="fab fa-facebook-f"></i></a>
                                                <a href="#"><i class="fab fa-twitter"></i></a>
                                                <a href="#"><i class="fab fa-instagram"></i></a>
                                            </div>
                                        </div>
                                        <div class="content">
                                            <h6 class="name">Etta Schneider</h6>
                                            <span class="title">Ceramics</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col learts-mb-40">
                                    <div class="team">
                                        <div class="image">
                                            <img src="/assets/images/team/team-3.webp" alt="">
                                            <div class="social">
                                                <a href="#"><i class="fab fa-facebook-f"></i></a>
                                                <a href="#"><i class="fab fa-twitter"></i></a>
                                                <a href="#"><i class="fab fa-instagram"></i></a>
                                            </div>
                                        </div>
                                        <div class="content">
                                            <h6 class="name">Roger Collins</h6>
                                            <span class="title">Wood</span>
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

    <!-- Testimonial Section Start -->
    <div class="section section-padding">
        <div class="container">

            <div class="section-title2 row justify-content-between align-items-center">
                <div class="col-md-auto col-12">
                    <!-- Section Title Start -->
                    <h2 class="title title-icon-right">We love our clients</h2>
                    <!-- Section Title End -->
                </div>
                <div class="col-md-auto col-12 mt-4 mt-md-0">
                    <a href="#" class="btn btn-light btn-hover-black">view all</a>
                </div>
            </div>

            <div class="testimonial-carousel">
                <div class="col">
                    <div class="testimonial">
                        <p>There's nothing would satisfy me much more than a worry-free clean and responsive theme for my
                            high-traffic site.</p>
                        <div class="author">
                            <img src="/assets/images/testimonial/testimonial-1.webp" alt="">
                            <div class="content">
                                <h6 class="name">Anais Coulon</h6>
                                <span class="title">Actor</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="testimonial">
                        <p>Really good design/documentation, pretty much everything is nicely setup. The best choice for
                            Woocommerce shop.</p>
                        <div class="author">
                            <img src="/assets/images/testimonial/testimonial-2.webp" alt="">
                            <div class="content">
                                <h6 class="name">Ian Schneider</h6>
                                <span class="title">Actor</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="testimonial">
                        <p>ThemeMove deserves 5 star for theme’s features, design quality, flexibility, customizability and
                            support service!</p>
                        <div class="author">
                            <img src="/assets/images/testimonial/testimonial-3.webp" alt="">
                            <div class="content">
                                <h6 class="name">Florence Polla</h6>
                                <span class="title">Customer</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="testimonial">
                        <p>Thanks for always keeping your WordPress themes up to date. Your level of support is second to
                            none.</p>
                        <div class="author">
                            <img src="/assets/images/testimonial/testimonial-4.webp" alt="">
                            <div class="content">
                                <h6 class="name">Sally Ramsey</h6>
                                <span class="title">Reporter</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- Testimonial Section End -->


@endsection
