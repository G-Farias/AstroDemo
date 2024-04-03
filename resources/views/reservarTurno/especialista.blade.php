<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<x-viewpublic>

  <x-public-navbar></x-public-navbar>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg"> 
                <div class="p-6 text-gray-900">
                    <h2 class="mb-4 font-semibold text-xl text-gray-800 leading-tight">
                        {{ __('Especialistas disponibles de la especialidad:')}} {{ucfirst($specialty->nombre_especialidad)}}
                    </h2>
                    <div class="row">
                        @foreach($specialists as $specialist)
                            
                        <div class="col-sm-6 mb-3">
                          <div class="card">
                            <div class="card-body">
                              <h2 class="card-tittle font-semibold text-xl text-gray-800 leading-tight">
                                {{ucfirst($specialist->nombre)}} {{ucfirst($specialist->apellido)}} 
                              </h2>
                              <p class="card-text"><strong>Día y horario de atención: </strong></p>
                              <p class="card-text">{{ucfirst($specialist->dia_atencion)}}</p>
                              <p class="card-text mb-3">{{$specialist->hr_atencion}}</p>
                              <x-primary-a href="{{route('reservarTurno.turnos',$SST = Crypt::encrypt($specialist)) }}">{{__('Ver turnos de atención')}}</x-primary-a>
                            </div>
                          </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</x-viewpublic>
