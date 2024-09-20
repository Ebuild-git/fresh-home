<form wire:submit='update'>
    <fieldset>
        <legend>
            {{ __('changement_2') }}
        </legend>
        <p class="alert alert-info">
            {{ __('infos_2') }}
        </p>
        <div class="row learts-mb-n30">
            <div class="col-12 learts-mb-30">
                <label for="current-pwd">
                    {{ __('password') }}
                    <abbr class="required">*</abbr>
                </label>
                <input type="password" id="current-pwd" wire:model='current_pwd' required>
                @error('current_pwd')
                    <span class="invalid-feedback">
                        {{ $message }}
                    </span>
                @enderror
            </div>
            <div class="col-12 col-sm-6 learts-mb-30">
                <label for="new-pwd">
                    {{ __('new_password') }}
                    <abbr class="required">*</abbr>
                </label>
                <input type="password" id="new-pwd" wire:model='password' required>
                @error('password')
                    <span class="invalid-feedback">
                        {{ $message }}
                    </span>
                @enderror
            </div>
            <div class="col-12 col-sm-6 learts-mb-30">
                <label for="confirm-pwd">
                    {{ __('confirm_password') }} <abbr class="required">*</abbr>
                </label>
                <input type="password" id="confirm-pwd" wire:model='password_confirmation' required>
                @error('password_confirmation')
                    <span class="invalid-feedback">
                        {{ $message }}
                    </span>
                @enderror
            </div>
            <div class="col-12  learts-mb-30">
                <x-AlertFront></x-AlertFront>

                <button class="btn btn-dark btn-outline-hover-dark" type="submit">
                    <x-Loading></x-Loading>
                    Modifier le mot de passe
                </button>
            </div>
        </div>
    </fieldset>
</form>
