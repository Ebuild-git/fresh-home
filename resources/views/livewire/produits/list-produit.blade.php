<div>

    <form wire:submit="filtrer">
        <div class="row">
            <div class="col-sm-6">
                <span>
                    <b>{{ $produits->count() }}</b> Résultats sur {{ $total }}.
                </span>
            </div>
            <div class="col-sm-6">
                <div class="input-group mb-3">
                    <select wire:model="id_categorie" name="id_categorie" class="form-control btn-sm">
                        <option value="">Catégorie</option>
                        @foreach ($categories as $item)
                            <option value="{{ $item->id }}">
                                {{ $item->nom }}
                            </option>
                        @endforeach
                    </select>
                    <input type="text" class="form-control btn-sm" wire:model="key"
                        placeholder="Titre,Description des articles">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">
                            Filtrer
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>


    @include('components.alert')

    <div class="table-responsive-sm">
        <table id="basic-datatable" class="table table-striped dt-responsive nowrap w-100">
            <thead class="table-dark cusor">
                <tr>
                    <th>Photo</th>
                    <th>Nom</th>
                    <th>Catégorie</th>
                    <th>Stock</th>
                    <th>Prix vente</th>
                    <th>Prix achat</th>
                    <th>Ventes</th>
                    <th>Meilleur</th>
                    <th>création</th>
                    <th style="text-align: right;">
                        <span wire:loading>
                            <img src="https://i.gifer.com/ZKZg.gif" width="20" height="20" class="rounded shadow"
                                alt="">
                        </span>
                    </th>
                </tr>
            </thead>


            <tbody>
                @forelse ($produits as $produit)
                    <tr>
                        <td>
                            <img src="{{ $produit->FirstImage() }}" width="40 " height="40 "
                                class="rounded shadow" alt="">
                        </td>
                        <td>
                            <button class="btn btn-sm btn-outline" data-bs-toggle="modal"
                                data-bs-target="#qr-code-{{ $produit->id }}">
                                <i class="ri-qr-code-line"></i>
                            </button>
                            @if ($produit->frais_inclu)
                            <i class="ri-money-dollar-circle-line text-success" title="Frais Ajouté !"></i>
                            @endif
                            {{ Str::limit($produit->nom ,30) }}
                        </td>
                        <td>
                            <span class="small badge bg-success text-white">
                                {{ $produit->categorie->nom }}
                            </span>
                        </td>
                        <td class="cusor">
                            <b onclick="url('{{ route('produits.historique', ['id' => $produit->id]) }}')">
                                {{ $produit->stock }} U.
                            </b>
                        </td>
                        <td>
                            @if ($produit->inPromotion())
                                <span class=" small">
                                    - {{ $produit->inPromotion->pourcentage }} %
                                </span>
                                <b class="text-success">
                                    {{ $produit->getPrice() }} <x-devise></x-devise>
                                </b>
                                <br>
                                <strike>
                                    <span class="text-danger small">
                                        {{ $produit->prix }} <x-devise></x-devise>
                                    </span>
                                </strike>
                            @else
                                {{ $produit->getPrice() }} <x-devise></x-devise>
                            @endif

                        </td>
                        <td>{{ $produit->prix_achat }} DT</td>
                        <td>
                            <i class="ri-wallet-2-line vert"></i>
                            {{ $produit->vendus->count() }}
                        </td>
                        <td>
                            <div class="form-check form-switch">
                                <input class="form-check-input"
                                type="checkbox"
                                id="flexSwitchCheckChecked-{{ $produit->id }}"
                                wire:click="toggleBestSell({{ $produit->id }})"
                                @checked($produit->best_sell)>
                            </div>
                        </td>
                        <td>{{ $produit->created_at->format('d/m/Y') }} </td>
                        <td style="text-align: right;">
                            <div class="btn-group">
                                <button class="btn btn-sm btn-dark"
                                    onclick="url(' {{ route('produits.update', ['id' => $produit->id]) }} ')">
                                    <i class="ri-edit-box-line"></i>
                                </button>
                                @can('product_edit')
                                    <button class="btn btn-sm btn-warning" title="Promotion"
                                        onclick="url('{{ route('promotions_produit', ['id' => $produit->id]) }}')">
                                        <i class="ri-discount-percent-fill"></i>
                                    </button>
                                @endcan
                                @can('product_delete')
                                    <button class="btn btn-sm btn-danger"
                                        onclick="toggle_confirmation({{ $produit->id }})">
                                        <i class="ri-delete-bin-6-line"></i>
                                    </button>
                                @endcan
                            </div>

                            <!-- Center modal content -->
                            <div class="modal fade" id="qr-code-{{ $produit->id }}" tabindex="-1" role="dialog"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h6 class="modal-title" id="myCenterModalLabel">
                                                Accès rapide au produit
                                            </h6>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <table class="table" style="text-align: left;">
                                                <tr>
                                                    <td>Prix d'acaht :</td>
                                                    <td>{{ $produit->prix_achat }} <x-devise></x-devise></td>
                                                </tr> <tr>
                                                    <td>Catégories :</td>
                                                    <td>
                                                        @if ($produit->categorie)
                                                             {{ $produit->categorie->nom  }}
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Bénéfce / produit :</td>
                                                    <td> {{ $produit->prix - $produit->prix_achat }}
                                                        <x-devise></x-devise>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Réference :</td>
                                                    <td>
                                                        {{ $produit->reference }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Stock : </td>
                                                    <td class="d-flex justify-content-between">
                                                        <span>
                                                            {{ $produit->stock }} U.
                                                        </span>
                                                        <b class="cusor"
                                                            onclick="url('{{ route('produits.historique', ['id' => $produit->id]) }}')">
                                                            <i class="ri-history-fill"></i>
                                                            Historique
                                                        </b>
                                                    </td>
                                                </tr>
                                            </table>
                                            <br>
                                            <div class="text-center p-2">
                                                {{-- {!! QrCode::size(100)->generate(route('produit2', ['id' => $produit->id])) !!} --}}
                                            </div>
                                        </div>
                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
                            </div><!-- /.modal -->

                            <button class="btn btn-sm btn-success d-none" type="button"
                                id="confirmBtn{{ $produit->id }}" wire:click="delete({{ $produit->id }})">
                                <i class="bi bi-check-circle"></i>
                                <span class="hide-tablete">
                                    Confirmer
                                </span>
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10" class="text-center">
                            <div>
                                <img src="/icons/icons8-ticket-100.png" height="100" width="100" alt=""
                                    srcset="">
                            </div>
                            Aucun produit trouvé
                        </td>
                    </tr>
                @endforelse

            </tbody>


        </table>
    </div>
    {{ $produits->links('pagination::bootstrap-4') }}

    @role('admin')
        <div class="text-end p-2">
            <a href="{{ route('corbeille') }}" class="text-danger">
                <i class="ri-delete-bin-line"></i>
                Corbeile ( {{ $total_supprimers }} )
            </a>
        </div>
    @endrole

</div>
