@extends('front.fixe')
@section('titre', 'Paiement')
@section('body')

    <div class="offcanvas-overlay"></div>

    <!-- Page Title/Header Start -->
    <div class="page-title-section section" data-bg-image="/assets/images/bg/page-title-1.webp">
        <div class="container">
            <div class="row">
                <div class="col">

                    <div class="page-title">
                        <h1 class="title">
                            Paiement
                        </h1>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('home') }}">
                                    Accueil
                                </a>
                            </li>
                            <li class="breadcrumb-item active">
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
            <div class="section-title2">
                <h2 class="title">Détails de facturation</h2>
            </div>
            <form action="#" class="checkout-form learts-mb-50">
                <div class="row">
                    <div class="col-md-4 col-12 learts-mb-20">
                        <label for="bdFirstName">Nom<abbr class="required">*</abbr></label>
                        <input type="text" id="bdFirstName" name="nom" value="{{ $user->nom ?? "" }}" required>
                    </div>
                    <div class="col-md-4 col-12 learts-mb-20">
                        <label for="bdLastName">prénom <abbr class="required">*</abbr></label>
                        <input type="text" id="bdLastName" name="prenom" value="{{ $user->prenom ?? "" }}">
                    </div>
                    <div class="col-md-4 col-12 learts-mb-20">
                        <label for="bdAddress1">Adresse <abbr class="required">*</abbr></label>
                        <input type="text" id="bdAddress1" placeholder="House number and street name" value="{{ $user->adresse?? "" }}" name="adresse"
                            required>
                    </div>
                    <div class="col-12 col-md-12 learts-mb-20">
                        <label for="bdTownOrCity">Gouvernorat <abbr class="required">*</abbr></label>
                        <select name="gouvernorat" id="gouvernorat" class="select2-basic" id="bdTownOrCity" required>
                            <option selected disabled>
                                Veuillez choisir un gouvernorat
                            </option>
                            @foreach ($gouvernorats as $gouvernorat)
                                <option value="{{ $gouvernorat->id }}" @selected($user->id_gouvernorat ==  $gouvernorat)>
                                    {{ $gouvernorat->id }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12 col-md-4 learts-mb-20">
                        <label for="bdPostcode">Code postal</label>
                        <input type="text" id="bdPostcode" name="code_postal" value="{{ $user->code_postal ?? "" }}">
                    </div>
                    <div class="col-md-4 col-12  learts-mb-20">
                        <label for="bdEmail">Adresse email <abbr class="required">*</abbr></label>
                        <input type="text" id="bdEmail" name="email" value="{{ $user->adresse ?? "" }}">
                    </div>
                    <div class="col-md-4 col-12 learts-mb-30">
                        <label for="bdPhone">Numéro de téléphone <abbr class="required">*</abbr></label>
                        <input type="text" id="bdPhone" name="telephone" value="{{ $user->telephone ?? "" }}" placeholder="+216 XX XXX XXX">
                    </div>
                </div>
            </form>
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
                        <div class="payment-method">
                            <div class="accordion" id="paymentMethod">
                                <div class="card active">
                                    <div class="card-header">
                                        <button data-bs-toggle="collapse" data-bs-target="#cashkPayments">Cash on delivery
                                        </button>
                                    </div>
                                    <div id="cashkPayments" class="collapse" data-bs-parent="#paymentMethod">
                                        <div class="card-body">
                                            <p>Pay with cash upon delivery.</p>
                                        </div>
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
                            <button class="btn btn-dark btn-outline-hover-dark">
                                passer commande
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Checkout Section End -->

@endsection
