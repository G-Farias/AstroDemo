<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>


<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col d-grid gap-2 d-md-flex ">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Especialistas') }}
                </h2>
            </div>            
            <div class="col-3 d-grid gap-2 d-md-flex justify-content-md-end">
                <x-success-a href="{{ route('especialistas.index') }}">{{ __('Volver') }}</x-success-a>
            </div>
        </div>
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
                    {{ __('Información del perfil') }}
                  </h2>
                  <p class="mt-1 text-sm text-gray-600">
                    {{ __("Actualiza la información personal.") }}
                  </p>
                  </header>
                  <form action="{{ route('especialistas.update' ,$specialist )}}" method="post">  
                    <div class="input-group mb-3">
                        @csrf
                        @method('PUT')
                          <div class="input-group mb-3">
                            <input type="text" value="{{ ucfirst($specialist->nombre) }}" name="nombre" id="nombre" required class="form-control rounded-l border-gray-300  shadow-sm focus:ring-indigo-500" placeholder="Nombre" aria-label="Nombre">
                            <input type="text" value="{{ ucfirst($specialist->apellido) }}" name="apellido" id="apellido" required class="form-control rounded-r border-gray-300  shadow-sm focus:ring-indigo-500" placeholder="Apellido" aria-label="Apellido">
                          </div>

                        
                          <div class="input-group mb-3">
                            <span class="input-group-text">D.N.I</span>
                            <input required type="number" value="{{ $specialist->dni }}" name="dni" id="dni" class="form-control rounded-r border-gray-300  shadow-sm focus:ring-indigo-500" placeholder="DNI" aria-label="Dni">
                          </div>

                          <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Celular</span>
                            <input type="number" value="{{ $specialist->celular }}" name="celular" id="celular" class="form-control rounded-r border-gray-300  shadow-sm focus:ring-indigo-500" placeholder="Celular" aria-label="celular">
                            <span class="input-group-text" id="basic-addon1">Teléfono</span>
                            <input type="number" value="{{ $specialist->telefono }}" name="telefono" id="telefono" class="form-control rounded-r border-gray-300  shadow-sm focus:ring-indigo-500" placeholder="Teléfono" aria-label="Telefono">
                          </div>

                          <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Email</span>
                           <input type="mail" required value="{{ $user->email }}" name="email" id="email" class="form-control rounded-l border-gray-300  shadow-sm focus:ring-indigo-500" placeholder="Email" aria-label="Email">
                          </div>
                          


                          <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Especialidad</span>
                            <select class="form-control" required id="especialidad" name="especialidad" class="form-control rounded border-gray-300  shadow-sm focus:ring-indigo-500">
                              <option selected value="{{ $specialist->especialidad }}">{{ ucfirst($specialist->specialty->nombre_especialidad) }}</option>
                                  @foreach ($specialty as $specialty)
                                      <option value="{{$specialty->id}}">
                                          {{ucfirst($specialty->nombre_especialidad)}}
                                      </option>
                                  @endforeach
                              </select>
                          </div>

                          <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Matricula</span>
                            <input type="text"  value="{{ $specialist->matricula }}" name="matricula" id="matricula" class="form-control rounded-r border-gray-300  shadow-sm focus:ring-indigo-500" placeholder="Matricula" aria-label="matricula">
                          </div>

                          <p class="mb-3 text-sm text-gray-600">
                            {{ __("La información del día y horario de atención será mostrada al publico, procura que esté correcta.") }}
                          </p>
                          <div class="input-group mb-3">
                            <input type="text" required value="{{ $specialist->dia_atencion }}" name="dia_atencion" id="dia_atencion" class="form-control rounded-l border-gray-300  shadow-sm focus:ring-indigo-500" placeholder="Día de atención" aria-label="dia">
                            <input type="text" required value="{{ $specialist->hr_atencion }}" name="hr_atencion" id="dia_atencion" class="form-control rounded-r border-gray-300  shadow-sm focus:ring-indigo-500" placeholder="Horario de atención" aria-label="horarioAtencion">
                          </div>

                          <div class="input-group mb-3">
                           <!-- <input type="text" value="" name="provincia_residencia" id="provincia_residencia" class="form-control rounded-l border-gray-300  shadow-sm focus:ring-indigo-500" placeholder="Provincia" aria-label="Provincia"> -->
                            <select name="provincia_residencia" id="provincia_residencia"  class="form-control rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" required> 
                              <option value="0" disabled selected>{{ ucfirst($specialist->provincia_residencia) }}</option>
                                <option value="Buenos Aires" >Buenos Aires</option>
                                <option value="Catamarca">Catamarca</option>
                                <option value="Chaco">Chaco</option>
                                <option value="Chubut">Chubut</option>
                                <option value="Ciudad Autónoma de Buenos Aires">Ciudad Autónoma de Buenos Aires</option>
                                <option value="Córdoba">Córdoba</option>
                                <option value="Corrientes">Corrientes</option>
                                <option value="Entre Ríos">Entre Ríos</option>
                                <option value="Formosa">Formosa</option>
                                <option value="Jujuy">Jujuy</option>
                                <option value="La Pampa">La Pampa</option>
                                <option value="La Rioja">La Rioja</option>
                                <option value="Mendoza">Mendoza</option>
                                <option value="Misiones">Misiones</option>
                                <option value="Neuquén">Neuquén</option>
                                <option value="Río Negro">Río Negro</option>
                                <option value="Salta">Salta</option>
                                <option value="San Juan">San Juan</option>
                                <option value="San Luis">San Luis</option>
                                <option value="Santa Cruz">Santa Cruz</option>
                                <option value="Santa Fe">Santa Fe</option>
                                <option value="Santiago del Estero">Santiago del Estero</option>
                                <option value="Tierra del Fuego">Tierra del Fuego</option>
                                <option value="Tucumán">Tucumán</option>
                              </select>
                           
                           
                            <input type="text" value="{{ ucfirst($specialist->localidad_residencia) }}" name="localidad_residencia" id="localidad_residencia" class="form-control rounded-r border-gray-300  shadow-sm focus:ring-indigo-500" placeholder="Localidad" aria-label="Localidad">
                          </div>
                                           
                          <div class="col d-grid gap-2 d-md-flex justify-content-md-end mt-3">
                            <x-success-button disabled>{{ __('Guardar') }}</x-success-button>
                          </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
