<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Agregar turnos de atención') }}
        </h2>
    </x-slot>


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
                    <select class="form-control" id="intervalo" name="intervalo" class="form-control rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                      <option selected disabled >Seleccione un intervalo de turnos</option>
                        <option value="15">15 minutos</option>
                        <option value="30">30 minutos</option>
                        <option value="45">45 minutos</option>
                        <option value="60">60 minutos</option>
                        <option value="75">1:15hr</option>
                        <option value="90">1:30hr</option>
                        <option value="105">1:45hr</option>
                        <option value="120">2hr</option>
                      </select>
                </div>

                    <x-success-button>{{ __('Guardar') }}</x-success-button>
                    <x-primary-a href="{{ route('especialistas.index') }}">{{ __('Volver') }}</x-primary-a>

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
                                    <input type="date" name="fecha_busqueda" id="fecha_busqueda" class="form-control rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">                        
                                    <x-success-button >{{ __('Buscar') }}</x-success-button>
                                </div>
                                </form>

                        @foreach ($schedule as $schedule)
                            <div class="card mb-1">
                                <div class="card-body">
                                <h5 class="card-title"><strong> Horario : </strong> {{date("H:i",strtotime($schedule->hr_atencion))  }}</h5>
                                <h5 class="card-title"><strong> Fecha : </strong> {{date("d-m-y",strtotime($schedule->fecha_atencion))  }}</h5>

                                
                                <div class="d-grid gap-2 d-md-flex justify-content-md-end">                                                        
                                    <form class=" " action="{{ route('especialistas.horario_atencion_destroy',$schedule->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <x-danger-button onclick="return confirm('¿Estás seguro que quieres eliminarla?')">{{ __('Eliminar') }}</x-danger-button>
                                    </form>
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
