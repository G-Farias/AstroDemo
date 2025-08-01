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
    
        @if($specialty->count() < 1)
        <div class="alert alert-danger">
           {{'¡ALERTA! No se encuentra ninguna especialidad registrada, recomendamos primero crear especialidades para poder asignarle al especialista.'}}
       </div>
        @endif
      
  
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg"> 
                <div class="p-6 text-gray-900">

                  <form action="{{ route('especialistas.store')}}" method="post">  
                    <div class="input-group mb-3">
                        @csrf
                        <header class="mb-3">
                          <h2 class="text-lg font-medium text-gray-900">
                            {{ __('Registrar especialista') }}
                          </h2>
                          <p class="mt-1 text-sm text-gray-600">
                            {{ __("Ingrese la información del paciente.") }}
                          </p>
                        </header>
                          <div class="input-group mb-3">
                            <input type="text" name="nombre" id="nombre" required class="form-control rounded-l border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" placeholder="Nombre" aria-label="Nombre">
                            <input type="text" name="apellido" id="apellido" required class="form-control rounded-r border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" placeholder="Apellido" aria-label="Apellido">
                          </div>

                        
                          <div class="input-group mb-3">
                            <input type="number" name="dni" id="dni" required class="form-control rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" placeholder="DNI" aria-label="Dni">
                          </div>

                          <div class="input-group mb-3">
                            <input type="number" name="celular" id="celular" class="form-control rounded-l border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" placeholder="Celular" aria-label="celular">
                            <input type="number" name="telefono" id="telefono" class="form-control rounded-r border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" placeholder="Teléfono" aria-label="Telefono">
                          </div>

                          <p class="mb-2 text-sm text-gray-600">
                            {{ __("El email y la contraseña se utilizará para que el especialista pueda acceder.") }}
                          </p>
                          <div class="input-group mb-3">
                           <input type="mail" required name="email" id="email" class="form-control rounded-l border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" placeholder="Email" aria-label="Email">
                           <input type="password" required name="password" id="password" class="form-control rounded-r border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" placeholder="Contraseña" aria-label="contraseña">                        
                           <x-primary-a type="button" onclick="mostrarContrasena()">Ver contraseña</x-primary-a>
                        </div>
                      
                        <script>
                          function mostrarContrasena(){
                              var tipo = document.getElementById("password");
                              if(tipo.type == "password"){
                                  tipo.type = "text";
                              }else{
                                  tipo.type = "password";
                              }
                          }
                        </script>

                          <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Especialidad</span>
                            <select class="form-control" required id="especialidad" name="especialidad" class="form-control rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                                  @foreach ($specialty as $specialty)
                                      <option selected value="{{$specialty->id}}">
                                          {{ucfirst($specialty->nombre_especialidad)}}
                                      </option>
                                  @endforeach
                              </select>
                          </div>

                          <div class="input-group mb-3">
                            <input type="text" name="matricula" id="matricula" class="form-control rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" placeholder="Matricula" aria-label="matricula">
                          </div>

                          <p class="mb-2 text-sm text-gray-600">
                            {{ __("La información del día y horario de atención será mostrada al publico, procura que esté correcta.") }} 
                            <br> {{__('En el horario de atención se recomienda agregar la abreviatura hs, ejemplo: 11hs a 13hs y 17hs a 20hs')}}
                          </p> 
                          <div class="input-group mb-3">
                            <input type="text" required name="dia_atencion" id="dia_atencion" class="form-control rounded-l border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" placeholder="Día de atención" aria-label="dia">
                            <input type="text" required name="hr_atencion" id="dia_atencion" class="form-control rounded-r border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" placeholder="Horario de atención" aria-label="horarioAtencion">
                          </div>

                          <div class="input-group mb-3">
                           <!-- <input type="text" name="provincia_residencia" id="provincia_residencia" class="form-control rounded-l border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" placeholder="Provincia" aria-label="Provincia"> -->
                          <select name="provincia_residencia" id="provincia_residencia"  class="form-control rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" required>
                              <option value="0" disabled selected>Provincia</option>
                                <option value="Buenos Aires">Buenos Aires</option>
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
                          
                            <input type="text" name="localidad_residencia" id="localidad_residencia" class="form-control rounded-r border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" placeholder="Localidad" aria-label="Localidad">
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
