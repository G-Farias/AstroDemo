<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<x-app-layout>
    <x-slot name="header" class="container">
        <h2 class="mb-2 font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Reservar turno') }}
        </h2>
        <div class="col d-grid gap-2 d-md-flex justify-content-md-end">
            <x-primary-a href="{{ route('turno.reservados') }}">{{ __('Ver turnos') }}</x-primary-a>
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
                    <div class="card mb-1">
                        <div class="card-body">
                            
                            <h5 class="card-title"><strong> Horario : </strong>{{ date("H:i",strtotime($schedule->hr_atencion)) }}</h5>
                            <h5 class="card-title"><strong> Fecha : </strong>{{ date("d-m-y",strtotime($schedule->fecha_atencion)) }}</h5>
                            <h5 class="card-title"><strong>Especialista : </strong>{{ $schedule->specialist->nombre }} {{$schedule->specialist->apellido}}</h5>
                            <h5 class="card-title"><strong>Especialidad : </strong>{{ $schedule->specialty->nombre_especialidad }}</h5>

                            <h6 class="card-tittle mb-3"><strong>Datos del paciente : </strong></h6>

                            <form action="{{ route('turno.store') }}" method="post">
                                @csrf
                            <div class="input-group mb-3">
                                <input type="text" name="id_horario" id="id_horario" hidden value="{{ $schedule->id }}">
                                <input type="text"  name="nombre" id="nombre" required class="form-control rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" placeholder="Nombre" aria-label="Nombre">
                                <input type="text"  name="apellido" id="apellido" required class="form-control rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" placeholder="Apellido" aria-label="Apellido">
                            </div>

                            <div class="input-group mb-3">
                                <input type="number"  name="dni" id="dni" required class="form-control rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" placeholder="D.N.I / Pasaporte" aria-label="">
                                <input type="number"  name="dni_rep" id="dni_rep" required class="form-control rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" placeholder="Repetir D.N.I / Pasaporte" aria-label="">
                            </div>

                            <div class="input-group mb-3">
                                <input type="number"  name="celular" id="celular" class="form-control rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" placeholder="Celular" aria-label="">
                                <input type="mail"  name="email" id="email" class="form-control rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" placeholder="Email" aria-label="">
                            </div>

                            <div class="input-group mb-3">
                                <select class="form-control" required id="obra_social" name="obra_social" class="form-control rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                                    <option selected disabled >Seleccione una obra social</option>
                                        @foreach ($medicalInsurenceSpecialist as $medicalInsurenceSpecialist)
                                            <option value="{{$medicalInsurenceSpecialist->id}}">
                                                {{$medicalInsurenceSpecialist->medicalInsurence->nombre_obraSocial}}
                                            </option>
                                        @endforeach
                                </select>
                                <input type="text" required name="numero_obraSocial" id="numero_obraSocial" class="form-control rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" placeholder="Número obra social" aria-label="NumeroObraSocial">                        
                            </div>

                            <div class="input-group mb-3">
                                <span class="input-group-text">Observación</span>
                                <textarea name="observacion" id="observacion" class="form-control rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"></textarea>
                            </div>
                            
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">                                                        
                                <x-success-button>{{ __('Reservar') }}</x-success-button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
