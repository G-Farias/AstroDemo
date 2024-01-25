<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Especialistas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg"> 
                <div class="p-6 text-gray-900">

                  <form action="{{ route('especialistas.store')}}" method="post">  
                    <div class="input-group mb-3">
                        @csrf
                          <div class="input-group mb-3">
                            <input type="text" name="nombre" id="nombre" required class="form-control rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" placeholder="Nombre" aria-label="Nombre">
                            <input type="text" name="apellido" id="apellido" required class="form-control rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" placeholder="Apellido" aria-label="Apellido">
                          </div>

                        
                          <div class="input-group mb-3">
                            <input type="number" name="dni" id="dni" required class="form-control rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" placeholder="DNI" aria-label="Dni">
                          </div>

                          <div class="input-group mb-3">
                            <input type="number" name="celular" id="celular" class="form-control rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" placeholder="Celular" aria-label="celular">
                            <input type="number" name="telefono" id="telefono" class="form-control rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" placeholder="Teléfono" aria-label="Telefono">
                          </div>

                          <div class="input-group mb-3">
                           <input type="mail" name="email" id="email" class="form-control rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" placeholder="Email" aria-label="Email">
                           <input type="password" name="password" id="password" class="form-control rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" placeholder="Contraseña" aria-label="contraseña">                        

                          </div>
                          
                          <div class="input-group mb-3">
                            <select name="especialidad" id="especialidad"  class="form-control rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                              <option value="0" selected disabled>Especialidad</option>
                              <option value="1">Trauma</option>
                              <option value="2">Clinico</option>
                            </select>
                          </div>

                          <div class="input-group mb-3">
                            <input type="text" name="matricula" id="matricula" class="form-control rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" placeholder="Matricula" aria-label="matricula">
                          </div>

                          <div class="input-group mb-3">
                            <input type="text" name="dia_atencion" id="dia_atencion" class="form-control rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" placeholder="Día de atención" aria-label="dia">
                            <input type="text" name="hr_atencion" id="dia_atencion" class="form-control rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" placeholder="Horario de atención" aria-label="horarioAtencion">
                          </div>

                          <div class="input-group mb-3">
                            <input type="text" name="provincia_residencia" id="provincia_residencia" class="form-control rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" placeholder="Provincia" aria-label="Provincia">
                            <input type="text" name="localidad_residencia" id="localidad_residencia" class="form-control rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" placeholder="Localidad" aria-label="Localidad">
                          </div>
                                                  
                          <x-success-button>{{ __('Guardar') }}</x-success-button>
                          <x-primary-a href="{{ route('especialistas.index') }}">{{ __('Volver') }}</x-primary-a>

                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
