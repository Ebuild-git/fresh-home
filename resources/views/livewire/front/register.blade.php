<div>
    <form class="my-3" wire:submit='register'>
        <x-AlertFront></x-AlertFront>
        <div class="row">
            <div class="form-group">
                <label for="name" class="form-label">Nom<span class="text-danger"> * </span></label>
                <input type="text" class="form-control input-h rounded-0" name="name" wire:model='nom' id="name"
                    placeholder="Nom" required>
                @error('nom')
                    <span class="text-danger small">
                        {{ $message }}
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="email" class="form-label">Email<span class="text-danger"> * </span></label>
                <input type="email" class="form-control input-h rounded-0" name="email" wire:model='email'
                    id="email" placeholder="Email" required>
                @error('email')
                    <span class="text-danger small">
                        {{ $message }}
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="mobile" class="form-label">Mobile<span class="text-danger"> * </span></label>
                <input type="number" class="form-control input-h rounded-0" name="mobile" wire:model='telephone'
                    id="mobile" placeholder="Mobile" required>
                @error('telephone')
                    <span class="text-danger small">
                        {{ $message }}
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="password" class="form-label">Mot de passe<span class="text-danger"> * </span></label>
                <input type="password" class="form-control input-h rounded-0" name="password" wire:model='password'
                    id="password" placeholder="Mot de passe" required>
                @error('password')
                    <span class="text-danger small">
                        {{ $message }}
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <input class="form-check-input" type="checkbox" wire:model='' required id="flexCheckChecked">
                <label class="form-check-label" for="flexCheckChecked">J'accepte la
                    <a href="termscondition" class="text-primary fw-semibold">Terms &amp; Conditions</a>
                </label>
            </div>
        </div>
        <button class="btn btn-fashion w-100 mt-4" type="submit">
            <x-Loading></x-Loading>
            Enregistrer
        </button>
        <p class="fs-7 text-center mt-3">
            Vous avez déjà un compte ?
            <a href="login" class="text-primary fw-semibold">Connexion</a>
        </p>
    </form>
</div>
