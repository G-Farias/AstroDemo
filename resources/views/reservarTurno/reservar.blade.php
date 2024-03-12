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
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg"> 
                <div class="p-6 text-gray-900">
                    <h2 class="mb-1 font-semibold text-xl text-gray-800 leading-tight">
                        {{ __('Información del turno al reservar')}} 
                    </h2>
                    <p class="mb-2 text-muted font-semibold leading-tight">
                        Verifique bien la Información del turno, antes de completar
                    </p>
                    @foreach($schedules as $schedule)
                    @foreach($specialists as $specialist)
                    <div class="mb-3">
                        <div class="card-body">
                          <h2 class="card-tittle font-semibold text-xl text-gray-800 leading-tight">
                        </h2>
                          <p class="card-text"><strong>Especialista: </strong>{{ucfirst($specialist->nombre)}} {{ucfirst($specialist->apellido)}}</p>
                          <p class="card-text"><strong>Especialidad de atención: </strong>{{$specialist->specialty->nombre_especialidad}}</p>
                          <p class="card-text"><strong>Fecha de atención </strong>{{date("d-m-y",strtotime($schedule->fecha_atencion))}}</p>
                          <p class="card-text mb-3"><strong>Hora de atención: </strong>{{date("H:i",strtotime($schedule->hr_atencion))}}hs</p>
                        </div>
                    </div>
                    @endforeach
                    @endforeach
                </div>
            </div>
            <div class="mt-2 bg-white overflow-hidden shadow-sm sm:rounded-lg"> 
                <div class="p-6 text-gray-900">
                    <h2 class="mb-4 font-semibold text-xl text-gray-800 leading-tight">
                        {{ __('Complete el siguiente formulario para reservar el turno.')}} 
                    </h2>

                    <form action="{{ route('reservarTurno.store') }}" method="post">
                        @csrf
                    <div class="input-group mb-3">
                        <input type="text" name="id_horario" id="id_horario" hidden value="{{ $schedule->id }}">
                        <input type="text" name="estado" id="estado" hidden value="{{ $schedule->estado }}">
                        <input type="text"  name="nombre" id="nombre" required class="form-control rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" placeholder="Nombre/s" aria-label="Nombre">
                        <input type="text"  name="apellido" id="apellido" required class="form-control rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" placeholder="Apellido/s" aria-label="Apellido">
                    </div>

                    <p class="mb-2 text-sm text-gray-600">
                        {{ __("Ingrese el DNI o pasaporte sin puntos ni guiones.") }}
                      </p>
                    <div class="input-group mb-3">
                        <input type="number"  name="dni" id="dni" required class="form-control rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" placeholder="D.N.I / Pasaporte" aria-label="">
                        <input type="number"  name="dni_rep" id="dni_rep" required class="form-control rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" placeholder="Repetir D.N.I / Pasaporte" aria-label="">
                    </div>
                    <p class="mb-2 text-sm text-gray-600">
                        {{ __("El email y celular se utilizará como medio de contacto.") }}
                      </p>
                    <div class="input-group mb-3">
                        <input type="number" required  name="celular" id="celular" class="form-control rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" placeholder="Celular" aria-label="">
                        <input type="mail" required name="email" id="email" class="form-control rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" placeholder="Email" aria-label="">
                    </div>

                    <div class="input-group mb-3">
                        <select class="form-control" required id="obra_social" name="obra_social" class="form-control rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                            <option disabled selected >Seleccione una obra social</option>
                              
                                @foreach ($medicalInsurenceSpecialist as $medicalInsurenceSpecialist)
                                    <option value="{{$medicalInsurenceSpecialist->id_obraSocial}}">
                                        {{ucfirst($medicalInsurenceSpecialist->medicalInsurence->nombre_obraSocial)}}
                                    </option>
                                @endforeach
                        </select>
                        <input type="text" name="numero_obraSocial" id="numero_obraSocial" class="form-control rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" placeholder="Número obra social" aria-label="NumeroObraSocial">                        
                    </div>
                    
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">                                                        
                        <x-success-button>{{ __('Reservar') }}</x-success-button>
                    </div>
                
                    </form>

                </div>
            </div>
        </div>
    </div>
    
</x-viewpublic>
