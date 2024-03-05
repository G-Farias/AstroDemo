<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<x-app-layout>
    <x-slot name="header" class="container">
        <h2 class="mb-2 font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Turnos reservados') }}
        </h2>
        <div class="col d-grid gap-2 d-md-flex justify-content-md-end">
        @can('isAdmin')
            <x-primary-a href="{{ route('turno.reservados') }}">{{ __('Todos los turnos') }}</x-primary-a>
            <x-primary-a href="{{ route('turno.inicio') }}">{{ __('Volver') }}</x-primary-a>
        @elsecan('isUser')
        <x-primary-a href="{{ route('turno.inicio') }}">{{ __('Volver') }}</x-primary-a>
        @endcan
        </div>
    </x-slot>

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

@can('isAdmin')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg"> 
                <div class="p-6 text-gray-900">
                <div class="row">
                    <div class="col-sm-6">
                        <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-3">
                            {{ __('Ver turnos por fecha y especialista') }} 
                        </h2>
                    <form action="{{ route('turno.reservados_fecha')}}" method="post">  
                        @csrf
                    <div class="input-group mb-3">
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Buscar turnos del día: </span>
                            <input type="date" required name="fecha_busqueda" id="fecha_busqueda" class="form-control rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                        </div>

                        <div class="input-group mb-3">
                            <select class="form-control" id="especialista" name="especialista" class="form-control rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                                <option selected disabled >Especialista</option>
                                    @foreach ($specialists as $specialist)
                                        <option value="{{$specialist->id}}">
                                            <strong>{{ucfirst($specialist->specialty->nombre_especialidad)}} : </strong>  {{ucfirst($specialist->nombre)}} {{ucfirst($specialist->apellido)}}
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
                            {{ __('Ver turnos por especialista') }} 
                        </h2>
                        <form action="{{ route('turno.reservados_especialidad')}}" method="post">
                            @csrf
                        <div class="input-group mb-3">

                            <div class="input-group mb-3">
                                <select class="form-control" id="especialista" name="especialista" class="form-control rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                                    <option selected disabled >Especialista</option>
                                        @foreach ($specialists as $specialist)
                                            <option value="{{$specialist->id}}">
                                                <strong>{{ucfirst($specialist->specialty->nombre_especialidad)}} : </strong>  {{ucfirst($specialist->nombre)}} {{ucfirst($specialist->apellido)}}
                                            </option>
                                        @endforeach
                                </select>
                            </div>
                            <x-success-button >{{ __('Buscar') }}</x-success-button>
                            </form>
                        </div>
                    </div>
                </div>
                      
                <div class="col-sm-6">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-3">
                        {{ __('Buscar turnos por DNI del paciente') }} 
                    </h2>
                <form action="{{ route('turno.reservados_dni')}}" method="post">  
                    @csrf
                <div class="input-group mb-3">
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Buscar turnos del paciente: </span>
                        <input type="number" required name="dni" id="dni" placeholder="D.N.I / Pasaporte" class="form-control rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                    </div>
                    <x-success-button >{{ __('Buscar') }}</x-success-button>
                    </form>
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
            <div class="row">
                <div class="col-sm-6">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-3">
                        {{ __('Ver turnos por fecha') }} 
                    </h2>
                <form action="{{ route('turno.reservados_fecha')}}" method="post">  
                    @csrf
                <div class="input-group mb-3">
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Buscar turnos del día: </span>
                        <input type="date" required name="fecha_busqueda" id="fecha_busqueda" class="form-control rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                    </div>
                    <x-success-button >{{ __('Buscar') }}</x-success-button>
                    </form>
                </div>
            </div>
            <div class="col-sm-6">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-3">
                    {{ __('Buscar turnos por DNI del paciente') }} 
                </h2>
            <form action="{{ route('turno.reservados_dni')}}" method="post">  
                @csrf
            <div class="input-group mb-3">
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Buscar turnos del paciente: </span>
                    <input type="number" required name="dni" id="dni" placeholder="D.N.I / Pasaporte" class="form-control rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
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
@endcan

    <div class="py-1">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg"> 
                <div class="p-6 text-gray-900">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-3">
                        {{ __('Turnos reservados') }} 
                    </h2>
                    <div class="table-responsive" id="no-more-tables">
                        <table class="table text-center">
                        <thead>
                          <tr>
                            <th scope="col">Fecha y hora</th>
                            <th scope="col">Especialista</th>
                            <th scope="col">Paciente</th>
                            <th scope="col">Contacto</th>
                            <th scope="col">Obra social</th>
                            <th scope="col">Estado</th>
                            <th scope="col">Observación</th>
                            <th scope="col">Cancelar</th>
                          </tr>
                        </thead>
                    @foreach ($reservedTurns as $reservedTurn)
                    @foreach ($schedules as $schedule)
                        @if ($schedule->id == $reservedTurn->id_horario_atencion)


                         <tbody>
                            <tr>
                              <input type="text" name="id" id="id" hidden value="{{ $reservedTurn->id }}">
                              <td data-title="Fecha y hora">{{ date("d-m-y",strtotime($schedule->fecha_atencion)) }}<br>{{ date("H:i",strtotime($schedule->hr_atencion)) }}</td>
                              <td data-title="Especialista"> <strong>{{ucfirst($schedule->specialty->nombre_especialidad)}}</strong> <br> {{ ucfirst($schedule->specialist->nombre) }} {{ucfirst($schedule->specialist->apellido)}}</td>
                              <td data-title="Paciente">{{ $reservedTurn->nombre }} {{$reservedTurn->apellido}} <br>{{$reservedTurn->dni}} </td>
                              <td data-title="Contacto">{{ $reservedTurn->celular }}</td>
                              <td data-title="Obra social"><strong>{{ ucfirst($reservedTurn->medicalInsurence->nombre_obraSocial)}}</strong> <br> {{ $reservedTurn->numero_obraSocial }} </td>
                               <td data-title="Estado">
                                <form action="{{ route('turno.actualizar', $reservedTurn ) }}" method="post">
                                <div class="input-group mb-3">
                                        @csrf
                                        <input type="text" hidden name="observacion" id="observacion" value="{{$reservedTurn->observacion}}">
                                        <select class="form-control" required id="estado" name="estado" class="form-control rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                                        <option disabled>Seleccionar estado</option>
                                        <option selected disabled value="{{ $reservedTurn->estado }}">
                                        @if ($reservedTurn->estado == 0)
                                            Disponible
                                        @elseif($reservedTurn->estado == 1)
                                            Reservado
                                        @else
                                            Asistido
                                        @endif
                                        </option>
                                        <option value="1">Reservado</option>
                                        <option value="3">Asistido</option>
                                </select>
                                <x-success-button><i class="bi bi-save"></i></x-success-button>
                                </div>
                            </form>
                               </td>
                             
                             
                              <td data-title="Observación">
                                <form action="{{route('turno.actualizar', $reservedTurn)}}" method="post">
                                <div class="input-group mb-3">
                                        @csrf
                                        <input type="text" hidden name="estado" id="estado" value="{{$reservedTurn->estado}}">
                                        <input value="{{$reservedTurn->observacion}}" name="observacion" id="observacion" class="form-control rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"/>
                                <x-success-button><i class="bi bi-save"></i></x-success-button>
                                </div>
                                </form> 
                              </td>
                              <td>
                                <form class="mb-0 " action="{{ route('turno.destroy', $reservedTurn) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <x-danger-button onclick="return confirm('¿Estás seguro que quieres eliminar?')">{{ __('Eliminar') }}</x-danger-button>
                                </form>
                              </td>
                            </tr>
                          </tbody>



                        @endif
                    @endforeach
                    @endforeach
                </table>
                    </div>
                </div>    
            </div>
        </div>
    </div>
</x-app-layout>
