@extends('front.fixe')
@section('titre', 'Favoris')
@section('body')

    <div class="offcanvas-overlay"></div>

    <!-- Page Title/Header Start -->
    <div class="page-title-section section" data-bg-image="/assets/images/bg/page-title-1.webp">
        <div class="container">
            <div class="row">
                <div class="col">

                    <div class="page-title">
                        <h1 class="title">Favoris</h1>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('home') }}">
                                    Accueil
                                </a>
                            </li>
                            <li class="breadcrumb-item active">Favoris</li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- Page Title/Header End -->

    <!-- Wishlist Section Start -->
    <div class="section section-padding">
        <div class="container">
            <form class="cart-form" action="#">
                <table class="cart-wishlist-table table">
                    <thead>
                        <tr>
                            <th class="name" colspan="2">Produuit</th>
                            <th class="price">Prix unitaire</th>
                            <th class="add-to-cart">&nbsp;</th>
                            <th class="remove">&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($favoris  as $item)
                            @php
                                $produit = $item->produit;
                            @endphp
                            @if ($produit)
                                <tr id="tr-favoris-{{ $produit->id }}">
                                    <td class="thumbnail">
                                        <a href="product-details.html">
                                            <img src="{{ Storage::url($produit->photo) }}" alt="{{ $produit->nom }}">
                                        </a>
                                    </td>
                                    <td class="name">
                                        <a href="product-details.html">
                                            {{ Str::limit($produit->nom) }}
                                        </a>
                                    </td>
                                    <td class="price">
                                        <span>
                                            {{ $produit->getPrice() }}
                                            <x-devise></x-devise>
                                        </span>
                                    </td>
                                    <td class="add-to-cart">
                                        <a href="javascript:void();" class="btn btn-light btn-hover-dark">
                                            <i class="fas fa-shopping-cart mr-2"></i>
                                            Ajouter au panier
                                        </a>
                                    </td>
                                    <td class="remove">
                                        <a href="javascript:void();" class="btn delete-from-wish"
                                            data-id="{{ $produit->id }}">×</a>
                                    </td>
                                </tr>
                            @endif
                        @empty
                            <tr>
                                <td>
                                    <div class="text-center p-3">
                                        Aucun favori trouvé. <br> Veuillez ajouter des produits à votre liste de favoris.
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="row">
                    <div class="col text-center mb-n3">
                        <a class="btn btn-light btn-hover-dark mr-3 mb-3" href="{{ route('shop') }}">
                            Continuer mes achats
                        </a>
                        <a class="btn btn-dark btn-outline-hover-dark mb-3" href="{{ route('cart') }}">
                            Voir le panier
                        </a>
                    </div>
                </div>
            </form>
        </div>

    </div>
    <!-- Wishlist Section End -->

@endsection
