<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <a href="{{route("welcome")}}"><h1 style="font-size: 50px">Petfy</h1></a>
        </x-slot>
        <x-jet-authentication-card-logo />
        <x-jet-validation-errors class="mb-4" />



        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div>
                <x-jet-label for="name" value="{{ __('Nombre') }}" />
                <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>

            <div class="mt-2">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>
            <div class="mt-2">
                <x-jet-label for="user_role_id" value="{{ __('Tipo de usuario') }}" />
                <select class="form-control" name="user_role_id" id="user_role_id">
                    @foreach(\App\Models\UserRol::query()->orderBy("id", "desc")->get() as $rol)
                        <option value="{{ $rol->id }}">{{ $rol->role_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mt-2">
                <x-jet-label for="nif" value="{{ __('NIF') }}" />
                <x-jet-input id="nif" class="block mt-1 w-full" type="text" name="nif" :value="old('nif')" required />
            </div>

            <div class="mt-2">
                <x-jet-label for="direccion" value="{{ __('Direccion') }}" />
                <x-jet-input id="direccion" class="block mt-1 w-full" type="text" name="direccion" :value="old('direccion')" required />
            </div>

            <div class="mt-2">
                <label class="block font-medium text-sm text-gray-700" for="password">Contraseña. <span class="pass_caracteres">Mínimo 8 caracteres</span></label>
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-2">
                <x-jet-label for="password_confirmation" value="{{ __('Confirmar contraseña') }}" />
                <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>


            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('¿Ya estás registrado?') }}
                </a>

                <x-jet-button class="ml-4">
                    {{ __('Registrarse') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
