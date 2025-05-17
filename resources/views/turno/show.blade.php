<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<x-app-layout>
    <x-slot name="header" class="container">    
        <div class="col d-grid gap-2 d-md-flex justify-content-md-end">
        @can('isAdmin')
            <x-primary-a href="{{ route('turno.reservados') }}">{{ __('Volver') }}</x-primary-a>
        @elsecan('isUser')
        <x-primary-a href="{{ route('turno.reservados') }}">{{ __('Volver') }}</x-primary-a>
        @endcan
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
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-2">
                        {{ __('Información del turno') }} 
                    </h2>
                        <p class="card-text"><strong>Fecha : </strong>{{ date("d-m-y",strtotime($reservedTurn->schedule?->fecha_atencion)) }}</p>
                        <p class="card-text"><strong>Hora : </strong>{{ date("H:i",strtotime($reservedTurn->schedule?->hr_atencion)) }}</p>
                        <p class="card-text"><strong>Nombre y Apellido : </strong>{{ ucfirst($reservedTurn->nombre) }} {{ ucfirst($reservedTurn->apellido) }}</p>
                        <p class="card-text"><strong>DNI/Pasaporte : </strong>{{$reservedTurn->dni}}</p>
                        <p class="card-text"><strong>Celular : </strong>{{ $reservedTurn->celular }}</p>
                        <p class="card-text"><strong>Email : </strong>{{ $reservedTurn->email }}</p>
                        <p class="card-text"><strong>Obra social : </strong>{{ ucfirst($reservedTurn->medicalInsurence?->nombre_obraSocial)}} </p>
                        <p class="card-text"><strong>Afiliado n° : </strong>{{ $reservedTurn->numero_obraSocial }}</p>
                        <p class="card-text"><form action="{{ route('turno.actualizar_estado', $reservedTurn ) }}" method="post">
                            
                     
                            <div class="input-group mb-3 mt-3">
                                 @csrf
                                    @method('PUT')
                                        <span class="input-group-text">Estado</span>
                                        <form action="{{ route('turno.actualizar_estado', $reservedTurn ) }}" method="post">
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
                                  <x-success-button-non-r  class="btn btn-outline-success"><i class="bi bi-floppy"></i></x-success-button-non-r>
                                </div>

                                <div class="input-group">
                                    <span class="input-group-text rounded-0">Observación</span>
                                        @csrf
                                        @method('PUT')
                                        <input value="{{$reservedTurn->observacion}}" name="observacion" id="observacion" class="form-control text-indigo-600 shadow-sm focus:ring-indigo-500"/>
                                  <x-success-button-non-r  class="btn btn-outline-success"><i class="bi bi-floppy"></i></x-success-button-non-r>
                             </form>
                                </div>
                       
                       
                             <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                                  <form class="mb-0 " action="{{ route('turno.destroy_turno', $reservedTurn) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <x-danger-button onclick="return confirm('¿Estás seguro que quieres eliminar?')">Cancelar turno</x-danger-button>
                                </form>
                            </div>
                        
                </div>    
            </div>
        </div>
    </div>
</x-app-layout>
