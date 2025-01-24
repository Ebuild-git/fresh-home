<div>
    <div class="row">
        <div class="col-sm-8">
            <table id="basic-datatable" class="table table-striped dt-responsive nowrap w-100">
                <thead class="table-dark">
                    <tr>
                        <th></th>
                        <th>Product</th>
                        <th>Prix</th>
                        <th>Qty</th>
                        <th>Sub-Total</th>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($commande->contenus as $contenu)
                        <tr>
                            <td>
                                <img src="{{ Storage::url($contenu->produit->photo) }}" width="40 " height="40 "
                                    class="rounded shadow" alt="">

                            </td>
                            <td>
                                {{ $contenu->produit->nom }}
                            </td>
                            <td>
                                {{ $contenu->prix_unitaire }} DT
                            </td>
                            <td>
                                @if ($commande->statut != 'retournée' && $commande->statut != 'payée')
                                    <div class="input-group mb-3" style="width: 120px !important">
                                        <button class="btn btn-outline-secondary" type="button"
                                            wire:click="change( {{ $contenu->id }}  , {{ $contenu->quantite - 1 }} ,'up')">-</button>
                                        <input type="text" readonly value="{{ $contenu->quantite }}"
                                            class="form-control">
                                        <button class="btn btn-outline-secondary" type="button"
                                            wire:click="change( {{ $contenu->id }}  , {{ $contenu->quantite + 1 }} ,'down')">+</button>
                                    </div>
                                @else
                                    {{ $contenu->quantite }}
                                @endif

                            </td>
                            <td>
                                {{ $contenu->quantite * $contenu->prix_unitaire }} DT
                            </td>
                            <td>
                                <button class="btn btn-sm btn-danger" type="button"
                                    wire:click="delete( {{ $contenu->id }})">
                                    X
                                </button>
                            </td>
                        </tr>
                    @endforeach
                    <tr>
                        <td>
                            <img width="30" height="30"
                                src="https://img.icons8.com/ios/30/40C057/delivery--v1.png" alt="delivery--v1" />
                        </td>
                        <td> <b>Frais de livraison</b> </td>
                        <td> {{ $commande->frais ?? 0}} DT </td>
                        <td> 1 </td>
                        <td> {{ $commande->frais ?? 0}} DT </td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-sm-4">
            <h6>
                Informations du client.
            </h6>
            <br>
            @include('components.alert')
            <form wire:submit="update_user_info">
                <div class="row mb-3">
                    <div class="col">
                        <label for="">Nom *</label>
                        <input type="text" placeholder="Nom du client" required wire:model="nom"
                            class="form-control">
                        @error('nom')
                            <span class="small text-danger" role="alert"> {{ $message }} </span>
                        @enderror
                    </div>
                    <div class="col">
                        <label for="">prenom</label>
                        <input type="text" placeholder="preom du client" wire:model="prenom" class="form-control">
                        @error('prenom')
                            <span class="small text-danger" role="alert"> {{ $message }} </span>
                        @enderror
                    </div>
                </div>
                <div class="mb-3">
                    <label for="">Adresse *</label>
                    <input type="text" placeholder="Adresse du client" required wire:model="adresse"
                        class="form-control">
                    @error('adresse')
                        <span class="small text-danger" role="alert"> {{ $message }} </span>
                    @enderror
                </div>
                <div class="row">
                    <div class="col">
                        <label for="">Numéro de téléphone *</label>
                        <input type="tel" placeholder="Numéro de téléphone du client" wire:model="phone"
                            class="form-control">
                        @error('phone')
                            <span class="small text-danger" role="alert"> {{ $message }} </span>
                        @enderror
                    </div>
                    <div class="col">
                        <label for="">Gouvernorat *</label>
                        <select wire:model="id_gouvernorat" class="form-control" required>
                            <option value="">Gouvernorat</option>
                            @foreach ($gouvernoratsTunisie as $gouvernorat)
                                <option value="{{ $gouvernorat->id }}">
                                    {{ $gouvernorat->nom }}
                                </option>
                            @endforeach
                        </select>
                        @error('gouvernorat')
                            <span class="small text-danger" role="alert"> {{ $message }} </span>
                        @enderror
                    </div>
                </div>
                <div class="mt-3 mb-1">
                    <div class="mb-1">
                        <input type="checkbox" class="form-check-input" @checked($commande->frais > 0) wire:model="frais">
                        Appliquer les frais de livraison . <b> ( + {{ $config->getFrais() }} <x-devise></x-devise> )</b>
                        @error('frais')
                            <br> <span class="small text-danger" role="alert"> {{ $message }} </span>
                        @enderror
                    </div>
                    <div class="mb-1">
                        <input type="checkbox" class="form-check-input" @checked($commande->tva > 0) wire:model="tva">
                        Appliquer les frais de tva  <b>( + {{ $config->getTva() }} <x-devise></x-devise> )</b> 
                        @error('tva')
                            <br> <span class="small text-danger" role="alert"> {{ $message }} </span>
                        @enderror
                    </div>
                    <div class="mb-1">
                        <input type="checkbox" class="form-check-input" @checked($commande->timbre > 0) wire:model="timbre">
                        Appliquer les frais de timbre. <b>( + {{ $config->getTimbre() }} <x-devise></x-devise> )</b> 
                        @error('timbre')
                            <br> <span class="small text-danger" role="alert"> {{ $message }} </span>
                        @enderror
                    </div>
                    <div class="alert alert-info mt-2">
                        <label for="">Ajouter une remise</label>
                        <div class="input-group">
                            <input type="number" wire:model="remise" placeholder="Montant en pourcentage" min="0" max="100" step="0.01" class="form-control">
                            <div class="input-group-text">%</div>
                            <button class="btn btn-sm btn-primary" type="button" wire:click="appliquerRemise">
                                <i class="ri-check-line"></i>
                                Appliquer
                            </button>
                            @if ($remise_appliquee)
                                <button class="btn btn-sm btn-danger" type="button" wire:click="annulerRemise">
                                    <i class="ri-close-line"></i>
                                    Annuler
                                </button>
                            @endif
                        </div>
                        @error('remise')
                            <span class="small text-danger" role="alert"> {{ $message }} </span>
                        @enderror
                    </div>
                </div>
                <br>
                <hr>
                <div class="d-flex justify-content-between">
                    <div>
                        <button type="submit" class="btn btn-primary btn-sm">
                            <span wire:loading>
                                <img src="https://i.gifer.com/ZKZg.gif" height="15" alt="" srcset="">
                            </span>
                            <i class="ri-check-double-line"></i>
                            Enregistrer les modifications
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
