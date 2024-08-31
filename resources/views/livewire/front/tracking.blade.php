<div>
    @if ($commande)
    <div class="card">
        <div class="text-center p-3 c">
            <img width="50" height="50" src="https://img.icons8.com/ios-filled/50/fbab01/starred-ticket.png" alt="starred-ticket"/>
            <br>
            La commande N° {{ $commande->id }} a été trouvée. <br>
            <b>STATUT ACTUEL : </b> {{ $commande->statut }}
            <br>
            <hr>
            <a href="{{ route('print_commande2',['token'=> $commande->token]) }}" class="btn btn-sm btn-outline-black">
                <i class="fa fa-download" aria-hidden="true"></i>
                Télécharger la facture
            </a>
        </div>
    </div>
    @else
        <form wire:submit='track'>
            <label class="form-label">Id de la commande</label>
            <div class="input-group ">
                <input type="text"
                    class="form-control rounded-0 bg-transparent input-h me-2  @error('id_commande') is-invalid @enderror"
                    required wire:model='id_commande' name="order" value=""
                    placeholder="Cherche par N° de commande">
            </div>
            @error('id_commande')
                <span class="small text-danger">
                    {{ $message }}
                </span>
            @enderror
            <x-AlertFront></x-AlertFront>
            <button class="btn btn-fashion mt-3" type="submit">
                <x-Loading></x-Loading>
                Suivre ici
            </button>
        </form>
    @endif
</div>
