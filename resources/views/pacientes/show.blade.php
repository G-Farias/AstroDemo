<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Paciente') }}: {{ucfirst($patient->nombre) }} {{ ucfirst($patient->apellido) }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg"> 

                @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

             
                <div class="card">
                    <div class="card-header">
                        Datos personales
                    </div>
                    <div class="card-body">
                      <p class="card-text"><strong>Nombre/s y apellido/s : </strong> {{ucfirst($patient->nombre) }} {{ ucfirst($patient->apellido) }}</p>
                      <p class="card-text"><strong>D.N.I / Pasaporte : </strong> {{ $patient->dni }}</p> 
                      <p class="card-text"><strong>Fecha de nacimiento : </strong>{{$patient->fecha_nacimiento}}</p>
                      <br>
                      <p class="card-text"><strong>Celular : </strong>{{$patient->celular}}</p>
                      <p class="card-text"><strong>Teléfono : </strong>{{$patient->telefono}}</p>
                      <p class="card-text"><strong>Email : </strong>{{$patient->email}}</p>
                      <p class="card-text"><strong>Dirección : </strong>{{$patient->direccion}}</p>
                      <p class="card-text"><strong>País : </strong>{{$patient->pais_residencia}}</p>
                      <p class="card-text"><strong>Provincia : </strong>{{$patient->provincia_residencia}}</p>
                      <p class="card-text"><strong>Localidad : </strong>{{$patient->localidad_residencia}}</p>
                      <br>   
                      <p class="card-text"><strong>Obra Social : </strong>{{$patient->medicalInsurence->nombre_obraSocial}}</p>
                      <p class="card-text"><strong>Numero obra social : </strong>{{$patient->numero_obraSocial}}</p>
                      <br>
                      <p class="card-text"><strong>Observación : </strong>{{$patient->observacion}}</p>



                      <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <x-success-a href="{{ route('pacientes.index') }}">{{ __('Volver') }}</x-success-a>
                        <x-third-a href="{{ route('pacientes.edit', $patient) }}">{{__('Editar')}}</x-third-a>
                        <form class="mb-0 " action="{{ route('pacientes.destroy', $patient) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <x-danger-button onclick="return confirm('Estás seguro que quieres eliminarlo?')">{{ __('Eliminar') }}</x-danger-button>
                        </form>
                      </div>
                    </div>
                 </div>
                 

            </div>
        </div>
    </div>
</x-app-layout>
