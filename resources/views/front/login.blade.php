@extends('front.fixe')
@section('titre', 'Conenxion')
@section('body')


    <div class="offcanvas-overlay"></div>

    <!-- Page Title/Header Start -->
    <div class="page-title-section section" data-bg-image="{{ isset($banner) && $banner->photo ? Storage::url($banner->photo) : '/assets/images/bg/page-title-1.webp' }}">
        <div class="container">
            <div class="row">
                <div class="col">

                    <div class="page-title">
                        <h1 class="title text-white">
                            {{ __('login_register') }}
                        </h1>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item text-white">
                                <a href="{{route('home') }}">
                                    {{ __('accueil') }}
                                </a>
                            </li>
                            <li class="breadcrumb-item active text-white">
                                {{ __('login_register') }}
                            </li>
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
                            <h2 class="title">
                                {{ __('connexion') }}
                            </h2>
                        </div>
                        <div class="login-register-form">
                            @livewire('Front.Login')
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="user-login-register">
                        <div class="login-register-title">
                            <h2 class="title">
                                {{ __('inscription') }}
                            </h2>
                            <p class="desc">
                                {{ __('register_2') }}
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
