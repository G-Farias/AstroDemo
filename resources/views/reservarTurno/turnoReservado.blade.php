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
                    <h2 class="mb-4 font-semibold text-xl text-gray-800 leading-tight">
                        {{ __('Información del turno reservado')}} 
                    </h2>
                    <div class="row">
                        @foreach ($schedules as $schedule)
                        @if ($schedule->id == $reservedTurn->id_horario_atencion)
                        <p class="card-text"><strong>Especialidad: </strong>{{ucfirst($schedule->specialty->nombre_especialidad)}}</p>
                       <p class="card-text"><strong>Especialista: </strong>{{ucfirst($schedule->specialist->nombre)}} {{ucfirst($schedule->specialist->apellido)}}</p>
                       <p class="card-text"><strong>Fecha de atención </strong>{{date("d-m-y",strtotime($schedule->fecha_atencion))}}</p>
                       <p class="card-text mb-3"><strong>Hora de atención: </strong>{{date("H:i",strtotime($schedule->hr_atencion))}}hs</p>

                       <p class="card-text"><strong>Nombre y Apellido: </strong>{{ucfirst($reservedTurn->nombre)}} {{ucfirst($reservedTurn->apellido)}}</p>
                       <p class="card-text"><strong>D.N.I / Pasaporte: </strong>{{$reservedTurn->dni}}</p>
                       <p class="card-text"><strong>Celular: </strong>{{$reservedTurn->celular}}</p>
                       <p class="card-text"><strong>Email: </strong>{{$reservedTurn->email}}</p>

                       <p class="card-text"><strong>Obra social / prepaga: </strong>{{ ucfirst($reservedTurn->medicalInsurence?->nombre_obraSocial)}} </p>
                       <p class="card-text"><strong>Número de afiliado: </strong>{{ $reservedTurn->numero_obraSocial }}</p>
                       
                       <div class="btn-group flex-wrap justify-content-end mt-4">          
                            <x-primary-a  href="{{ route('reservarTurno.especialidades') }}"><i class="bi bi-printer-fill"> {{ __('Volver') }}</i></x-primary-a>                  
                            <x-primary-a  href="{{ route('generate-comprobante', $RT = Crypt::encrypt($reservedTurn)) }}" target="_blank"><i class="bi bi-printer-fill"> {{ __('Descargar comprobante') }}</i></x-primary-a>
                            <form class="mb-0 " action="{{route('reservarTurno.cancelar',$reservedTurn )}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <x-danger-button onclick="return confirm('¿Estás seguro que quieres cancelar el turno seleccionado?')">{{ __('Cancelar turno') }}</x-danger-button>
                            </form>
                        </div>
                       @endif
                       @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</x-viewpublic>
