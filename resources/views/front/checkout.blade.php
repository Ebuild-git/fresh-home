@extends('front.fixe')
@section('titre', 'Paiement')
@section('body')

    <div class="offcanvas-overlay"></div>

    <!-- Page Title/Header Start -->
    <div class="page-title-section section" data-bg-image="{{ isset($banner) && $banner->photo ? Storage::url($banner->photo) : '/assets/images/bg/page-title-1.webp' }}">
        <div class="container">
            <div class="row">
                <div class="col">

                    <div class="page-title">
                        <h1 class="title text-white">
                            Paiement
                        </h1>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item text-white">
                                <a href="{{ route('home') }}">
                                    Accueil
                                </a>
                            </li>
                            <li class="breadcrumb-item text-white active">
                                Paiement
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- Page Title/Header End -->

    <!-- Checkout Section Start -->
    <div class="section section-padding">
        <div class="container">
            <div class="section-title2 text-center">
                <h2 class="title">Votre commande</h2>
            </div>
            <div class="row learts-mb-n30">
                <div class="col-lg-6 order-lg-2 learts-mb-30">
                    <div class="order-review">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="name">Produits</th>
                                    <th class="total">Sous-total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($panier as $produit)
                                    <tr>
                                        <td class="name">
                                            {{ Str::limit($produit['nom'], 30) }}
                                            <strong class="quantity">×&nbsp;
                                                {{ $produit['quantite'] }}
                                            </strong>
                                        </td>
                                        <td class="total">
                                            <span>
                                                {{ $produit['quantite'] * $produit['prix'] }}
                                                <x-devise></x-devise>
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr class="subtotal">
                                    <th>Frais de livraison</th>
                                    <td>
                                        <span>
                                            {{ $frais_livraison }}
                                            <x-devise></x-devise>
                                        </span>
                                    </td>
                                </tr>
                                <tr class="subtotal">
                                    <th>Sous-total</th>
                                    <td>
                                        <span>
                                            {{ $montant }}
                                            <x-devise></x-devise>
                                        </span>
                                    </td>
                                </tr>
                                <tr class="total">
                                    <th>Total</th>
                                    <td>
                                        <strong>
                                            <span>
                                                {{ $montant_final }}
                                                <x-devise></x-devise>
                                            </span>
                                        </strong>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="col-lg-6 order-lg-1 learts-mb-30">
                    <div class="order-payment">
                        <form action="{{ route('commander') }}" method="post">
                            @csrf
                            <div class="payment-method">
                                <div class="p-2">
                                    <h4 class="title">Adresse de facturation </h4>
                                    <div class="text-end">
                                        <small>
                                            <a href="">
                                                <b>Modifier</b>
                                            </a>
                                        </small>
                                    </div>
                                    <address>
                                        <p>
                                            <strong>
                                                {{ $user->nom ?? '' }} 
                                                {{ $user->prenom ?? '' }}
                                            </strong>
                                        </p>
                                        <p>
                                            {{ $user->email ?? '' }} <br>
                                            {{ $user->adresse ?? '' }} <br>
                                            <b> Mobile:</b> {{ $user->phone }}
                                        </p>
                                    </address>
                                </div>
                                <div class="accordion" id="paymentMethod">
                                    <div class="card active">
                                        <div class="card-header">
                                            <button data-bs-toggle="collapse" data-bs-target="#cashkPayments">
                                                Paiement à la livraison
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <p class="payment-note">
                                    Vos données personnelles seront utilisées pour traiter votre commande, soutenir votre
                                    expérience sur ce site Web et à d'autres fins décrites dans notre politique de
                                    confidentialité.
                                </p>
                                <button class="btn btn-dark btn-outline-hover-dark" type="submit">
                                    passer commande
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Checkout Section End -->

@endsection
