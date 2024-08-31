@extends('front.fixe')
@section('titre', 'Erreur 404')
@section('body')

<div class="offcanvas-overlay"></div>

<!-- 404 Section Start -->
<div class="section-404 section" data-bg-image="/assets/images/bg/bg-404.webp">
    <div class="container">
        <div class="content-404">
            <h1 class="title">Oops!</h1>
            <h2 class="sub-title">Page not found!</h2>
            <p>You could either go back or go to homepage</p>
            <div class="buttons">
                <a class="btn btn-primary btn-outline-hover-dark" href="{{ route('home') }}">
                    Accueil
                </a>
            </div>
        </div>
    </div>
</div>


@endsection