<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<x-app-layout>
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
                padding-top: 3%;
                padding-bottom: 3%; 
                
                
            /*    border: none;
                border-bottom: 1px solid #eee; */
            }
            #no-more-tables td:before {
                content: attr(data-title);
                position: absolute;
                left: 6px;
                font-weight: bold;
                padding-left: 6%;
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
    <x-slot name="header">
        <div class="row">
            <div class="col d-grid gap-2 d-md-flex ">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                     {{ __('Turnos disponibles para reservar') }}
                </h2>
            </div>            
    </x-slot>  



@can('isAdmin')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg"> 
                <div class="p-6 text-gray-900">
                    <form action="{{ route('turno.busqueda_fecha')}}" method="get">  
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
                         <x-success-button-non-r class="btn btn-outline-success"><i class="bi bi-search"></i></x-success-button-non-r>
                        </div>
                        </form>
                    </div>
                </div>   

                <div class="col-sm-6">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-3">
                        {{ __('Buscar turnos por especialidad') }} 
                    </h2>
                    <form action="{{ route('turno.busqueda_especialidad')}}" method="get">
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
                            <x-success-button-non-r class="btn btn-outline-success"><i class="bi bi-search"></i></x-success-button-non-r>
                        </div>
                        </form>
                    </div> 
                </div>
                    
                <div class="col-sm-6">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-3">
                        {{ __('Buscar turnos por especialista') }} 
                    </h2>
                    <form action="{{ route('turno.busqueda_especialista')}}" method="get">
                        @csrf
                    <div class="input-group mb-3">
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Buscar turnos por especialista: </span>
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
                </div>    
            </div>
        </div>
    </div>

@elsecan('isUser')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg"> 
            <div class="p-6 text-gray-900">
                <form action="{{ route('turno.busqueda_fecha')}}" method="get">  
                    @csrf
        <div class="row">
            <div class="col-sm-6 mt-4">
                <div class="input-group ">
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1">Buscar turnos del día </span>
                        <input type="date" name="date" id="date" required class="form-control rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                         <x-success-button-non-r class="btn btn-outline-success"><i class="bi bi-search"></i></x-success-button-non-r>
                    
                    </div>
                    </form>
                </div>
            </div>   
            <div class="col-sm-6 mt-4">
                    <form action="{{ route('turno.busqueda_especialidad')}}" method="get">
                    @csrf 
                <div class="input-group">
                    <input type="text" disabled readonly placeholder="Ver todos los turnos disponibles" class="form-control rounded border-gray-300 text-gray-600 shadow-sm focus:ring-indigo-500">
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






 
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 pb-5">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg"> 
                <div class="p-6 text-gray-900">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-3">
                        {{ __('Reservar turnos') }} 
                    </h2>
                <div class="table-responsive" id="no-more-tables">
                    <table class="table table-borderless"">
                        <thead>
                          <tr>
                            <th scope="col">Fecha</th>
                            <th scope="col">Hora</th>
                            <th scope="col">Especialista</th>
                            <th scope="col">Reservar</th>
                            <th scope="col">Reservar sobreturno</th>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach ($schedules as $schedule)  
                          <tr>
                            <td data-title="Fecha: ">{{ date("d-m-y",strtotime($schedule->fecha_atencion)) }}</td>
                            <td data-title="Hora:" >{{ date("H:i",strtotime($schedule->hr_atencion)) }}hs</td>
                            <td data-title="Especialista:"><strong>{{ucfirst($schedule->specialty->nombre_especialidad)}}</strong> <br>{{ ucfirst($schedule->specialist->nombre) }} {{ucfirst($schedule->specialist->apellido)}}</td>

                            <td data-title="Reservar:">
                                @if ($schedule->estado == '0')
                                 <x-blue-a href="{{ route('turno.create', $schedule) }}">{{ __('Reservar') }}</x-blue-a>
                                @else
                                <x-grey-anunnce>{{__('Reservado')}}</x-grey-anunnce>
                                @endif
                            </td>
                            <td data-title="Sobreturno: ">@if ($schedule->specialty->sobreturno == '0')
                                <x-grey-anunnce>{{__('No disponible')}}</x-grey-anunnce>
                            @else
                            <x-blue-a href="{{ route('turno.create', $schedule) }}">{{ __('Reservar') }}</x-blue-a>
                            @endif</td>
                          </tr>
                        @endforeach
                        </tbody>
                      </table>
                    </div>
                    <div class="py-3">
                        {{$schedules->links() }}
                    </div>
                </div>    
            </div>
        </div>
    </div>
</x-app-layout>
