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

                    <div class="table-responsive overflow-visible" id="no-more-tables" >
                        <table class="table text-center table-borderless">
                        <thead>
                          <tr>
                            <th scope="col">Fecha y hora</th>
                            <th scope="col">Especialista</th>
                            <th scope="col">Paciente</th>
                            <th scope="col">Contacto</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                          </tr>
                        </thead>
                        @foreach ($reservedTurns as $reservedTurn)
                        <tbody class="border border-gray rounded">
                                
                            <tr>
                              <input type="text" name="id" id="id" hidden value="{{ $reservedTurn->id }}">
                            {{-- <td data-title="Notificación">                         
                            @if ($reservedTurn->notificacion == null)
                                <p>No</p>
                            @else
                                <p>Si</p>
                            @endif</td>  --}}
                              <td data-title="Fecha y hora :" class="table-borderless">{{ date("d-m-y",strtotime($reservedTurn->schedule?->fecha_atencion)) }}<br>{{ date("H:i",strtotime($reservedTurn->schedule?->hr_atencion)) }}</td>
                              <td data-title="Especialista :"> <strong>{{ucfirst($reservedTurn->schedule?->specialty->nombre_especialidad)}}</strong> <br> {{ ucfirst($reservedTurn->schedule?->specialist->nombre) }} {{ucfirst($reservedTurn->schedule?->specialist->apellido)}}</td>
                              <td data-title="Paciente :">{{ ucfirst($reservedTurn->nombre) }} {{ucfirst($reservedTurn->apellido)}} <br>{{$reservedTurn->dni}} </td>
                              <td data-title="Contacto :">{{ $reservedTurn->celular }}</td>
                               <td data-title="Estado : ">
                                <form action="{{ route('turno.actualizar_estado', $reservedTurn ) }}" method="post">
                                 <div class="input-group">
                                 @csrf
                                    @method('PUT')
                                        <select class="form-control" required id="estado" name="estado" class="form-control text-indigo-600 shadow-sm focus:ring-indigo-500">
                                        <option  selected value="{{ $reservedTurn->estado }}">
                                        @if ($reservedTurn->estado == 0)
                                            Disponible
                                        @elseif($reservedTurn->estado == 1)
                                            Reservado
                                        @elseif($reservedTurn->estado == 3)
                                            Asistido
                                        @else
                                            Ausente
                                        @endif
                                        </option>
                                        <option value="1">Reservado</option>
                                        <option value="3">Asistido</option>
                                        <option value="4">Ausente</option>
                                </select>
                                  <x-success-button-non-r class="btn btn-outline-success"><i class="bi bi-floppy"></i></x-success-button-non-r>
                                </div>
                               </td>
                             
                             
                              <td data-title="Observación :">
                                <div class="input-group">
                                        @csrf
                                        @method('PUT')
                                        <input value="{{$reservedTurn->observacion}}" placeholder="Observación" name="observacion" id="observacion" class="form-control text-indigo-600 shadow-sm focus:ring-indigo-500"/>
                                  <x-success-button-non-r  class="btn btn-outline-success"><i class="bi bi-floppy"></i></x-success-button-non-r>
                             </form>
                                </div>
                                </form> 
                              </td>
                         {{--     <td>
                                <form class="mb-0 " action="{{ route('turno.destroy', $reservedTurn) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <x-danger-button onclick="return confirm('¿Estás seguro que quieres eliminar?')"><i class="bi bi-x-lg"></i></x-danger-button>
                                </form>
                              </td>
                              <td>
                                <x-success-a href="{{ route('turno.show', $reservedTurn->id) }}">{{ __('Ver más') }}</x-success-a>
                            </td> --}}
                            <td >
                                <div class="dropdown col d-grid gap-2 d-md-flex justify-content-md-end">
                                    <x-primary-a  href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="bi bi-three-dots"></i>
                                    </x-primary-a>
                                    <ul class="dropdown-menu">
                                        <li><form class="mb-0 " action="{{ route('turno.destroy', $reservedTurn) }}" method="POST">
                                                @csrf
                                             @method('DELETE')
                                            <button class="dropdown-item" style="color:crimson;" onclick="return confirm('¿Estás seguro que quieres eliminar?')">Cancelar turno</button>
                                            </form></li>

                                            @can('isAdmin')
                                                @unless($patients->contains('dni', $reservedTurn->dni))
                                                    <li>
                                                        <a class="dropdown-item" href="{{ route('pacientes.pendiente_save', $reservedTurn->dni) }}">
                                                            {{ __('Almacenar') }}
                                                        </a>
                                                    </li>
                                                @endunless
                                            @elsecan('isUser')
                                                @unless($patients->contains('dni', $reservedTurn->dni))
                                                    <li>
                                                        <a class="dropdown-item" href="{{ route('pacientes.pendiente_save', $reservedTurn->dni) }}">
                                                            {{ __('Almacenar') }}
                                                        </a>
                                                    </li>
                                                @endunless                                            
                                            @endcan
                                        <li><a class="dropdown-item" href="{{ route('turno.show', $reservedTurn->id) }}">Más información</a></li>
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
