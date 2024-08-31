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
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($banners as $banner)
                                            <tr>
                                                <td>{{ $banner->id }}</td>
                                                <td>{{ $banner->titre }}</td>
                                                <td>
                                                    <img src="{{ Storage::url($banner->photo)}}" width="40 " height="40 " class="rounded shadow" alt="">
                                                </td>
                                                <td class="text-end">
                                                    <form action="{{ route('banners.destroy', $banner->id) }}" method="post" onsubmit="return confirm('��tes-vous s��r de vouloir supprimer cette bannière?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger">
                                                            Supprimer
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4">
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
                                        <input type="text" name="titre" class="form-control">
                                        @error('titre')
                                            <span class="text-danger small"> {{ $message }} </span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="">Image</label>
                                        <input type="file" name="photo" class="form-control">
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

    @endsection
