<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<x-viewpublic>
    <x-public-navbar></x-public-navbar>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
  @endif
@if (session('danger'))
    <div class="alert alert-danger">
          {{ session('danger') }}
    </div>
@endif
  @if (session('success'))
    <div class="alert alert-success">
       {{ session('success') }}
    </div>
@endif


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-2 bg-white overflow-hidden shadow-sm sm:rounded-lg"> 
                <div class="p-6 text-gray-900">
                    <div class="col-sm-12">
                        <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-3 mt-2">
                            {{ __('Ver mis turnos') }} 
                        </h2>
                        <p class="mb-2 text-muted font-semibold leading-tight">
                            Ingrese su D.N.I o pasaporte sin puntos ni guiones para poder ver sus turnos.
                        </p>
                    <form action="{{ route('reservarTurno.misTurnos')}}" method="post">  
                        @csrf
                    <div class="input-group mt-2">
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Buscar turnos: </span>
                            <input type="number" placeholder="D.N.I / Pasaporte" required name="dni" id="dni" class="form-control rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                        </div>
                    </div>
                    <div class="d-grid gap-2 flex-wrap justify-content-end">                                                        
                        <x-success-button>{{ __('Buscar') }}</x-success-button>
                        </div>
                        </form>
                </div>
            </div>
        </div>     
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg"> 
                <div class="p-6 text-gray-900">
                    <h2 class="mb-4 font-semibold text-xl text-gray-800 leading-tight">
                        {{ __('Mis turnos disponibles')}} 
                    </h2>
                    <div class="row">
                        @forelse ($reservedTurns as $reservedTurn)
                        @foreach ($schedules as $schedule)
                        @if ($schedule->id == $reservedTurn->id_horario_atencion)
                        <div class="card border-light">
                            <div class="card-body">
                              <h2 class="card-tittle font-semibold text-xl text-gray-800 leading-tight">
                              </h2>
                              <p class="card-text"><strong>D.N.I / Pasaporte: </strong>{{$reservedTurn->dni}}</p>
                              <p class="card-text"><strong>Especialidad: </strong>{{ucfirst($schedule->specialty->nombre_especialidad)}}</p>
                              <p class="card-text"><strong>Especialista: </strong>{{ucfirst($schedule->specialist->nombre)}} {{ucfirst($schedule->specialist->apellido)}}</p>
                              <p class="card-text"><strong>Fecha de atención </strong>{{date("d-m-y",strtotime($schedule->fecha_atencion))}}</p>
                              <p class="card-text mb-3"><strong>Hora de atención: </strong>{{date("H:i",strtotime($schedule->hr_atencion))}}hs</p>

                              <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <form class="mb-0 " action="{{route('reservarTurno.destroy',$reservedTurn )}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <x-danger-button onclick="return confirm('¿Estás seguro que quieres cancelar el turno seleccionado?')">{{ __('Cancelar turno') }}</x-danger-button>
                                </form>
                              </div>
                            </div>                        
                        </div>
                        @endif
                        @endforeach
                        @empty 
                        <p class="text-muted font-semibold leading-tight">
                            Usted no posee turnos registrados.
                        </p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</x-viewpublic>
