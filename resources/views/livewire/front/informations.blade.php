<fieldset>
    <legend>
        {{ __('changement_1') }}
    </legend>
    <p class="alert alert-info">
        {{ __('infos_1') }}
    </p>
    <form wire:submit='update'>
        <div class="row learts-mb-n30">
            <div class="col-md-6 col-12 learts-mb-30">
                <div class="single-input-item">
                    <label for="nom">{{ __('nom') }} <abbr class="required">*</abbr></label>
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
                    <label for="prenom">{{ __('prenom') }}<abbr class="required">*</abbr></label>
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
                    <label for="telphone">{{ __('telephone') }}<abbr class="required">*</abbr></label>
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
            <div class="col-12 col-md-6 learts-mb-30">
                <label for="adresse">{{ __('adresse') }} <abbr class="required">*</abbr></label>
                <input type="text" id="adresse" wire:model='adresse'>
                @error('adresse')
                    <span class="invalid-feedback">
                        {{ $message }}
                    </span>
                @enderror
            </div>
            <div class="col-12 col-md-6 learts-mb-30">
                <label for="adresse">{{ __('gouvernorat') }} <abbr class="required">*</abbr></label>
                <select id="id_gouvernorat" wire:model='id_gouvernorat' class="form-control-select-x">
                    <option value=""></option>
                    @foreach ($gouvernorats as $item)
                        <option value="{{ $item->id }}">
                            {{ $item->nom }}
                        </option>
                    @endforeach
                </select>
                @error('id_gouvernorat')
                    <span class="invalid-feedback">
                        {{ $message }}
                    </span>
                @enderror
            </div>
            <div class="col-12 learts-mb-30">
                <x-AlertFront></x-AlertFront>

                <button class="btn btn-dark btn-outline-hover-dark" type="submit">
                    <x-Loading></x-Loading>
                    {{ __('update') }}
                </button>
            </div>
        </div>
    </form>
   
</fieldset>
