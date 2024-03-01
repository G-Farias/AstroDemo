<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<x-app-layout>
    <style>
        @media only screen and (max-width:800px) {
            #no-more-tables tbody,
            #no-more-tables tr,
            #no-more-tables td {
                display: block;
            }
            #no-more-tables thead tr {
                position: absolute;
                top: -9999px;
                left: -9999px;
            }
            #no-more-tables td {
                position: relative;
                padding-left: 50%;
                border: none;
                border-bottom: 1px solid #eee;
            }
            #no-more-tables td:before {
                content: attr(data-title);
                position: absolute;
                left: 6px;
                font-weight: bold;
            }
            #no-more-tables tr {
                border-bottom: 1px solid #ccc;
            }
        }
    </style>

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

    <x-slot name="header" class="container">
        <h2 class="mb-2 font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Turnos disponibles para reservar') }}
        </h2>

        <div class="col d-grid gap-2 d-md-flex justify-content-md-end">
            @can('isUser')
            <x-third-a href="{{ route('especialistas.horario_atencion', Auth::user()->id_especialista) }}">{{__('Agregar turnos de atención')}}</x-third-a>
            @endcan
            <x-primary-a href="{{ route('turno.reservados') }}">{{ __('Ver turnos reservados') }}</x-primary-a>
        </div>
    </x-slot>
 
@can('isAdmin')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg"> 
                <div class="p-6 text-gray-900">
                    <form action="{{ route('turno.index')}}" method="post">  
                        @csrf
            <div class="row">
                <div class="col-sm-6">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-3">
                        {{ __('Buscar turnos por especialidad y fecha') }} 
                    </h2>
                    <div class="input-group mb-3">
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Buscar turnos del día: </span>
                            <input type="date" name="date" id="date" required class="form-control rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                        </div>

                        <div class="input-group mb-3">
                            <select class="form-control" id="especialidad" name="especialidad" class="form-control rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                                <option selected disabled >Especialidad</option>
                                    @foreach ($specialtys as $specialty)
                                        <option value="{{$specialty->id}}">
                                            {{ucfirst($specialty->nombre_especialidad)}}
                                        </option>
                                    @endforeach
                            </select>
                        </div>
                        <x-success-button >{{ __('Buscar') }}</x-success-button>
                        </form>
                    </div>
                </div>   
                <div class="col-sm-6">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-3">
                        {{ __('Buscar turnos por especialidad') }} 
                    </h2>
                    <form action="{{ route('turno.busqueda_especialidad')}}" method="post">
                        @csrf
                    <div class="input-group mb-3">
                        <div class="input-group mb-3">
                            <select class="form-control" id="especialidad" name="especialidad" class="form-control rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                                <option selected disabled >Especialidad</option>
                                    @foreach ($specialtys as $specialty)
                                        <option value="{{$specialty->id}}">
                                            {{ucfirst($specialty->nombre_especialidad)}}
                                        </option>
                                    @endforeach
                            </select>
                        </div>
                        <x-success-button >{{ __('Buscar') }}</x-success-button>
                        </form>
                    </div>
                </div>
            </div>
                </div>    
            </div>
        </div>
    </div>

@elsecan('isUser')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg"> 
            <div class="p-6 text-gray-900">
                <form action="{{ route('turno.index')}}" method="post">  
                    @csrf
        <div class="row">
            <div class="col-sm-6">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-3">
                    {{ __('Buscar turnos disponibles por fecha') }} 
                </h2>
                <div class="input-group mb-3">
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Buscar turnos del día: </span>
                        <input type="date" name="date" id="date" required class="form-control rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                    </div>

                    <x-success-button >{{ __('Buscar') }}</x-success-button>
                    </form>
                </div>
            </div>   
            <div class="col-sm-6">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-3">
                    {{ __('Ver todos los turnos disponibles') }} 
                </h2>
                <form action="{{ route('turno.busqueda_especialidad')}}" method="post">
                    @csrf
                <div class="input-group mb-3">
                    <x-success-button >{{ __('Ver todos') }}</x-success-button>
                </form>
                </div>
            </div>
        </div>
            </div>    
        </div>
    </div>
</div>
@endcan






    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg"> 
                <div class="p-6 text-gray-900">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-3">
                        {{ __('Reservar turnos') }} 
                    </h2>
                <div class="table-responsive" id="no-more-tables">
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">Fecha</th>
                            <th scope="col">Hora</th>
                            <th scope="col">Especialista</th>
                            <th scope="col">Estado</th>
                            <th scope="col">Reservar</th>
                            <th scope="col">Reservar sobreturno</th>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach ($schedules as $schedule)  
                          <tr>
                            <td data-title="Fecha">{{ date("d-m-y",strtotime($schedule->fecha_atencion)) }}</td>
                            <td data-title="Hora" >{{ date("H:i",strtotime($schedule->hr_atencion)) }}</td>
                            <td data-title="Especialista">{{ ucfirst($schedule->specialist->nombre) }} {{ucfirst($schedule->specialist->apellido)}}</td>
                            <td data-title="Estado">
                                @if ($schedule->estado == '0')
                                    <p>Disponible</p>
                                @else
                                    <p>Ocupado</p>
                                @endif
                            </td>
                            <td data-title="Reservar">
                                @if ($schedule->estado == '0')
                                 <x-success-a href="{{ route('turno.create', $schedule) }}">{{ __('Reservar') }}</x-success-a>
                                @else
                                <x-grey-anunnce>{{__('Reservado')}}</x-grey-anunnce>
                                @endif
                            </td>
                            <td data-title="Sobreturno">@if ($schedule->specialty->sobreturno == '0')
                                <x-grey-anunnce>{{__('No disponible')}}</x-grey-anunnce>
                            @else
                            <x-success-a href="{{ route('turno.create', $schedule) }}">{{ __('Reservar') }}</x-success-a>
                            @endif</td>
                          </tr>
                        @endforeach
                        </tbody>
                      </table>
                    </div>
                </div>    
            </div>
        </div>
    </div>
</x-app-layout>
