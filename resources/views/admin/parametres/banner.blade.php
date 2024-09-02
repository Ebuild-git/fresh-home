@section('titre', 'Bannière')
@extends('admin.fixe')

@section('body')

    <div class="page-content-wrapper">
        <div class="page-content">

            <!-- start page title -->
            <div class="row mb-3">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item">
                                    <a href="javascript: void(0);">{{ config('app.name') }}</a>
                                </li>
                                <li class="breadcrumb-item active">Bannière</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <!--end breadcrumb-->
            <div class="user-profile-page">
                <div class="card radius-15">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-8">
                                <table class="table">
                                    <thead class="table-dark cusor">
                                        <tr>
                                            <th>ID</th>
                                            <th>Titre</th>
                                            <th>Image</th>
                                            <th>Position</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($banners as $banner)
                                            <tr>
                                                <td>{{ $banner->id }}</td>
                                                <td>{{ $banner->titre ?? "-" }}</td>
                                                <td>
                                                    <a href="{{ Storage::url($banner->photo)}}" target="__blank">
                                                        <img src="{{ Storage::url($banner->photo)}}" width="40 " height="40 " class="rounded shadow" alt="{{ $banner->titre }}">
                                                    </a>
                                                </td>
                                                <td>
                                                    <span class="badge bg-dark" title="{{ $banner->titre }}">
                                                        {{ $banner->position() }}
                                                    </span>
                                                </td>
                                                <td class="text-end">
                                                    <form action="{{ route('banners.destroy', $banner->id) }}" method="post" onsubmit="return confirm('��tes-vous s��r de vouloir supprimer cette bannière?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger">
                                                            <i class='bx bx-trash'></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5">
                                                    <div class="p-3 text-center">
                                                        Aucune bannière trouvée.
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-sm-4">
                                <form action="{{ route('banners.store') }}" enctype="multipart/form-data" method="post">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="">Titre</label>
                                        <input type="text" name="titre" id="titre" value="{{ old('titre') }}" class="form-control">
                                        @error('titre')
                                            <span class="text-danger small"> {{ $message }} </span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <div class="alert alert-info small">
                                            <b>Attention:</b> Les images doivent être au format PNG,WEBP, JPEG ou JPG et  1920x381 pour les autres page que l'accueil.
                                        </div>
                                        <label for="">Position de l'image</label>
                                        <select name="type" class="form-control" id="type" required onchange="add_reuired()">
                                            <option value=""></option>
                                            <option @selected(old('type') == "banner") value="banner">Accueil</option>
                                            <option @selected(old('type') == "shop") value="shop">Shop</option>
                                            <option @selected(old('type') == "contact") value="contact">contact</option>
                                            <option @selected(old('type') == "cart") value="cart">Panier</option>
                                            <option @selected(old('type') == "checkout") value="checkout">Paiement</option>
                                            <option @selected(old('type') == "login") value="login">Page de connexion</option>
                                            <option @selected(old('type') == "favoris") value="favoris">Favoris</option>
                                            <option @selected(old('type') == "produit") value="produit">Paiement</option>
                                            <option @selected(old('type') == "profile") value="profile">Compte client</option>
                                            <option @selected(old('type') == "reset") value="reset">Page de mot de passe oublier</option>
                                        </select>
                                        @error('type')
                                            <span class="text-danger small"> {{ $message }} </span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="">Image</label>
                                        <input type="file" name="photo" required class="form-control">
                                        @error('photo')
                                            <span class="text-danger small"> {{ $message }} </span>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-sm btn-dark">
                                        Ajouter une bannière
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <script>
            function add_reuired(){
                var type = document.getElementById('type').value;
                if(type == 'banner'){
                    document.getElementById('titre').setAttribute('required', true);
                }else{
                    document.getElementById('titre').removeAttribute('required');
                }
            }
        </script>

    @endsection
