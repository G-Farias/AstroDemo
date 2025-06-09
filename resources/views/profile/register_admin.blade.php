<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<x-app-layout>
    <x-slot name="header">
     @can('isAdmin')
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Perfil administrativo') }}
        </h2>
        @elsecan('isPatient')
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Perfil') }}
        </h2>
     @endcan
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                        <section>
                            <header>
                                <h2 class="text-lg font-medium text-gray-900">
                                    {{ __('Registrar usuario administrativo') }}
                                </h2>

                                <p class="mt-1 text-sm text-gray-600">
                                    {{ __("Recuerde que el perfil administrativo tiene acceso total al sistema.") }}
                                </p>
                            </header>

                            <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                                @csrf
                            </form>

                            <form method="post" action="{{ route('admin.store') }}" class="mt-6 space-y-6">
                                @csrf

                                <div>
                                    <x-input-label for="name" :value="__('Nombre')" />
                                    <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"  required autofocus autocomplete="name" />
                                    <x-input-error class="mt-2" :messages="$errors->get('name')" />
                                </div>

                                <div>
                                    <x-input-label for="surname" :value="__('Apellido')" />
                                    <x-text-input id="surname" name="surname" type="text" class="mt-1 block w-full"  required autofocus autocomplete="surname" />
                                    <x-input-error class="mt-2" :messages="$errors->get('surname')" />
                                </div>

                                <div>
                                    <x-input-label for="user" :value="__('D.N.I/Pasaporte')" />
                                    <x-text-input  id="user" name="user" type="text" class="mt-1 block w-full" required autofocus autocomplete="surname" />
                                    <x-input-error class="mt-2" :messages="$errors->get('user')" />
                                </div>

                                <div>
                                    <x-input-label for="email" :value="__('Email')" />
                                    <x-text-input id="email" name="email" type="email" class="mt-1 block w-full"  required autocomplete="username" />
                                    <x-input-error class="mt-2" :messages="$errors->get('email')" />

                                    @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                                        <div>
                                            <p class="text-sm mt-2 text-gray-800">
                                                {{ __('Tu email no está verificado.') }}

                                                <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                    {{ __('Click aqui para reenviar la notificación de confirmación.') }}
                                                </button>
                                            </p>

                                            @if (session('status') === 'verification-link-sent')
                                                <p class="mt-2 font-medium text-sm text-green-600">
                                                    {{ __('Un nuevo link de verificación fu enviado.') }}
                                                </p>
                                            @endif
                                        </div>
                                    @endif
                                     <div>
                                         <x-input-label for="password" :value="__('Contraseña')" />
                                        <x-text-input  id="password" name="password" type="password" class="mt-1 block w-full" required autofocus autocomplete="password" />
                                        <x-input-error class="mt-2" :messages="$errors->get('password')" />
                                     </div>
                                </div>

                                <div class="flex items-center gap-4">
                                    <x-primary-button>{{ __('Guardar') }}</x-primary-button>
                                </div>
                            </form>
                        </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
