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


                            <form id="upload-form" enctype="multipart/form-data">
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
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-12">
                                        <div class="mb-3">
                                            <label for="">
                                                Image principal
                                            </label>
                                            <input type="file" name="about_image" accept="image/*" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-12">
                                        <div class="mb-3">
                                            <label for="">
                                                Image de couverture de la vidéo
                                            </label>
                                            <input type="file" name="about_cover_video" accept="image/*"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-12">
                                        <div class="mb-3">
                                            <label for="">
                                                Vidéo
                                            </label>
                                            <input type="file" name="about_video" accept="video/*" class="form-control">
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
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-12">
                                        <div class="mb-3">
                                            <label for="">
                                                Description
                                            </label>
                                            <textarea name="about_description" class="form-control" rows="10">{{ old('about_description', $config->about_description) }}
                                                </textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="text-center bg-dark card my-auto p-1 mb-3">
                                    <h6 class="text-white">
                                        Footer
                                    </h6>
                                </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-12">
                                <div class="mb-3">
                                    <label for="">
                                        Phrase a afficher dans le footer
                                    </label>
                                    <input type="text" name="footer_text"
                                        value="{{ old('footer_text', $config->footer_text) }}" class="form-control">
                                    @error('footer_text')
                                        <span class="text-danger small"> {{ $message }} </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="progress">
                            <div id="progress-bar" class="progress-bar">0%</div>
                        </div>
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


    <script>
        $(document).ready(function() {
            $('#upload-form').on('submit', function(e) {
                e.preventDefault(); // Prevent default form submission

                var formData = new FormData(this);

                $.ajax({
                    xhr: function() {
                        var xhr = new XMLHttpRequest();
                        xhr.upload.addEventListener('progress', function(e) {
                            if (e.lengthComputable) {
                                var percentComplete = Math.round((e.loaded / e.total) *
                                    100);
                                $('#progress-bar').width(percentComplete + '%');
                                $('#progress-bar').text(percentComplete + '%');
                            }
                        }, false);
                        return xhr;
                    },
                    url: '{{ route('config-about.post') }}', // Change this to your route
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.status) {
                            Swal.fire({
                                title: "Félicitation",
                                text: response.message,
                                icon: "success"
                            });
                        } else {
                            Swal.fire({
                                title: "Echec !",
                                text: response.message,
                                icon: "error"
                            });
                        }
                    },
                    error: function(xhr) {
                        // Afficher les erreurs
                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;
                            $.each(errors, function(key, value) {
                                let input = $('[name="' + key + '"]');
                                input.addClass("is-invalid");
                                let errorDiv = $(
                                    '<div class="invalid-feedback"></div>'
                                ).text(value[0]);
                                input.after(errorDiv);
                            });
                        } else {
                            $("#error-messages").html(
                                "<p>Une erreur inattendue est survenue.</p>"
                            );
                        }
                    },
                });
            });




        });
    </script>
@endsection
