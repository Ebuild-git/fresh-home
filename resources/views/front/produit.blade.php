@extends('front.fixe')
@section('titre', $produit->nom)
@section('body')


    <div class="offcanvas-overlay"></div>

    <!-- Page Title/Header Start -->
    <div class="page-title-section section" data-bg-image="/assets/images/bg/page-title-1.webp">
        <div class="container">
            <div class="row">
                <div class="col">

                    <div class="page-title">
                        <h1 class="title">Shop</h1>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('home') }}">Accueil</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('shop') }}">Produits</a>
                            </li>
                            <li class="breadcrumb-item active">
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
                                    {"src": "/assets/images/product/single/2/product-zoom-1.webp", "w": 810, "h": 1080},
                                    {"src": "/assets/images/product/single/2/product-zoom-2.webp", "w": 810, "h": 1080},
                                    {"src": "/assets/images/product/single/2/product-zoom-3.webp", "w": 810, "h": 1080},
                                    {"src": "/assets/images/product/single/2/product-zoom-4.webp", "w": 810, "h": 1080},
                                    {"src": "/assets/images/product/single/2/product-zoom-5.webp", "w": 810, "h": 1080}
                                ]'><i
                                class="fas fa-expand"></i></button>

                        <div class="product-gallery-slider">
                            <div class="product-zoom" data-image="/assets/images/product/single/2/product-zoom-1.webp">
                                <img src="/assets/images/product/single/2/product-1.webp" alt="">
                            </div>
                            <div class="product-zoom" data-image="/assets/images/product/single/2/product-zoom-2.webp">
                                <img src="/assets/images/product/single/2/product-2.webp" alt="">
                            </div>
                            <div class="product-zoom" data-image="/assets/images/product/single/2/product-zoom-3.webp">
                                <img src="/assets/images/product/single/2/product-3.webp" alt="">
                            </div>
                            <div class="product-zoom" data-image="/assets/images/product/single/2/product-zoom-4.webp">
                                <img src="/assets/images/product/single/2/product-4.webp" alt="">
                            </div>
                            <div class="product-zoom" data-image="/assets/images/product/single/2/product-zoom-5.webp">
                                <img src="/assets/images/product/single/2/product-5.webp" alt="">
                            </div>
                        </div>
                        <div class="product-thumb-slider-vertical">
                            <div class="item">
                                <img src="/assets/images/product/single/2/product-thumb-1.webp" alt="">
                            </div>
                            <div class="item">
                                <img src="/assets/images/product/single/2/product-thumb-2.webp" alt="">
                            </div>
                            <div class="item">
                                <img src="/assets/images/product/single/2/product-thumb-3.webp" alt="">
                            </div>
                            <div class="item">
                                <img src="/assets/images/product/single/2/product-thumb-4.webp" alt="">
                            </div>
                            <div class="item">
                                <img src="/assets/images/product/single/2/product-thumb-5.webp" alt="">
                            </div>
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
                            @if ($produit->inPromotion())
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
                            <p>{{ $produit->description }}</p>
                        </div>
                        <div class="product-variations">
                            <table>
                                <tbody>
                                    <tr>
                                        <td class="label"><span>Quantity</span></td>
                                        <td class="value">
                                            <div class="product-quantity">
                                                <span class="qty-btn minus"><i class="ti-minus"></i></span>
                                                <input type="text" class="input-qty" value="1">
                                                <span class="qty-btn plus"><i class="ti-plus"></i></span>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="product-buttons">
                            <a href="#" class="btn btn-icon btn-outline-body btn-hover-dark hintT-top"
                                data-hint="Add to Wishlist">
                                <i class="far fa-heart"></i>
                            </a>
                            <a href="#" class="btn btn-dark btn-outline-hover-dark"><i
                                    class="fas fa-shopping-cart"></i>
                                Ajouter au panier
                            </a>
                        </div>
                        <div class="product-meta">
                            <table>
                                <tbody>
                                    <tr>
                                        <td class="label"><span>REFERENCE</span></td>
                                        <td class="value">{{ $produit->reference }}</td>
                                    </tr>
                                    <tr>
                                        <td class="label"><span>Categorie</span></td>
                                        <td class="value">
                                            <ul class="product-category">
                                                <li>
                                                    <a href="#">
                                                        {{ $produit->categorie->nom }}
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
                            <p>{{ $produit->description }}</p>
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
                    Vous pourriez aussi aimer
                </h2>
            </div>
            <!-- Section Title End -->

            <!-- Products Start -->
            <div class="product-carousel">

                <div class="col">
                    <div class="product">
                        <div class="product-thumb">
                            <a href="product-details.html" class="image">
                                <span class="product-badges">
                                    <span class="onsale">-13%</span>
                                </span>
                                <img src="/assets/images/product/s270/product-1.webp" alt="Product Image">
                                <img class="image-hover " src="/assets/images/product/s270/product-1-hover.webp"
                                    alt="Product Image">
                            </a>
                            <a href="wishlist.html" class="add-to-wishlist hintT-left" data-hint="Add to wishlist"><i
                                    class="far fa-heart"></i></a>
                        </div>
                        <div class="product-info">
                            <h6 class="title"><a href="product-details.html">Boho Beard Mug</a></h6>
                            <span class="price">
                                <span class="old">$45.00</span>
                                <span class="new">$39.00</span>
                            </span>
                            <div class="product-buttons">
                                <a href="#quickViewModal" data-bs-toggle="modal" class="product-button hintT-top"
                                    data-hint="Quick View"><i class="fas fa-search"></i></a>
                                <a href="#" class="product-button hintT-top" data-hint="Add to Cart"><i
                                        class="fas fa-shopping-cart"></i></a>
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
                                <img class="image-hover " src="/assets/images/product/s270/product-2-hover.webp"
                                    alt="Product Image">
                            </a>
                            <a href="wishlist.html" class="add-to-wishlist hintT-left" data-hint="Add to wishlist"><i
                                    class="far fa-heart"></i></a>
                        </div>
                        <div class="product-info">
                            <h6 class="title"><a href="product-details.html">Motorized Tricycle</a></h6>
                            <span class="price">
                                $35.00
                            </span>
                            <div class="product-buttons">
                                <a href="#quickViewModal" data-bs-toggle="modal" class="product-button hintT-top"
                                    data-hint="Quick View"><i class="fas fa-search"></i></a>
                                <a href="#" class="product-button hintT-top" data-hint="Add to Cart"><i
                                        class="fas fa-shopping-cart"></i></a>
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
                                <img class="image-hover " src="/assets/images/product/s270/product-3-hover.webp"
                                    alt="Product Image">
                            </a>
                            <a href="wishlist.html" class="add-to-wishlist hintT-left" data-hint="Add to wishlist"><i
                                    class="far fa-heart"></i></a>
                        </div>
                        <div class="product-info">
                            <h6 class="title"><a href="product-details.html">Walnut Cutting Board</a></h6>
                            <span class="price">
                                $100.00
                            </span>
                            <div class="product-buttons">
                                <a href="#quickViewModal" data-bs-toggle="modal" class="product-button hintT-top"
                                    data-hint="Quick View"><i class="fas fa-search"></i></a>
                                <a href="#" class="product-button hintT-top" data-hint="Add to Cart"><i
                                        class="fas fa-shopping-cart"></i></a>
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
                                    <span class="onsale">-27%</span>
                                </span>
                                <img src="/assets/images/product/s270/product-4.webp" alt="Product Image">
                                <img class="image-hover " src="/assets/images/product/s270/product-4-hover.webp"
                                    alt="Product Image">
                            </a>
                            <a href="wishlist.html" class="add-to-wishlist hintT-left" data-hint="Add to wishlist"><i
                                    class="far fa-heart"></i></a>
                        </div>
                        <div class="product-info">
                            <h6 class="title"><a href="product-details.html">Pizza Plate Tray</a></h6>
                            <span class="price">
                                <span class="old">$30.00</span>
                                <span class="new">$22.00</span>
                            </span>
                            <div class="product-buttons">
                                <a href="#quickViewModal" data-bs-toggle="modal" class="product-button hintT-top"
                                    data-hint="Quick View"><i class="fas fa-search"></i></a>
                                <a href="#" class="product-button hintT-top" data-hint="Add to Cart"><i
                                        class="fas fa-shopping-cart"></i></a>
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
                                <img src="/assets/images/product/s270/product-5.webp" alt="Product Image">
                                <img class="image-hover " src="/assets/images/product/s270/product-5-hover.webp"
                                    alt="Product Image">
                            </a>
                            <a href="wishlist.html" class="add-to-wishlist hintT-left" data-hint="Add to wishlist"><i
                                    class="far fa-heart"></i></a>
                            <div class="product-options">
                                <ul class="colors">
                                    <li style="background-color: #c2c2c2;">color one</li>
                                    <li style="background-color: #374140;">color two</li>
                                    <li style="background-color: #8ea1b2;">color three</li>
                                </ul>
                                <ul class="sizes">
                                    <li>Large</li>
                                    <li>Medium</li>
                                    <li>Small</li>
                                </ul>
                            </div>
                        </div>
                        <div class="product-info">
                            <h6 class="title"><a href="product-details.html">Minimalist Ceramic Pot</a></h6>
                            <span class="price">
                                $120.00
                            </span>
                            <div class="product-buttons">
                                <a href="#quickViewModal" data-bs-toggle="modal" class="product-button hintT-top"
                                    data-hint="Quick View"><i class="fas fa-search"></i></a>
                                <a href="#" class="product-button hintT-top" data-hint="Add to Cart"><i
                                        class="fas fa-shopping-cart"></i></a>
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
                                <img src="/assets/images/product/s270/product-6.webp" alt="Product Image">
                                <img class="image-hover " src="/assets/images/product/s270/product-6-hover.webp"
                                    alt="Product Image">
                            </a>
                            <a href="wishlist.html" class="add-to-wishlist hintT-left" data-hint="Add to wishlist"><i
                                    class="far fa-heart"></i></a>
                        </div>
                        <div class="product-info">
                            <h6 class="title"><a href="product-details.html">Clear Silicate Teapot</a></h6>
                            <span class="price">
                                $140.00
                            </span>
                            <div class="product-buttons">
                                <a href="#quickViewModal" data-bs-toggle="modal" class="product-button hintT-top"
                                    data-hint="Quick View"><i class="fas fa-search"></i></a>
                                <a href="#" class="product-button hintT-top" data-hint="Add to Cart"><i
                                        class="fas fa-shopping-cart"></i></a>
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
                                <img class="image-hover " src="/assets/images/product/s270/product-7-hover.webp"
                                    alt="Product Image">
                            </a>
                            <a href="wishlist.html" class="add-to-wishlist hintT-left" data-hint="Add to wishlist"><i
                                    class="far fa-heart"></i></a>
                        </div>
                        <div class="product-info">
                            <h6 class="title"><a href="product-details.html">Lucky Wooden Elephant</a></h6>
                            <span class="price">
                                $35.00
                            </span>
                            <div class="product-buttons">
                                <a href="#quickViewModal" data-bs-toggle="modal" class="product-button hintT-top"
                                    data-hint="Quick View"><i class="fas fa-search"></i></a>
                                <a href="#" class="product-button hintT-top" data-hint="Add to Cart"><i
                                        class="fas fa-shopping-cart"></i></a>
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
                                <img class="image-hover " src="/assets/images/product/s270/product-8-hover.webp"
                                    alt="Product Image">
                            </a>
                            <a href="wishlist.html" class="add-to-wishlist hintT-left" data-hint="Add to wishlist"><i
                                    class="far fa-heart"></i></a>
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
                            <h6 class="title"><a href="product-details.html">Decorative Christmas Fox</a></h6>
                            <span class="price">
                                $50.00
                            </span>
                            <div class="product-buttons">
                                <a href="#quickViewModal" data-bs-toggle="modal" class="product-button hintT-top"
                                    data-hint="Quick View"><i class="fas fa-search"></i></a>
                                <a href="#" class="product-button hintT-top" data-hint="Add to Cart"><i
                                        class="fas fa-shopping-cart"></i></a>
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
    <!-- Recommended Products Section End -->

@endsection
