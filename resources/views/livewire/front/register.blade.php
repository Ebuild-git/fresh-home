<div>
    <form class="my-3" wire:submit='register'>
        <x-AlertFront></x-AlertFront>
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label for="name" class="form-label">Nom<span class="text-danger"> * </span></label>
                    <input type="text" class="form-control input-h rounded-0" name="name" wire:model='nom'
                        id="name" placeholder="Nom" required>
                    @error('nom')
                        <span class="text-danger small">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="name" class="form-label">Prénom<span class="text-danger"> * </span></label>
                    <input type="text" class="form-control input-h rounded-0" name="name" wire:model='prenom'
                        id="name" placeholder="prénom"  >
                    @error('prenom')
                        <span class="text-danger small">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
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
        </div>
        <br>
        <p>
            Vos données personnelles seront utilisées pour soutenir votre expérience sur ce site Web, pour gérer l'accès
            à votre compte et à d'autres fins décrites dans notre politique de confidentialité.
        </p>
        <button class="btn btn-fashion w-100 mt-4" type="submit">
            <x-Loading></x-Loading>
            Enregistrer
        </button>
    </form>
</div>
