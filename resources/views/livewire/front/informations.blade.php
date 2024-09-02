<fieldset>
    <legend>Changement de informations</legend>
    <p class="alert alert-info">
        Les informations saisies ne seront pas enregistrées tant que vous ne cliquez pas sur "mettre a jour". Vous
        pourrez les
        modifier à tout moment.
    </p>
    <form wire:submit='update'>
        <div class="row learts-mb-n30">
            <div class="col-md-6 col-12 learts-mb-30">
                <div class="single-input-item">
                    <label for="nom">Nom <abbr class="required">*</abbr></label>
                    <input type="text" id="nom" wire:model='nom'>
                    @error('nom')
                        <span class="invalid-feedback">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
            </div>
            <div class="col-md-6 col-12 learts-mb-30">
                <div class="single-input-item">
                    <label for="prenom">Prénom<abbr class="required">*</abbr></label>
                    <input type="text" id="prenom" wire:model='prenom'>
                    @error('prenom')
                        <span class="invalid-feedback">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
            </div>
            <div class="col-md-6 col-12 learts-mb-30">
                <div class="single-input-item">
                    <label for="telphone">Téléphone<abbr class="required">*</abbr></label>
                    <input type="text" id="telphone" wire:model="telephone">
                    @error('telephone')
                        <span class="invalid-feedback">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
            </div>
            <div class="col-12 col-md-6 learts-mb-30">
                <label for="email">Email <abbr class="required">*</abbr></label>
                <input type="email" id="email" wire:model='email'>
                @error('email')
                    <span class="invalid-feedback">
                        {{ $message }}
                    </span>
                @enderror
            </div>
            <div class="col-12 col-md-12 learts-mb-30">
                <label for="adresse">Adresse <abbr class="required">*</abbr></label>
                <input type="text" id="adresse" wire:model='adresse'>
                @error('adresse')
                    <span class="invalid-feedback">
                        {{ $message }}
                    </span>
                @enderror
            </div>
            <div class="col-12 learts-mb-30">
                <x-AlertFront></x-AlertFront>

                <button class="btn btn-dark btn-outline-hover-dark" type="submit">
                    <x-Loading></x-Loading>
                    mettre a jour
                </button>
            </div>
        </div>
    </form>
</fieldset>