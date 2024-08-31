@section('titre', 'à-propos')
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
                                <li class="breadcrumb-item active">à-propos</li>
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
                        <div>
                            @include('components.alert')


                            <form method="POST" action="{{ route('config-about.post') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="text-center bg-primary card my-auto p-1 mb-3">
                                    <h6 class="text-white">
                                        Images de Vidéos
                                    </h6>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 col-12">
                                        <div class="mb-3">
                                            <label for="">
                                                Couverture de la page
                                            </label>
                                            <input type="file" name="about_cover" accept="image/*" class="form-control">
                                            @error('about_cover')
                                                <span class="text-danger small"> {{ $message }} </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-12">
                                        <div class="mb-3">
                                            <label for="">
                                                Image principal
                                            </label>
                                            <input type="file" name="about_image" accept="image/*" class="form-control">
                                            @error('about_image')
                                                <span class="text-danger small"> {{ $message }} </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-12">
                                        <div class="mb-3">
                                            <label for="">
                                                Image de couverture de la vidéo
                                            </label>
                                            <input type="file" name="about_cover_video" accept="image/*" class="form-control">
                                            @error('about_cover_video')
                                                <span class="text-danger small"> {{ $message }} </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-12">
                                        <div class="mb-3">
                                            <label for="">
                                                Vidéo
                                            </label>
                                            <input type="file" name="about_video" accept="video/*"
                                                class="form-control">
                                            @error('about_video')
                                                <span class="text-danger small"> {{ $message }} </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>




                                <div class="text-center bg-primary card my-auto p-1 mb-3">
                                    <h6 class="text-white">
                                        Texte et description
                                    </h6>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-12">
                                        <div class="mb-3">
                                            <label for="">
                                                Titre 
                                            </label>
                                            <input type="text" name="about_titre"
                                                value="{{ old('about_titre', $config->about_titre) }}" class="form-control">
                                            @error('about_titre')
                                                <span class="text-danger small"> {{ $message }} </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-12">
                                        <div class="mb-3">
                                            <label for="">
                                                Description
                                            </label>
                                                <textarea name="about_description" class="form-control" rows="10">{{ old('about_description', $config->about_description) }}
                                                </textarea>
                                            @error('about_description')
                                                <span class="text-danger small"> {{ $message }} </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="modal-footer">
                                    <button class="btn btn-primary btn-sm" type="submit">
                                        <i class="ri-save-line me-1 fs-16 lh-1"></i>
                                        Enregistrer les changements
                                    </button>
                                </div>
                            </form>

                        </div>

                    </div>
                </div>
            </div>
        </div>

    @endsection
