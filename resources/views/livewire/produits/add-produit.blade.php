<div>

    @include('components.alert')

    @if ($produit)
        <form wire:submit="update_produit">
        @else
            <form wire:submit="create">
    @endif

    <div class="row">
        <div class="col-sm-8">
            <div class="row">
                <div class="col-sm-8 mb-3">
                    <label for="">Nom du produit</label>
                    <input type="text" name="nom" class="form-control" wire:model="nom">
                    @error('nom')
                        <span class="text-danger small"> {{ $message }} </span>
                    @enderror
                </div>
                <div class="col-sm-4 mb-3">
                    <label for="">Frais inclu</label>
                    <div class="form-control">
                        <input type="checkbox" name="frais_inclu" wire:model="frais_inclu" @checked($frais_inclu)
                            class="form-check-input">
                        Frais inclu dans le prix
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label for="">Description du produit</label>
                <textarea name="description" wire:model="description" class="form-control" rows="10"></textarea>
                @error('description')
                    <span class="text-danger small"> {{ $message }} </span>
                @enderror
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label for="">Prix de vente</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    TN
                                </span>
                            </div>
                            <input type="number" step="0.1" name="prix" class="form-control" wire:model="prix">
                        </div>
                        @error('prix')
                            <span class="text-danger small"> {{ $message }} </span>
                        @enderror
                        @error('prix_fr')
                            <span class="text-danger small"> {{ $message }} </span>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label for="">Prix d'achat</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    TN
                                </span>
                            </div>
                            <input type="number" step="0.1" name="prix_achat" class="form-control"
                                wire:model="prix_achat">
                        </div>
                        @error('prix_achat')
                            <span class="text-danger small"> {{ $message }} </span>
                        @enderror
                        @error('prix_achat_fr')
                        <span class="text-danger small"> {{ $message }} </span>
                    @enderror
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label for="">Référence du produit</label>
                        <input type="text" step="0.1" name="reference" class="form-control"
                            wire:model="reference">
                        @error('reference')
                            <span class="text-danger small"> {{ $message }} </span>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label for="">Categorie</label>
                        <select wire:model="id_categorie" class="form-control">
                            <option value=""></option>
                            @foreach ($categories as $item)
                                <option value="{{ $item->id }}">
                                    {{ $item->nom }}
                                </option>
                            @endforeach
                        </select>
                        <div class="small d-flex justify-content-end">
                            <a href="{{ route('categories') }}">
                                Ajouter une catégorie
                            </a>
                        </div>
                        @error('id_categorie')
                            <span class="text-danger small"> {{ $message }} </span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="mb-3">
                <label for="">Photo d'illustration</label>
                <div class="preview-produit-illustration" onclick="preview_illustration('new-prosduit')">
                    @if ($produit)
                        @if ($photo2 && is_null($photo))
                            <img src="{{ $photo2 }}" alt="" class="w-100">
                        @else
                            <img src="{{ $photo->temporaryUrl() }}" alt="" srcset="">
                        @endif
                    @else
                        @if ($photo)
                            <img src="{{ $photo->temporaryUrl() }}" alt="" class="w-100">
                        @else
                            <img src="/icons/no-image.webp" alt="" class="w-100">
                        @endif
                    @endif
                </div>
                <input type="file" name="photo" accept="image/*" class=" d-none" id="file-input-new-prosduit"
                    wire:model="photo">
                @error('photo')
                    <span class="text-danger small"> {{ $message }} </span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="">Autres photos</label>
                <input type="file" multiple name="photos" accept="image/*" class="form-control"
                    wire:model="photos">
                @error('photos')
                    <span class="text-danger small"> {{ $message }} </span>
                @enderror
            </div>

            @if ($produit)
                <div class="card-offre-add">
                    <div class="d-flex justify-content-between">
                        <b>
                            Offre exeptionnel sur quantité
                        </b>
                    </div>
                    <br>
                    <div>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Quantité" wire:model="new_qte"
                                aria-label="Quantité">
                            <span class="input-group-text">U.</span>
                            <input type="number" step="0.1" class="form-control" placeholder="Prix"
                                aria-label="Prix" wire:model="new_prix">
                            <span class="input-group-text">
                                <x-devise></x-devise> / U.
                            </span>
                            <button class="btn btn-sm btn-dark" type="button" wire:click="AddPrix">
                                Ajouter
                            </button>
                        </div>
                        <div class="small text-danger">
                            @error('new_qte')
                                <div>
                                    {{ $message }}
                                </div>
                            @enderror
                            @error('new_prix')
                                <div>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        @if (session()->has('add-error'))
                            <div class="alert alert-danger">
                                {{ session('add-error') }}
                            </div>
                        @endif
                        @if (session()->has('add-success'))
                            <div class="alert alert-success">
                                {{ session('add-success') }}
                            </div>
                        @endif

                        <hr>
                        <table class="table">
                            <tbody>
                                @foreach ($produit->autres_prix as $prix)
                                    <tr>
                                        <td>
                                            -> {{ $prix->quantite }} U.
                                        </td>
                                        <td>
                                            {{ $prix->prix }} <x-devise></x-devise>
                                        </td>
                                        <td class="text-end">
                                            <button class="btn btn-sm btn-danger" type="button"
                                                wire:click="removePrix({{ $prix->id }})">
                                                Supprimer
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif


        </div>
    </div>
    <div style="text-align: right;" class="mt-5">
        <button class="btn btn-primary btn-sm px-5" type="submit" wire:loading.attr="disabled">
            <span wire:loading>
                <img src="https://i.gifer.com/ZKZg.gif" height="15" alt="" srcset="">
            </span>
            @if ($produit)
                Mettre a jour
            @else
                Enregistrer le produit
            @endif
        </button>
    </div>
    </form>
</div>
