<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col d-grid gap-2 d-md-flex ">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Agregar turnos de atención') }}
                </h2>
            </div>            
            <div class="col-3 d-grid gap-2 d-md-flex justify-content-md-end">
                <x-success-a href="{{ route('especialistas.index') }}">{{ __('Volver') }}</x-success-a>
            </div>
        </div>
    </x-slot>

    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    @if (session('danger'))
    <div class="alert alert-danger">
          {{ session('danger') }}
    </div>
@endif
  <!--  <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg"> 
                <div class="p-6 text-gray-900">
                    <header class="mb-3">
                        <h2 class="text-lg font-medium text-gray-900">
                          {{ __('Registrar turno de atención') }}
                        </h2>
                        <p class="mb-2 text-sm text-gray-600">
                          {{ __("Seleccione el día, horario de atención y el intervalo de cada turno.") }}
                        </p>
                        <p class="text-sm text-gray-600">
                            {{$specialist->nombre}} {{$specialist->apellido}} </br>
                            {{$specialist->dia_atencion}} </br> {{$specialist->hr_atencion}}
                        </p>
                      </header>
                <form action="{{ route('especialistas.store_horario_atencion')}}" method="post">  
                @csrf
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Fecha de atención</span>
                    <input type="date" required name="date" id="date" class="form-control rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                </div>

                <div class="input-group mb-3">
                    <input type="text" hidden value="{{ $specialist->id }}" name="specialist" id="specialist">
                    <input type="text" hidden value="{{ $specialist->especialidad }}" name="specialty" id="specialty">

                    <span class="input-group-text" id="basic-addon1">Horario inicio turno mañana</span>
                    <input type="time"  name="inicio_turno_mañana" id="inicio_turno_mañana" class="form-control rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" placeholder="Contraseña" aria-label="contraseña">                        
                    <span class="input-group-text" id="basic-addon1">Horario finalización turno mañana</span>
                    <input type="time"  name="fin_turno_mañana" id="fin_turno_mañana" class="form-control rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" placeholder="Contraseña" aria-label="contraseña">                        
                </div>
                    <p class="card-text text-muted mb-2">*Si posee horario de corrido,
                         ignore completar el turno tarde
                    </p>
                <div class="input-group mb-3">
        
                    <span class="input-group-text" id="basic-addon1">Horario inicio turno tarde</span>
                    <input type="time" name="inicio_turno_tarde" id="inicio_turno_tarde" class="form-control rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" placeholder="Contraseña" aria-label="contraseña">                        
                    <span class="input-group-text" id="basic-addon1">Horario finalización turno tarde</span>
                    <input type="time"  name="fin_turno_tarde" id="fin_turno_tarde" class="form-control rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" placeholder="Contraseña" aria-label="contraseña">                        
               </div>

                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Seleccione un intervalo de turnos</span>
                    <select class="form-control" id="intervalo" name="intervalo" class="form-control rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                        <option selected value="15">15 minutos</option>
                        <option value="30">30 minutos</option>
                        <option value="45">45 minutos</option>
                        <option value="60">60 minutos</option>
                        <option value="75">1:15hr</option>
                        <option value="90">1:30hr</option>
                        <option value="105">1:45hr</option>
                        <option value="120">2hr</option>
                      </select>
                </div>

                    <div class="col d-grid gap-2 d-md-flex justify-content-md-end mt-3">
                        <x-success-button>{{ __('Guardar') }}</x-success-button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>

-->
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg"> 
                <div class="p-6 text-gray-900">
                    <header class="mb-3">
                        <h2 class="text-lg font-medium text-gray-900">
                          {{ __('Registrar turno de atención') }}
                        </h2>
                        <p class="mb-2 text-sm text-gray-600">
                          {{ __("Seleccione el día, horario de atención y el intervalo de cada turno.") }}
                        </p>                    
                        <p class="text-sm text-gray-600">
                            {{$specialist->nombre}} {{$specialist->apellido}} </br>
                            {{$specialist->dia_atencion}} </br> {{$specialist->hr_atencion}}
                        </p>
                      </header>
                <form action="{{ route('especialistas.store_horario_atencion')}}" method="post">  
                @csrf

                <!-- Selección de días -->
                <div class="mb-3">
                        <h2 class="text-lg font-medium text-gray-900">
                          {{ __('Días de la semana') }}
                        </h2>
                        <p class="mb-3 text-sm text-gray-600">
                          {{ __("Seleccione los días para crear los turnos y a continuación el intervalo de días.") }}
                        </p>
                    <div class="flex flex-wrap gap-2 inline-flex items-center">
                        <label><input class="peer h-5 w-5 cursor-pointer transition-all appearance-none rounded shadow hover:shadow-md border border-slate-600 checked:bg-slate-800 checked:border-slate-800" type="checkbox" name="dias[]" value="1">Lunes</label>
                        <label><input class="peer h-5 w-5 cursor-pointer transition-all appearance-none rounded shadow hover:shadow-md border border-slate-600 checked:bg-slate-800 checked:border-slate-800" type="checkbox" name="dias[]" value="2"> Martes</label>
                        <label><input class="peer h-5 w-5 cursor-pointer transition-all appearance-none rounded shadow hover:shadow-md border border-slate-600 checked:bg-slate-800 checked:border-slate-800" type="checkbox" name="dias[]" value="3"> Miércoles</label>
                        <label><input class="peer h-5 w-5 cursor-pointer transition-all appearance-none rounded shadow hover:shadow-md border border-slate-600 checked:bg-slate-800 checked:border-slate-800" type="checkbox" name="dias[]" value="4"> Jueves</label>
                        <label><input class="peer h-5 w-5 cursor-pointer transition-all appearance-none rounded shadow hover:shadow-md border border-slate-600 checked:bg-slate-800 checked:border-slate-800" type="checkbox" name="dias[]" value="5"> Viernes</label>
                        <label><input class="peer h-5 w-5 cursor-pointer transition-all appearance-none rounded shadow hover:shadow-md border border-slate-600 checked:bg-slate-800 checked:border-slate-800" type="checkbox" name="dias[]" value="6"> Sábado</label>
                        <label><input class="peer h-5 w-5 cursor-pointer transition-all appearance-none rounded shadow hover:shadow-md border border-slate-600 checked:bg-slate-800 checked:border-slate-800" type="checkbox" name="dias[]" value="0"> Domingo</label>
                    </div>
                </div>
                <!-- Rango de fechas -->
                <div class="input-group mb-5">
                    <span class="input-group-text">Desde</span>
                    <input type="date" required name="desde" class="form-control rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                    <span class="input-group-text">Hasta</span>
                    <input type="date" required name="hasta" class="form-control rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                </div>

                <div>
                    <h2 class="text-lg font-medium text-gray-900">
                        {{ __('Rango de horario de atención') }}
                    </h2>
                    <p class="mb-3 text-sm text-gray-600">
                        {{ __("Seleccione el intervalo de horario de atención, si posee horario de corrido, puede ignorar el turno tarde") }}
                    </p>
                </div>
                <!-- Turnos -->
                <div class="input-group mb-3">
                    <input type="hidden" value="{{ $specialist->id }}" name="specialist">
                    <input type="hidden" value="{{ $specialist->especialidad }}" name="specialty">

                    <span class="input-group-text">Horario inicio turno mañana</span>
                    <input type="time" name="inicio_turno_mañana" class="form-control rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">                        
                    <span class="input-group-text">Horario finalización turno mañana</span>
                    <input type="time" name="fin_turno_mañana" class="form-control rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">                        
                </div>

                <div class="input-group mb-3">
                    <span class="input-group-text">Horario inicio turno tarde</span>
                    <input type="time" name="inicio_turno_tarde" class="form-control rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">                        
                    <span class="input-group-text">Horario finalización turno tarde</span>
                    <input type="time" name="fin_turno_tarde" class="form-control rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">                        
                </div>

                <div class="input-group mb-3">
                    <span class="input-group-text">Seleccione un intervalo de turnos</span>
                    <select name="intervalo" class="form-control rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                        <option selected value="15">15 minutos</option>
                        <option value="20">20 minutos </option>
                        <option value="30">30 minutos</option>
                        <option value="45">45 minutos</option>
                        <option value="60">1hr</option>
                        <option value="75">1:15hr</option>
                        <option value="90">1:30hr</option>
                        <option value="105">1:45hr</option>
                        <option value="120">2hr</option>
                    </select>
                </div>

                <div class="col d-grid gap-2 d-md-flex justify-content-md-end mt-3">
                    <x-success-button disabled>{{ __('Guardar') }}</x-success-button>
                </div>
                </form>
                </div>
            </div>
        </div>
    </div>


    <div class="py-1 pb-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg"> 
                <div class="p-6 text-gray-900">
                    <header class="mb-2">
                        <h2 class="text-lg font-medium text-gray-900">
                          {{ __('Ver o eliminar turno de atención') }}
                        </h2>
                      </header>
                    <div class ="mb-3">
                        
                                <form action="{{ route('especialistas.horario_atencion',$specialist)}}" method="post">  
                                    @csrf
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">Buscar turnos del día: </span>
                                    <input type="date" name="fecha_busqueda" id="fecha_busqueda" class="form-control rounded-r border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">                        
                                    <x-success-button >{{ __('Buscar') }}</x-success-button>
                                </div>
                                </form>

                                <div class="row justify-content-end">
<div class="col">
    <form id="formEliminarTurnos" action="{{ route('especialistas.horariosDeAtencion_destroy', $specialist)}}" method="post">  
        @csrf
        <div class="input-group mb-3 col-7">
            <span class="input-group-text col" id="basic-addon1">
                Eliminar todos los turnos del día:
            </span>
            <input type="date" name="fecha_busqueda" id="fecha_busqueda" class="col form-control rounded-r border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">                        
            
            <x-danger-button 
                type="button"
                data-bs-toggle="modal"
                data-bs-target="#confirmDeleteModal">
                {{ __('Eliminar') }}
            </x-danger-button>
        </div>     
    </form>
</div>

<!-- Modal -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-body">
        <p class="modal-title text-xl font-bold">Confirmar eliminación</p>

        ¿Estás seguro que quieres eliminar todos los turnos del siguiente día? 
      </div>

      <div class="modal-footer">
        <x-primary-button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
            Cancelar
        </x-primary-button>
        <x-danger-button disabled type="submit" form="formEliminarTurnos">Eliminar</x-danger-button>
      </div>

    </div>
  </div>
</div>
                                </div>
                        @foreach ($schedule as $schedule)

                            <div class="card border-light">
                                <div class="card-body">
                                    <h5 class="card-title"><strong> Fecha : </strong> {{date("d-m-y",strtotime($schedule->fecha_atencion))  }}</h5>
                                    <h5 class="card-title"><strong> Horario : </strong> {{date("H:i",strtotime($schedule->hr_atencion))  }}</h5>

                                
                                <div class="d-grid gap-2 d-md-flex justify-content-md-end">                                                        
                                   <x-confirm-delete
                                    :id="$schedule->id "
                                    :route="route('especialistas.horario_atencion_destroy',$schedule->id)"
                                    title="Eliminar horario de atención"
                                    :message="'¿Seguro que querés eliminar el horario de atención?'"
                                    button="Eliminar"
                                    label="Eliminar"
                                />
                                </div>
                                </div>
                            </div>      
    
                        @endforeach
                    </div>    
                
                </div>
            </div>
        </div>
    </div>


</x-app-layout>
