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
                        {{ __('Especialidades disponibles') }}
                    </h2>
                    <div class="row">
                        @foreach($specialtys as $specialty)
                        <div class="col-sm-6 mb-3">
                          <div class="card">
                            <div class="card-body">
                              <h2 class="mb-1 card-tittle font-semibold text-xl text-gray-800 leading-tight">
                                {{ucfirst($specialty->nombre_especialidad)}}
                              </h2>
                              <p class="card-text mb-3">Presiona el siguiente botón para ver los especialistas y sus respectivos turnos.</p>
                              <x-primary-a href="{{route('reservarTurno.especialistas', $STY = Crypt::encrypt($specialty) ) }}">{{__('Ver turnos de atención')}}</x-primary-a>
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
