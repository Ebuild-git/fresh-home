@extends('front.fixe')
@section('titre', __('mon_compte'))
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
                            {{ __('mon_compte') }}
                        </h1>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('home') }}" class="text-white">
                                    {{ __('accueil') }}
                                </a>
                            </li>
                            <li class="breadcrumb-item active text-white">
                                {{ __('mon_compte') }}
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- Page Title/Header End -->

    <!-- My Account Section Start -->
    <div class="section section-padding">
        <div class="container">
            <div class="row learts-mb-n30">

                <!-- My Account Tab List Start -->
                <div class="col-lg-4 col-12 learts-mb-30">
                    <div class="myaccount-tab-list nav">
                        <a href="#dashboad" class="active" data-bs-toggle="tab">
                            {{ __('dashboard') }}
                            <i class="far fa-home"></i>
                        </a>
                        <a href="#orders" data-bs-toggle="tab">
                            {{ __('commandes') }} <i class="far fa-file-alt"></i>
                        </a>
                        <a href="#account-info" data-bs-toggle="tab">
                            {{ __('mes_informations') }}
                            <i class="far fa-user"></i>
                        </a>
                        <a href="#account-securiter" data-bs-toggle="tab">
                            {{ __('securite') }}
                            <i class="far fa-shield"></i>
                        </a>
                        <a href="{{ route('logout') }}" class="text-danger">
                            {{ __('deconnexion') }}
                            <i class="far fa-sign-out-alt"></i>
                        </a>
                    </div>
                </div>
                <!-- My Account Tab List End -->

                <!-- My Account Tab Content Start -->
                <div class="col-lg-8 col-12 learts-mb-30">
                    <div class="tab-content">

                        <!-- Single Tab Content Start -->
                        <div class="tab-pane fade show active" id="dashboad">
                            <div class="myaccount-content dashboad">
                                <p>
                                    {{ __('salut') }}
                                    <strong>{{ Auth::user()->nom }}</strong>,
                                </p>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="p-2 card-dashboard">
                                            <h2>
                                                0{{ $user->commandes->count() }}
                                            </h2>
                                            <h5>
                                                {{ __('commandes') }}
                                                </h4>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="p-2 card-dashboard">
                                            <h2>
                                                0{{ $user->favoris->count() }}
                                            </h2>
                                            <h5>
                                                {{ __('favoris') }}
                                                </h4>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="p-2 card-dashboard">
                                            <h2>
                                                0{{ count(session('panier_front', [])) }}
                                            </h2>
                                            <h5>
                                                {{ __('panier') }}
                                                </h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Single Tab Content End -->

                        <!-- Single Tab Content Start -->
                        <div class="tab-pane fade" id="orders">
                            <div class="myaccount-content order">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Satut</th>
                                                <th>Montant</th>
                                                <th>Date</th>
                                                <th>Mode de paiement</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($commandes as $commande)
                                                <tr>
                                                    <td> {{ $commande->id }} </td>
                                                    <td> {{ $commande->statut }} </td>
                                                    <td> {{ $commande->montant() }} <x-devise></x-devise> </td>
                                                    <td> {{ $commande->created_at->format('d-m-Y  H:m') }} </td>
                                                    <td>
                                                        @if ($commande->mode_paiement == 'offline')
                                                            A la livraison
                                                        @else
                                                            En ligne
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($commande->token)
                                                        <a href="{{ route('print_commande2', $commande->token) }}"
                                                            class="btn btn-sm btn-dark">
                                                            Télécharger
                                                        </a>
                                                        @else
                                                            <span class="text-danger">
                                                                Erreur de génération du PDF
                                                            </span>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="6">
                                                        <div class="text-center p-3">
                                                            Aucune commandes disponible !
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- Single Tab Content End -->


                        <!-- Single Tab Content Start -->
                        <div class="tab-pane fade" id="account-info">
                            <div class="myaccount-content account-details">
                                <div class="account-details-form">
                                    @livewire('Front.Informations')
                                </div>
                            </div>
                        </div> <!-- Single Tab Content End -->



                        <!-- Single Tab Content Start -->
                        <div class="tab-pane fade" id="account-securiter">
                            <div class="myaccount-content account-details">
                                <div class="account-details-form">
                                    @livewire('Front.Security')
                                </div>
                            </div>
                        </div>

                    </div>
                </div> <!-- My Account Tab Content End -->
            </div>
        </div>
    </div>
    <!-- My Account Section End -->

    <style>
        .card-dashboard {
            background-color: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            border: solid 1px rgba(0, 0, 0, 0.267);
            text-align: left;
            border-bottom: solid 4px black;
        }
    </style>


<x-footer></x-footer>

@endsection
