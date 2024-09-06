@extends('front.fixe')
@section('titre', 'Panier')
@section('body')


    <div class="offcanvas-overlay"></div>

    <!-- Page Title/Header Start -->
    <div class="page-title-section section" data-bg-image="{{ isset($banner) && $banner->photo ? Storage::url($banner->photo) : '/assets/images/bg/page-title-1.webp' }}">
        <div class="container">
            <div class="row">
                <div class="col">

                    <div class="page-title">
                        <h1 class="title text-white">
                            Panier
                        </h1>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item text-white">
                                <a href="{{ route('home') }}">Accueil</a>
                            </li>
                            <li class="breadcrumb-item active text-white">
                                Panier
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- Page Title/Header End -->

    <!-- Shopping Cart Section Start -->
    <div class="section section-padding">
        <div class="container">
            <form class="cart-form" action="#">
                <table class="cart-wishlist-table table">
                    <thead>
                        <tr>
                            <th class="name" colspan="2">Produit</th>
                            <th class="price">Prix</th>
                            <th class="quantity">Quantité</th>
                            <th class="subtotal">Total</th>
                            <th class="remove">&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($produits as $produit)
                            <tr id="cart-list-{{ $produit['id'] }}">
                                <td class="thumbnail">
                                    <a href="product-details.html">
                                        <img src="{{ $produit['photo'] }}" alt="{{ $produit['nom'] }}">
                                    </a>
                                </td>
                                <td class="name">
                                    <a href="product-details.html">
                                        {{ $produit['nom'] }}
                                    </a>
                                </td>
                                <td class="price">
                                    <span>
                                        {{ $produit['prix'] }}
                                        <x-devise></x-devise>
                                    </span>
                                </td>
                                <td class="quantity">
                                    <div class="product-quantity">
                                        <span class="qty-btn minus"><i class="ti-minus"></i></span>
                                        <input type="text" class="input-qty" readonly data-id="{{ $produit['id'] }}" value="1">
                                        <span class="qty-btn plus"><i class="ti-plus"></i></span>
                                    </div>
                                </td>
                                <td class="subtotal">
                                    <span>
                                        {{ $produit['quantite'] * $produit['prix'] }} 
                                        <x-devise></x-devise>
                                    </span>
                                </td>
                                <td class="remove">
                                    <a href="#" class="btn btn-delete-list-cart" data-id="{{ $produit['id'] }}">×</a>
                                </td>
                            </tr>
                        @empty
                        <tr>
                            <td colspan="5">
                                <div class="text-center p-3">
                                     Aucun produit dans votre panier!
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="row justify-content-between mb-n3">
                    <div class="col-auto mb-3">
                       
                    </div>
                    <div class="col-auto">
                        <a class="btn btn-dark btn-outline-hover-dark mb-3" href="{{ route('checkout') }}">
                            Continuer le paiement
                        </a>
                    </div>
                </div>
            </form>
        </div>

    </div>
    <!-- Shopping Cart Section End -->

@endsection
