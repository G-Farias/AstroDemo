<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Paciente') }}
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

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg"> 
                <div class="p-6 text-gray-900">

                  <form action="{{ route('pacientes.update', $patient) }}" method="post">  
                    <div class="input-group mb-3">
                        @csrf
                        @method('PUT')
                          <div class="input-group mb-3">
                            <input type="text" name="nombre" id="nombre" value="{{ $patient->nombre }}" required class="form-control rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" placeholder="Nombre" aria-label="Nombre">
                            <input type="text" name="apellido" id="apellido" value="{{ $patient->apellido }}" required class="form-control rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" placeholder="Apellido" aria-label="Apellido">
                          </div>

                        
                          <div class="input-group mb-3">
                            <input type="number" name="dni" id="dni" value="{{ $patient->dni }}" required class="form-control rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" placeholder="DNI" aria-label="Dni">
                            <span class="input-group-text" id="basic-addon1">Fecha de nacimiento</span>
                            <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" value="{{ $patient->fecha_nacimiento }}" class="form-control rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" placeholder="Fecha de nacimiento" aria-label="FechaNacimiento">
                          </div>

                          <div class="input-group mb-3">
                            <input type="number" name="celular" id="celular" value="{{ $patient->celular }}" class="form-control rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" placeholder="Celular" aria-label="celular">
                            <input type="number" name="telefono" id="telefono" value="{{ $patient->telefono }}" class="form-control rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" placeholder="Teléfono" aria-label="Telefono">
                          </div>

                          <div class="input-group mb-3">
                          <input type="mail" name="email" id="email" value="{{ $patient->email }}" class="form-control rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" placeholder="Email" aria-label="Email">
                          </div>
                          
                          <div class="input-group mb-3">
                            <select name="obraSocial" id="obraSocial" value="{{ $patient->obraSocial }}"  class="form-control rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                              <option value="0" selected disabled>Obra social</option>
                              <option value="a">IOMA</option>
                              <option value="a">PAMI</option>
                            </select>
                            <input type="text" name="numero_obraSocial" id="numero_obraSocial" value="{{ $patient->numero_obraSocial }}" class="form-control rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" placeholder="Número obra social" aria-label="NumeroObraSocial">                        
                          </div>

                          <div class="input-group mb-3">
                            <input type="text" name="direccion" id="direccion" value="{{ $patient->direccion }}" class="form-control rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" placeholder="Dirección" aria-label="Direccion">
                          </div>

                          <div class="input-group mb-3">
                            <select name="pais" id="pais" value="{{ $patient->pais_residencia }}"  class="form-control rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                              <option value="0" disabled>País</option>
                              <option value="Argentina" selected>Argentina</option>
                            </select>
                            <input type="text" name="provincia_residencia" id="provincia_residencia" value="{{ $patient->provincia_residencia }}" class="form-control rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" placeholder="Provincia" aria-label="Provincia">
                            <input type="text" name="localidad_residencia" id="localidad_residencia" value="{{ $patient->localidad_residencia }}" class="form-control rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" placeholder="Localidad" aria-label="Localidad">
                          </div>
                          
                          <div class="input-group mb-3">
                             <span class="input-group-text">Observación</span>
                             <textarea class="form-control" name="observacion" id="observacion" aria-label="observacion">{{ $patient->observacion }}</textarea>
                          </div>
                        
                          <x-success-button>{{ __('Actualizar datos') }}</x-success-button>
                          <x-primary-a href="{{ route('pacientes.index') }}">{{ __('Volver') }}</x-primary-a>

                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
