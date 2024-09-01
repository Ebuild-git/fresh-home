@extends('front.fixe')
@section('titre', 'Conenxion')
@section('body')


    <div class="offcanvas-overlay"></div>

    <!-- Page Title/Header Start -->
    <div class="page-title-section section" data-bg-image="/assets/images/bg/page-title-1.webp">
        <div class="container">
            <div class="row">
                <div class="col">

                    <div class="page-title">
                        <h1 class="title">Connexion et inscription</h1>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{route('home') }}">
                                    Accueil
                                </a>
                            </li>
                            <li class="breadcrumb-item active">Connexion et inscription</li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- Page Title/Header End -->

    <!-- Login & Register Section Start -->
    <div class="section section-padding">
        <div class="container">
            <div class="row g-0">
                <div class="col-lg-6">
                    <div class="user-login-register bg-light">
                        <div class="login-register-title">
                            <h2 class="title">Connexion</h2>
                            <p class="desc">
                                Super de vous revoir !
                            </p>
                        </div>
                        <div class="login-register-form">
                            @livewire('Front.Login')
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="user-login-register">
                        <div class="login-register-title">
                            <h2 class="title">Inscription</h2>
                            <p class="desc">
                                Si vous n'avez pas de compte, inscrivez-vous maintenant !
                            </p>
                        </div>
                        <div class="login-register-form">
                            @livewire('Front.Register')
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
    <!-- Login & Register Section End -->

@endsection
