<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Obra Social / prepagas') }}
        </h2>
    </x-slot>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
  @endif
  @if (session('success'))
    <div class="alert alert-success">
       {{ session('success') }}
    </div>
  @endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg"> 
                <div class="p-6 text-gray-900">
                  <header class="mb-3">
                    <h2 class="text-lg font-medium text-gray-900">
                      {{ __('Registrar obra social o prepaga.') }}
                    </h2>
                    <p class="mt-1 text-sm text-gray-600">
                      {{ __("Ingrese la información correctamente, serán mostradas al público.") }}
                    </p>
                  </header>
                  <form action="{{ route('obraSocial.store')}}" method="post">  
                    <div class="input-group mb-3">
                        @csrf
                          <div class="input-group mb-3">
                            <input type="text" name="nombre_obraSocial" id="nombre_obraSocial" required class="form-control rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" placeholder="Nombre" aria-label="Nombre">
                          </div>

                        
                          <div class="input-group mb-3">
                            <input type="number" name="precio_obraSocial" id="precio_obraSocial" class="form-control rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" placeholder="Monto" aria-label="Monto">
                          </div>

                          <div class="input-group mb-3">
                            <span class="input-group-text">Información adicional</span>
                            <textarea class="form-control" name="info_obraSocial" id="info_obraSocial" aria-label="info_obraSocial"></textarea>
                         </div>
                                                  
                          <x-success-button>{{ __('Guardar') }}</x-success-button>
                          <x-primary-a href="{{ route('obraSocial.index') }}">{{ __('Volver') }}</x-primary-a>

                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
