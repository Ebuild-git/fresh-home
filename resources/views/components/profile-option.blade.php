<div class="card-v border py-3 rounded">
    <div class="title-and-image">
        <img src="/front/storage/app/public/admin-assets/images/about/default.png" alt=""
            class="object-fit-cover img-fluid profile-img rounded-circle d-flex justify-content-center m-auto">
        <h5 class="text-dark mt-2 mx-3 text-center">
            {{ Auth::user()->nom }}
        </h5>
    </div>
    <div class="user-list-saide-bar mt-4 bg-white rounded-1">
        <ul class="m-0">
            <a href="{{ route('profile') }}" class="settings-link">
                <li class="list-unstyled border-0 text-dark my-2 py-3 px-3 d-flex align-items-center ">
                    <i class="fa-light fa-user pe-2"></i>
                    <span class="px-2 d-block">
                        Modifier le profil
                    </span>
                </li>
            </a>
            <a href="{{ route('change_password') }}" class="settings-link">
                <li class="list-unstyled text-dark border-0 my-2 py-3 px-3 d-flex align-items-center ">
                    <i class="fa-light fa-lock pe-2"></i>
                    <span class="px-2 d-block">
                        Changer le mot de passe
                    </span>
                </li>
            </a>
            <a href="{{ route('orders') }}" class="settings-link ">
                <li class="list-unstyled text-dark border-0 my-2 py-3 px-3 d-flex align-items-center ">
                    <i class="fa-light fa-list-ol pe-2"></i>
                    <span class="px-2 d-block">
                        Commandes
                    </span>
                </li>
            </a>
            <a href="{{ route('favoris') }}" class="settings-link ">
                <li class="list-unstyled text-dark border-0 my-2 py-3 px-3 d-flex align-items-center ">
                    <i class="fa-light fa-heart pe-2"></i>
                    <span class="px-2 d-block">
                        Ma liste de favoris
                    </span>
                </li>
            </a>
            
            <a href="{{ route('logout') }}"class="settings-link ">
                <li
                    class="list-unstyled text-dark border-0 my-2 py-3 px-3 d-flex align-items-center rounded">
                    <i class="fa-light fa-arrow-right-from-bracket pe-2">
                        <span class="px-2 d-block">
                    </i>
                    <b class="text-danger">
                        Déconnexion
                    </b>
                    </span>
                </li>
            </a>
        </ul>
    </div>
</div>