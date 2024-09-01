@extends('front.fixe')
@section('titre', 'Contact')
@section('body')

    <div class="offcanvas-overlay"></div>

    <!-- Page Title/Header Start -->
    <div class="page-title-section section" data-bg-image="/assets/images/bg/page-title-1.webp">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="page-title">
                        <h1 class="title">Contact</h1>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('home') }}">Accueil</a>
                            </li>
                            <li class="breadcrumb-item active">Contact</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Title/Header End -->

    <!-- Contact Information & Map Section Start -->
    <div class="section section-padding">
        <div class="container">
            <!-- Section Title Start -->
            <div class="section-title2 text-center">
                <h2 class="title">
                    Restez en contact avec nous
                </h2>
                <p>Been tearing your hair out to find the perfect gift for your loved ones? Try visiting our nationwide
                    local stores. You can also contact us to become partner or distributor. Call us, send us an email or
                    make an appointment now.</p>
            </div>
            <!-- Section Title End -->

            <!-- Contact Information Start -->
            <div class="row learts-mb-n30">
                <div class="col-lg-4 col-md-6 col-12 learts-mb-30">
                    <div class="contact-info">
                        <h4 class="title">ADDRESSE</h4>
                        <span class="info">
                            <i class="icon fas fa-map-marker-alt"></i>
                            {{ $infos->adresse ?? '' }}
                        </span>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-12 learts-mb-30">
                    <div class="contact-info">
                        <h4 class="title">CONTACT</h4>
                        <span class="info">
                            <i class="icon fas fa-phone-alt"></i>
                            {{ $infos->telephone ?? '' }}
                        </span>
                        <span class="info">
                            <i class="icon far fa-envelope"></i> Mail:
                            <a href="#">
                                {{ $infos->email ?? '' }}
                            </a>
                        </span>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-12 learts-mb-30">
                    <div class="contact-info">
                        <h4 class="title"> DISPONIBLILITE</h4>
                        <span class="info"><i class="icon far fa-clock"></i> Lundi - vendredi : 09:00 – 20:00 <br> samedi - Dimande : 10:30 – 22:00</span>
                    </div>
                </div>
            </div>
            <!-- Contact Information End -->

            <!-- Contact Map Start -->
            <div class="row learts-mt-60">
                <div class="col">
                    <iframe class="contact-map"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2136.986005919501!2d-73.9685579655238!3d40.75862446708152!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c258e4a1c884e5%3A0x24fe1071086b36d5!2sThe%20Atrium!5e0!3m2!1sen!2sbd!4v1585132512970!5m2!1sen!2sbd"
                        style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                </div>
            </div>
            <!-- Contact Map End -->

        </div>
    </div>
    <!-- Contact Information & Map Section End -->

    <!-- Contact Form Section Start -->
    <div class="section section-padding pt-0">
        <div class="container">
            <!-- Section Title Start -->
            <div class="section-title2 text-center">
                <h2 class="title">
                    Contactez-nous
                </h2>
            </div>
            <!-- Section Title End -->


            <div class="row">
                <div class="col-lg-8 col-12 mx-auto">
                    <div class="contact-form">
                        <form action="{{ route('front-contact.store') }}" id="contact-form" method="post">
                            @csrf
                            <div class="row learts-mb-n30">
                                <div class="col-md-6 col-12 learts-mb-30">
                                    <input type="text" placeholder="Votre nom *" name="nom">
                                </div>
                                <div class="col-md-6 col-12 learts-mb-30">
                                    <input type="email" placeholder="Email *" name="email">
                                </div>
                                <div class="col-md-12 col-12 learts-mb-30">
                                    <input type="tel" placeholder="Numéro de téléphone *" name="telepone">
                                </div>
                                <div class="col-12 learts-mb-30">
                                    <textarea name="message" placeholder="Message"></textarea>
                                </div>
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <div class="col-12 text-center learts-mb-30">
                                    <button class="btn btn-dark btn-outline-hover-dark">
                                        Envoyer le message
                                    </button>
                                </div>
                            </div>
                        </form>
                        <p class="form-messege"></p>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- Contact Form Section End -->

@endsection
