<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<x-app-layout>
    <x-slot name="header" >
        <div class="row">
            <div class="col d-grid gap-2 d-md-flex ">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Paciente') }}: {{ucfirst($patient->nombre) }} {{ ucfirst($patient->apellido) }}
                </h2>
            </div>            
            <div class="col-3 d-grid gap-2 d-md-flex justify-content-md-end">
                <x-success-a href="{{ route('pacientes.index') }}">{{ __('Volver') }}</x-success-a>
            </div>
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
  @if (session('success'))
    <div class="alert alert-success">
       {{ session('success') }}
    </div>
  @endif
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">


<div class="max-w-5xl mx-auto bg-white shadow rounded-xl p-6 space-y-4 text-sm md:text-base ">
  <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-2 gap-x-6 ">
    <div>  <h2 class="text-2xl md:text-3xl font-semibold text-gray-800 border-b border-gray-200 pb-2 mb-4">
    Información del paciente</h2></div> <br>
    <div><span class="font-semibold">Nombre/s y apellido/s:</span> {{ucfirst($patient->nombre) }} {{ ucfirst($patient->apellido) }}</div>
    <div><span class="font-semibold">D.N.I. / Pasaporte:</span>  {{ $patient->dni }}</div>

    <div><span class="font-semibold">Fecha de nacimiento:</span> {{$patient->fecha_nacimiento}}</div>
    <div><span class="font-semibold">Celular:</span> {{$patient->celular}}</div>

    <div><span class="font-semibold">Teléfono:</span> {{$patient->telefono}}</div>
    <div><span class="font-semibold">Email:</span> {{$patient->email}}</div>

    <div><span class="font-semibold">Dirección:</span>{{$patient->direccion}} </div>
    <div><span class="font-semibold">País:</span> {{ucfirst($patient->pais_residencia)}}</div>

    <div><span class="font-semibold">Provincia:</span> {{ucfirst($patient->provincia_residencia)}}</div>
    <div><span class="font-semibold">Localidad:</span> {{ucfirst($patient->localidad_residencia)}}</div>

    <div><span class="font-semibold">Obra Social:</span> {{ucfirst($patient->medicalInsurence?->nombre_obraSocial)}} </div>
    <div><span class="font-semibold">Número obra social:</span>{{$patient->numero_obraSocial}}</div>

    <div class="sm:col-span-2"><span class="font-semibold">Observación:</span> {{$patient->observacion}}</div>
  </div>

  <div class="flex justify-end gap-2 pt-4">
    <x-third-a href="{{ route('pacientes.edit', $patient) }}">{{__('Editar')}}</x-third-a>

    <x-danger-button data-bs-toggle="modal" data-bs-target="#Eliminar{{ $patient->id }}">{{ __('Eliminar') }}</x-danger-button>
    <!-- Modal -->
    <div class="modal fade" id="Eliminar{{ $patient->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <div class="modal-body">
            <p class="modal-title font-bold text-xl mb-2" id="modalEjemploLabel">Eliminar paciente</p>
            ¿Estas seguro que quieres quieres eliminar el siguiente paciente?
        </div>
        <div class="modal-footer border-none">
            <x-primary-button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</x-primary-button>
            <form class="mb-0 " action="{{ route('pacientes.destroy', $patient) }}" method="POST">
                @csrf
                @method('DELETE')
                <x-danger-button class="w-100">{{ __('Eliminar') }}</x-danger-button>
            </form>
        </div>
        </div>
    </div>
    </div>
    <!-- Modal fin -->  
  </div>
</div>


    </div>
</x-app-layout>
