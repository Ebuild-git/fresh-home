<div>
    @if (!$end)
        <form class="my-3" wire:submit='forget'>
            <x-AlertFront></x-AlertFront>
            <div class="form-group">
                <label for="email" class="form-label">Email<span class="text-danger"> * </span></label>
                <input type="email" class="form-control input-h rounded-0" wire:model='email' name="email"
                    placeholder="Email" id="email" required>
                @error('email')
                    <span class="text-danger small">
                        {{ $message }}
                    </span>
                @enderror
            </div>

            <button class="btn btn-fashion w-100 mt-4" type="submit">
                <x-Loading></x-Loading>
                Soumettre
            </button>
        </form>
    @else
        <div class="card p-2">
            <div class="text-center">
                <img src="/icons/icons8-verrouiller-2-64.png" alt="icon" height="80" srcset="">
                <h5 class="text-success">
                    Votre demande de réinitialisation de mot de passe a été envoyée.
                </h5>
                <p class="text-muted">
                    Veuillez vérifier votre boîte de réception ou votre courrier électronique pour suivre les
                    instructions de réinitialisation.
                </p>
            </div>
        </div>
    @endif
</div>
