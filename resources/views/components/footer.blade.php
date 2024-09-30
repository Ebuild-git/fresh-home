
<div class="footer2-section section section-padding">
    <div class="container">
        <div class="row {{ config('app.name') }}-mb-n40">

            <div class="col-lg-6 {{ config('app.name') }}-mb-40">
                <div class="widget-about">
                    <img src="{{ $infos->logo ? Storage::url($infos->logo) : '' }}" height="50"
                        alt="">
                    <p>
                        {{ $infos->footer_text ?? '' }}
                    </p>
                </div>
            </div>

            <div class="col-lg-4 {{ config('app.name') }}-mb-40">
                <div class="row">
                    <div class="col">
                        <ul class="widget-list">
                            <li><a href="{{ route('about') }}">{{ __('about') }}</a></li>
                            <li><a href="{{ route('front-contact.index') }}">{{ __('contact') }}</a></li>
                            <li><a href="{{ route('shop') }}">{{ __('shop') }}</a></li>
                        </ul>
                    </div>
                    <div class="col">
                        <ul class="widget-list">
                            <li><a href="#">Returns</a></li>
                            <li><a href="#">Support Policy</a></li>
                            <li><a href="#">Size Guide</a></li>
                            <li><a href="#">FAQs</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-lg-2 {{ config('app.name') }}-mb-40">
                <ul class="widget-list">
                    @if ($infos->tiktok)
                        <li>
                            <i class="fab fa-tiktok"></i>
                            <a href="{{ $infos->tiktok }}">tiktok</a>
                        </li>
                    @endif
                    @if ($infos->facebook)
                        <li>
                            <i class="fab fa-facebook-f"></i>
                            <a href="{{ $infos->facebook }}">Facebook</a>
                        </li>
                    @endif
                    @if ($infos->instagram)
                        <li>
                            <i class="fab fa-instagram"></i>
                            <a href="{{ $infos->instagram }}">Instagram</a>
                        </li>
                    @endif
                </ul>
            </div>

        </div>
    </div>
</div>

<div class="footer2-copyright section">
    <div class="container">
        <p class="copyright text-center">
            &copy; 2024 . {{ __('all_rights') }}
            <a href="https://www.e-build.tn" target="__blank" style="color: #da1226;">
                <b>Ebuild</b>
            </a>
        </p>
    </div>
</div>
