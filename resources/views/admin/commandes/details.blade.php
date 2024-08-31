@section('titre', 'Détails de la commande')
@extends('admin.fixe')

@section('body')
    <div class="page-content-wrapper">
        <div class="page-content">

            <!-- start page title -->
            <div class="row mb-3">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb ">
                                <li class="breadcrumb-item">
                                    <a href="javascript: void(0);">{{ config('app.name') }}</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="{{ route('commandes') }}">Commandes</a>
                                </li>
                                <li class="breadcrumb-item active">Commande #{{ $commande->id }}</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->


            <div class="card radius-15">
                <div class="card-body">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h5 class="header-title">
                                    <span class="badge bg-dark cusor" title="Canal de vente">
                                        <i class="ri-bookmark-3-fill"></i>
                                        {{ $commande->canal_vente }}
                                    </span>
                                    <span class="text-capitalize">
                                        {{ $commande->nom }}
                                    </span>
                                </h5>
                            </div>
                            <div>
                                <button class="btn btn-primary btn-sm" type="button"
                                    onclick="url('{{ route('print_commande', ['id' => $commande->id]) }}')">
                                    <i class="ri-printer-line"></i>
                                    Imprimer la facture
                                </button>
                            </div>
                        </div>
                        <br>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-8 table-responsive-sm">
                                <div>
                                    @if ($commande->Auteur)
                                        <p>
                                            Cette commande a été créé par : <b>{{ $commande->Auteur->nom }}</b>
                                        </p>
                                    @endif
                                </div>
                                <table id="basic-datatable" class="table table-striped dt-responsive nowrap w-100">
                                    <thead class="table-dark">
                                        <tr>
                                            <th></th>
                                            <th>Product</th>
                                            <th>Type</th>
                                            <th>Prix</th>
                                            <th>Qty</th>
                                            <th>Sub-Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($commande->contenus as $contenu)
                                            <tr>
                                                <td style="width: 50px;">
                                                    @if ($contenu->type == 'produit')
                                                        <img src="{{ $contenu->produit->FirstImage() }}" width="40 "
                                                            height="40 " class="rounded shadow" alt="photo">
                                                    @else
                                                        <img src="{{ $contenu->pack->photo() }}" width="40"
                                                            height="40" class="rounded shadow" alt="photo">
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($contenu->type == 'produit')
                                                        {{ $contenu->produit->nom }}
                                                    @else
                                                        {{ $contenu->pack->nom }}
                                                    @endif
                                                </td>
                                                <td>
                                                    <b class="text-capitalize">
                                                        {{ $contenu->type }}
                                                    </b>
                                                </td>
                                                <td>
                                                    {{ $contenu->prix_unitaire }} DT
                                                </td>
                                                <td>
                                                    {{ $contenu->quantite }}
                                                </td>
                                                <td>
                                                    {{ $contenu->quantite * $contenu->prix_unitaire }} DT
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>
                            <div class="col-sm-4 text-capitalize">
                                <div class="card p-2">

                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h6 class="card-title mb-3">
                                                <b>Résumé de la commande </b>
                                            </h6>
                                            <b>Montant total :</b>
                                            <b>{{ $commande->montant() }} {{ $commande->devise }}</b>
                                            @if ($commande->frais > 0) <br>
                                                <b>Frais de livraison : </b> {{ $commande->frais ?? 0 }}
                                                @if ($commande->devise == 'dinar')
                                                    DT
                                                @else
                                                    €
                                                @endif
                                                <br>
                                            @endif
                                            <b>Date : </b> {{ $commande->created_at }} <br>
                                            <b>TVA :</b> {{ $commande->tva }} {{ $commande->devise }} <br>
                                            <b>Timbre </b> {{ $commande->timbre }} {{ $commande->devise }} <br>
                                            <b>Canal de vente : </b> {{ $commande->canal_vente }}
                                        </div>
                                        <div class="text-center">
                                            {!! QrCode::size(70)->generate(route('print_commande', ['id' => $commande->id])) !!}
                                        </div>
                                    </div>


                                    <hr>
                                    <h6 class="card-title mt-3">
                                        <b>Informations du client</b>
                                    </h6>
                                    Nom : {{ $commande->nom }} <br>
                                    Phone : {{ $commande->phone }} <br>
                                    Adresse : {{ $commande->adresse }} <br>
                                    Gouvernorat : {{ $commande->gouvernorat->nom }}
                                    <hr>
                                    <h6 class="card-title mt-3">
                                        <b>Notes</b>
                                    </h6>
                                    <div>
                                        @if ($commande->note)
                                            {{ $commande->note }}
                                        @else
                                            <i class="text-muted">
                                                <i class="ri-information-line"></i>
                                                Aucune note disponible pour cette commande.
                                            </i>
                                        @endif
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div> <!-- end card body-->
                </div> <!-- end card -->
            </div><!-- end col-->
        </div> <!-- end row-->


    </div>
@endsection
