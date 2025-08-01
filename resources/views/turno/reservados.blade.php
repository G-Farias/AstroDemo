<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col d-grid gap-2 d-md-flex ">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Turnos reservados') }}
                </h2>
            </div>            
            <div class="col-3 d-grid gap-2 d-md-flex justify-content-md-end">
            @can('isAdmin')
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
                #no-more-tables tbody {
                    border: 1px solid #ccc;
                    margin-top: 2%;
                    padding-top: 2%;

            }
            #no-more-tables thead tr {
                position: absolute;
                top: -9999px;
                left: -9999px;
                
            }
            #no-more-tables td {
                position: relative;
                padding-left: 50%;
                padding-top: 5%;
                padding-bottom: 5%; 
                border: none;
                border-bottom: 1px solid #fff;
            }
            #no-more-tables td:before {
                content: attr(data-title);
                position: absolute;
                left: 6px;
                font-weight: bold;
                padding-left: 5%;


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
                    <form action="{{ route('turno.reservados_fecha')}}" method="get">  
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
                                    <x-success-button-non-r class="btn btn-outline-success"><i class="bi bi-search"></i></x-success-button-non-r>
                                </div>
                        </form>
                    </div>
                </div>
                    <div class="col-sm-6">
                        <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-3">
                            {{ __('Ver turnos por especialista') }} 
                        </h2>
                        <div class="input-group mb-3">
                            <form action="{{ route('turno.reservados_especialista')}}" method="get">
                                @csrf
                                <div class="input-group mb-3">
                                        <select class="form-control" id="especialista" name="especialista" class="form-control rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                                            <option selected disabled >Especialista</option>
                                                @foreach ($specialists as $specialist)
                                                    <option value="{{$specialist->id}}">
                                                    <strong>{{ucfirst($specialist->specialty->nombre_especialidad)}} : </strong>  {{ucfirst($specialist->nombre)}} {{ucfirst($specialist->apellido)}}
                                                    </option>
                                                @endforeach
                                        </select>   
                                    <x-success-button-non-r class="btn btn-outline-success"><i class="bi bi-search"></i></x-success-button-non-r>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                      
                    <div class="col-sm-6">
                        <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-3">
                            {{ __('Buscar turnos por DNI del paciente') }} 
                        </h2>
                        <form action="{{ route('turno.reservados_dni')}}" method="get">  
                            @csrf
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">Buscar turnos del paciente: </span>                            
                                    <input type="number" required name="dni" id="dni" placeholder="D.N.I / Pasaporte" class="form-control rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                                        <x-success-button-non-r class="btn btn-outline-success"><i class="bi bi-search"></i></x-success-button-non-r>                    
                            </div>
                        </form>
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
                    <div class="col-sm-6 mt-3">
                        <form action="{{ route('turno.reservados_fecha')}}" method="get">  
                            @csrf
                        <div class="input-group">
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1">Buscar turnos por fecha: </span>
                                <input type="date" required name="fecha_busqueda" id="fecha_busqueda" class="form-control rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                                <x-success-button-non-r class="btn btn-outline-success"><i class="bi bi-search"></i></x-success-button-non-r>                    
                            </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-sm-6 mt-3">
                            <form action="{{ route('turno.reservados_dni')}}" method="get">  
                                @csrf
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1">Buscar por D.N.I / Pasaporte: </span>                            
                                        <input type="number" required name="dni" id="dni" placeholder="D.N.I / Pasaporte" class="form-control rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                                            <x-success-button-non-r class="btn btn-outline-success"><i class="bi bi-search"></i></x-success-button-non-r>                    
                                </div>
                            </form>
                    </div>
                </div>    
            </div>

        </div>    
    </div>
</div>
@endcan

    <div class="py-1 pb-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg"> 
                <div class="p-6 text-gray-900" >
                    <div class="row mb-3">
                        <div class="col">
                            <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-2">
                              {{ __('Turnos reservados') }} 
                            </h2>
                        </div>
                        <div class="col d-grid gap-2 d-md-flex justify-content-md-end">                                
                                <x-primary-a  href="{{ route('generate-turn-pdf') }}" target="_blank"><i class="bi bi-printer-fill"> {{ __('Imprimir') }}</i></x-primary-a>
                                <x-primary-a  href="{{ route('export-turn') }}" target="_blank"><i class="bi bi-file-earmark-excel"> {{ __('Exportar excel') }}</i></x-primary-a>                         
                        </div>
                    </div>

                    <div class="overflow-x-auto border rounded-lg table-responsive overflow-visible" id="no-more-tables" >
                        <table class="min-w-full text-sm text-center text-gray-700 table-borderless">
                        <thead class="bg-gray-100 text-gray-800 font-semibold sticky top-0 z-10">
                          <tr>
                            <th class="px-4 py-3" scope="col">Fecha y hora</th>
                            <th class="px-4 py-3" scope="col">Especialista</th>
                            <th class="px-4 py-3" scope="col">Paciente</th>
                            <th class="px-4 py-3" scope="col">Contacto</th>
                            <th class="px-4 py-3" scope="col"></th>
                            <th class="px-4 py-3" scope="col"></th>
                            <th class="px-4 py-3" scope="col"></th>
                          </tr>
                        </thead>
                        @foreach ($reservedTurns as $reservedTurn)
                        <tbody class="border border-gray rounded">                       
                            <tr>
                              <input type="text" name="id" id="id" hidden value="{{ $reservedTurn->id }}">
                              <td class="px-4 py-3" data-title="Fecha y hora :" class="table-borderless">{{ date("d-m-y",strtotime($reservedTurn->schedule?->fecha_atencion)) }}<br>{{ date("H:i",strtotime($reservedTurn->schedule?->hr_atencion)) }}</td>
                              <td class="px-4 py-3" data-title="Especialista :"> <strong>{{ucfirst($reservedTurn->schedule?->specialty->nombre_especialidad)}}</strong> <br> {{ ucfirst($reservedTurn->schedule?->specialist->nombre) }} {{ucfirst($reservedTurn->schedule?->specialist->apellido)}}</td>
                              <td class="px-4 py-3" data-title="Paciente :">{{ ucfirst($reservedTurn->nombre) }} {{ucfirst($reservedTurn->apellido)}} <br>{{$reservedTurn->dni}} </td>
                              <td class="px-4 py-3" data-title="Contacto :">{{ $reservedTurn->celular }}</td>
                               <td colspan="2" class="px-4 py-1 align-middle">
    <div class="border border-gray-300 rounded-lg shadow-sm p-2 bg-white w-full">
        <form action="{{ route('turno.actualizar_estado', $reservedTurn) }}" method="post"
              class="flex flex-col sm:flex-row items-center gap-3 w-full">
            @csrf
            @method('PUT')

            {{-- Select Estado --}}
            <div class="w-full sm:w-48">
                <select required id="estado" name="estado"
                        class="form-select text-sm rounded-lg border border-slate-300 text-slate-700 bg-white pl-3 pr-8 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition duration-300 ease-in-out cursor-pointer w-full">
                    <option selected value="{{ $reservedTurn->estado }}">
                        @switch($reservedTurn->estado)
                            @case(0) Disponible @break
                            @case(1) Reservado @break
                            @case(3) Asistido @break
                            @default Ausente
                        @endswitch
                    </option>
                    <option value="1">Reservado</option>
                    <option value="3">Asistido</option>
                    <option value="4">Ausente</option>
                </select>
            </div>

            {{-- Input Observación --}}
            <div class="flex-1 w-full">
                <input type="text" value="{{ $reservedTurn->observacion }}" name="observacion" id="observacion"
                       placeholder="Observación"
                       class="form-input text-sm rounded-lg border border-slate-300 text-slate-700 px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-indigo-500" />
            </div>

            {{-- Botón Guardar --}}
            <x-success-button-non-r class="btn btn-outline-success">
                <i class="bi bi-floppy"></i>
            </x-success-button-non-r>
        </form>
    </div>
</td>

  
<div class="modal fade" id="cancelarTurno{{$reservedTurn->id}}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <h5 class="modal-title font-bold text-xl mb-2">Cancelar turno reservado</h5>
                <p>¿Estás seguro de que deseas cancelar el turno del día <br> {{ date("d-m-y",strtotime($reservedTurn->schedule?->fecha_atencion)) }} a las {{ date("H:i",strtotime($reservedTurn->schedule?->hr_atencion)) }}hs?</p>
            </div>
            <div class="modal-footer border-0">
                <x-primary-button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    Cancelar
                </x-primary-button>
                <form class="mb-0 " action="{{ route('turno.destroy', $reservedTurn) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <x-danger-button disabled>Eliminar</x-danger-button>
                </form>
            </div>

        </div>
    </div>
</div>

                            <td class="px-4 py-3 align-middle">  
                                <div class="dropdown col d-grid gap-2 d-md-flex justify-content-md-end">
                                    <x-primary-a  href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="bi bi-three-dots"></i>
                                    </x-primary-a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <button class="dropdown-item rounded px-3 py-1.5 text-sm"  data-bs-toggle="modal" data-bs-target="#cancelarTurno{{$reservedTurn->id}}" style="color:crimson;">Cancelar turno</button>
                                        </li>
                                      @can('isAdmin')
                                                @unless($patients->contains('dni', $reservedTurn->dni))
                                                    <li>
                                                        <a class="dropdown-item rounded px-3 py-1.5 text-sm" href="{{ route('pacientes.pendiente_save', $reservedTurn->dni) }}">
                                                            {{ __('Almacenar') }}
                                                        </a>
                                                    </li>
                                                @endunless
                                            @elsecan('isUser')
                                                @unless($patients->contains('dni', $reservedTurn->dni))
                                                    <li>
                                                        <a class="dropdown-item rounded px-3 py-1.5 text-sm" href="{{ route('pacientes.pendiente_save', $reservedTurn->dni) }}">
                                                            {{ __('Almacenar') }}
                                                        </a>
                                                    </li>
                                                @endunless                                            
                                            @endcan
                                        <li><a class="dropdown-item rounded px-3 py-1.5 text-sm" href="{{ route('turno.show', $reservedTurn->id) }}">Más información</a></li>
                                    </ul>
                                </div>
                            </td>
                            </tr>
                          </tbody>                    
                    @endforeach
                    </table>
                    </div>
                </div>    
            </div>
            
            <div class="py-3"> 
                {{$reservedTurns->links()}}
            </div>
        </div>
    </div>
    

</x-app-layout>
