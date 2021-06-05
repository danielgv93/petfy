<x-jet-form-section submit="updateProfileInformation">
    <x-slot name="title">
        {{ __('Información del perfil') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Actualiza la información y dirección de correo de tu perfil de usuario.') }}
    </x-slot>

    <x-slot name="form">
        <!-- Profile Photo -->
        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
            <div x-data="{photoName: null, photoPreview: null}" class="col-span-6 sm:col-span-4">
                <!-- Profile Photo File Input -->
                <input type="file" class="hidden"
                       wire:model="photo"
                       x-ref="photo"
                       x-on:change="
                                    photoName = $refs.photo.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        photoPreview = e.target.result;
                                    };
                                    reader.readAsDataURL($refs.photo.files[0]);
                            "/>

                <x-jet-label for="photo" value="{{ __('Foto de perfil') }}"/>

                <!-- Current Profile Photo -->
                <div class="mt-2" x-show="! photoPreview">
                    <img src="{{ \Illuminate\Support\Facades\Auth::user()->profile_photo_url }}"
                         alt="{{ $this->user->name }}" class="rounded-full h-20 w-20 object-cover">
                </div>

                <!-- New Profile Photo Preview -->
                <div class="mt-2" x-show="photoPreview">
                    <span class="block rounded-full w-20 h-20"
                          x-bind:style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' + photoPreview + '\');'">
                    </span>
                </div>

                <x-jet-secondary-button class="mt-2 mr-2" type="button" x-on:click.prevent="$refs.photo.click()">
                    {{ __('Elige una nueva foto de perfil') }}
                </x-jet-secondary-button>

                @if ($this->user->profile_photo_path)
                    <x-jet-secondary-button type="button" class="mt-2" wire:click="deleteProfilePhoto">
                        {{ __('Eliminar imagen de perfil') }}
                    </x-jet-secondary-button>
                @endif

                <x-jet-input-error for="photo" class="mt-2"/>
            </div>
        @endif

    <!-- Name -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="name" value="{{ __('Nombre') }}"/>
            <x-jet-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="state.name"
                         autocomplete="name"/>
            <x-jet-input-error for="name" class="mt-2"/>
        </div>

        <!-- NIF -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="nif" value="{{ __('NIF') }}"/>
            <x-jet-input id="nif" type="text" class="mt-1 block w-full" wire:model.defer="state.nif"/>
            <x-jet-input-error for="nif" class="mt-2"/>
        </div>

        <!-- Email -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="email" value="{{ __('Email') }}"/>
            <x-jet-input id="email" type="email" class="mt-1 block w-full" wire:model.defer="state.email"/>
            <x-jet-input-error for="email" class="mt-2"/>
        </div>

        <!-- Direccion -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="direccion" value="{{ __('Dirección') }}"/>
            <x-jet-input id="direccion" type="text" class="mt-1 block w-full" wire:model.defer="state.direccion"/>
            <x-jet-input-error for="direccion" class="mt-2"/>
        </div>

        <!-- Ciudad -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="ciudad" value="{{ __('Ciudad') }}"/>
            <x-jet-input id="ciudad" type="text" class="mt-1 block w-full" wire:model.defer="state.ciudad"/>
            <x-jet-input-error for="ciudad" class="mt-2"/>
        </div>

        <!-- Sobre mi -->
        @if (auth()->user()->rol->id == 2)
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="sobre_mi" value="{{ __('Descripción sobre mi') }}"/>
                <textarea class="form-control" name="sobre_mi" id="sobre_mi" rows="3" wire:model.defer="state.sobre_mi"></textarea>
                <x-jet-input-error for="sobre_mi" class="mt-2"/>
            </div>
        @endif

        @if (auth()->user()->rol->id == 1)
        <!-- Geolocalizacion -->
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="latitud" value="{{ __('Latitud') }}"/>
                <x-jet-input id="latitud" type="text" class="mt-1 block w-full" wire:model.defer="state.latitud"/>
                <x-jet-input-error for="latitud" class="mt-2"/>
            </div>
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="longitud" value="{{ __('Longitud') }}"/>
                <x-jet-input id="longitud" type="text" class="mt-1 block w-full" wire:model.defer="state.longitud"/>
                <x-jet-input-error for="longitud" class="mt-2"/>
            </div>
        <!-- Direccion Donacion -->
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="direccion_donacion" value="{{ __('Direccion de Paypal para donaciones') }}"/>
                <x-jet-input id="direccion_donacion" type="text" class="mt-1 block w-full" wire:model.defer="state.direccion_donacion"/>
                <x-jet-input-error for="direccion_donacion" class="mt-2"/>
            </div>
        @endif

    </x-slot>

    <x-slot name="actions">
        <x-jet-action-message class="mr-3" on="saved">
            {{ __('Guardado.') }}
        </x-jet-action-message>

        <x-jet-button wire:loading.attr="disabled" wire:target="photo">
            {{ __('Guardar') }}
        </x-jet-button>
    </x-slot>
</x-jet-form-section>
