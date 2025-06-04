<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<x-viewpublic>

  @guest
  <x-public-navbar></x-public-navbar>
  @endguest
  @auth
    @include('layouts.navigation')
  @endauth


 
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="mb-2 bg-white overflow-hidden shadow-sm sm:rounded-lg"> 
                <div class="p-6 text-gray-900">
                    <div class="col-sm-6">
                        <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-1">
                            {{ __('Ver turnos por fecha') }} 
                        </h2>
                        <p class="mb-3 text-muted font-semibold leading-tight">
                            Ingrese la fecha de un turno que desea buscar
                        </p>
                    <form action="{{ route('reservarTurno.turnos_fecha', $SST = Crypt::encrypt($specialist))}}" method="get">  
                        @csrf
                    <div class="input-group">
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Buscar turnos del día: </span>
                            <input type="date" required name="fecha_busqueda" id="fecha_busqueda" class="form-control rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                           
                        </div>
                    </div>
                    <div class="d-grid gap-2 flex-wrap justify-content-end">                                                        
                        <x-success-button >{{ __('Buscar') }}</x-success-button>
                    </div>
                    </form>
                </div>
            </div>
        </div>     
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg"> 
                <div class="p-6 text-gray-900">
                    <h2 class="mb-4 font-semibold text-xl text-gray-800 leading-tight">
                        {{ __('Turnos disponibles de')}} {{ucfirst($specialist->nombre)}} {{ucfirst($specialist->apellido)}} 
                    </h2>
                    <div class="row">
                        @forelse($schedules as $schedule)
                        <div class="col-sm-6 mb-3">
                          <div class="card">
                            <div class="card-body">
                              <h2 class="card-tittle font-semibold text-xl text-gray-800 leading-tight">
                              </h2>
                              <p class="card-text fs-5 mb-1"><strong>Día y horario de atención </strong></p>
                              <p class="card-text"><i class="bi bi-person-circle"></i> {{ucfirst($specialist->nombre)}} {{ucfirst($specialist->apellido)}}</p>
                              <p class="card-text"><i class="bi bi-calendar-check"></i> {{date("d-m-y",strtotime($schedule->fecha_atencion))}}</p>
                              <p class="card-text mb-3"><i class="bi bi-clock"></i> {{date("H:i",strtotime($schedule->hr_atencion))}}hs</p>

                              @if ($schedule->estado == '0')
                                 <x-primary-a href="{{route('reservarTurno.reservar', $SSL = Crypt::encrypt($schedule))}}">{{__('Reservar turno atención')}}</x-primary-a>
                              @else
                                <x-red-anunnce>{{__('Turno reservado')}}</x-red-anunnce>  
                              @endif

                            </div>  
                          </div>
                        </div>
                        @empty
                        <h2 class="font-semibold text-l text-gray-800 leading-tight">
                            {{ __('No hay turnos disponibles.') }} 
                        </h2>                        
                        @endforelse
                    </div>
                </div>
            </div>
            <div class="py-3">
                {{$schedules->links()}}
            </div>
        </div>
    </div>
    
</x-viewpublic>
