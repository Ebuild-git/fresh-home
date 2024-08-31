<div>

    <form wire:submit="filtrer">
        <div class="row">
            <div class="col-sm-6">
                <span>
                    <b>{{ $clients->count() }}</b> Résultats sur {{ $total }}.
                </span>
            </div>
            <div class="col-sm-6">
                <div class="input-group mb-3">
                    <input type="text" class="form-control btn-sm" wire:model="key" placeholder="Nom, email, phone">
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
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Adresse</th>
                    <th>Pays</th>
                    <th>Gouvernorat</th>
                    <th>Inscription</th>
                    <th style="text-align: right;">
                        <span wire:loading>
                            <img src="https://i.gifer.com/ZKZg.gif" width="20" height="20" class="rounded shadow"
                                alt="">
                        </span>
                    </th>
                </tr>
            </thead>


            <tbody>
                @forelse ($clients as $client)
                    <tr>
                        <td>
                            {{ $client->nom }}
                        </td>
                        <td>
                            {{ $client->email }}
                        </td>
                        <td>
                            {{ $client->phone }}
                        </td>
                        <td>
                            {{ $client->adresse }}
                        </td>
                        <td>
                            {{ $client->pays }}
                        </td>
                        <td>
                            {{ $client->gouvernorat }}
                        </td>
                        <td>{{ $client->created_at }} </td>
                        <td style="text-align: right;">
                            @can('clients_view')
                                <div class="btn-group">
                                    <button class="btn btn-sm btn-danger"
                                        onclick="toggle_confirmation({{ $client->id }})">
                                        <i class="ri-delete-bin-6-line"></i>
                                    </button>
                                </div>
                                <button class="btn btn-sm btn-success d-none" type="button"
                                    id="confirmBtn{{ $client->id }}" wire:click="delete({{ $client->id }})">
                                    <i class="bi bi-check-circle"></i>
                                    <span class="hide-tablete">
                                        Confirmer
                                    </span>
                                </button>
                            @endcan
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">
                            Aucun client trouvé
                        </td>
                    </tr>
                @endforelse

            </tbody>



        </table>
    </div>
    {{ $clients->links('pagination::bootstrap-4') }}
    <br>
    @if ($clients->count() > 0)
        <div>
            <button class="btn btn-sm btn-danger" wire:click="delete_client">
                Supprimer tous les clients
            </button>
            @if ($deleted_confirmed)
                <div class="alert alert-warning mt-2">
                    <p>
                        Pour éviter tout problème lié à la suppression de tous les clients et des commandes, le système
                        se
                        chargera d'effectuer une suppression silencieuse des données tout en rendant les adresses e-mail
                        disponibles pour une nouvelle création de compte.
                    </p>
                    <div class="text-end">
                        <button class="btn btn-sm btn-success" wire:click="delete_all_client">
                            Confirmer la suppression
                        </button>
                    </div>
                </div>
            @endif
        </div>
    @endif


</div>
