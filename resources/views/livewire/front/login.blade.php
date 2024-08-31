<div>
    <form class="my-3" wire:submit="login">
        <x-AlertFront></x-AlertFront>
        <div class="form-group">
            <label for="email" class="form-label">Email<span class="text-danger">
                    *
                </span></label>
            <input type="email" class="form-control input-h rounded-0" name="email" wire:model='email'
                placeholder="eemplet@gmail.com" id="email" required>
            @error('email')
                <span class="text-danger small">
                    {{ $message }}
                </span>
            @enderror
        </div>
        <div class="form-group mt-3">
            <label for="password" class="form-label">
                Mot de passe
                <span class="text-danger">
                    *
                </span></label>
            <input type="password" class="form-control input-h rounded-0" name="password" wire:model='password'
                placeholder="***************" id="password" required>
            @error('password')
                <span class="text-danger small">
                    {{ $message }}
                </span>
            @enderror
        </div>
        <div class="text-end">
            <a href="{{ route('forgotpassword') }}" class="text-muted fs-7 fw-500">
                <i class="fa-solid fa-lock-keyhole mx-2 fs-7"></i>Mot
                de passe oublié
                ?
            </a>
        </div>
        <button class="btn btn-dark btn-outline-hover-dark" type="submit"> 
            <x-Loading></x-Loading>
            Connexion
        </button>
    </form>

</div>
