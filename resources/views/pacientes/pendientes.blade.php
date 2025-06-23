<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<x-app-layout>
    <x-slot name="header" class="container">
        <div class="row">
            <div class="col d-grid gap-2 d-md-flex ">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pacientes pendientes') }}
                </h2>
            </div>        
          <!--  <div class="col-6 d-grid gap-2 d-md-flex justify-content-md-end">
            @can('isAdmin')
            <x-primary-a href="{{ route('pacientes.pendientes') }}">{{ __('Pacientes pendientes') }}</x-primary-a>
            @endcan
            <x-primary-a href="{{ route('pacientes.create') }}">{{ __('Registrar paciente') }}</x-primary-a>
              </div>
            -->
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
  @if (session('danger'))
  <div class="alert alert-danger">
        {{ session('danger') }}
  </div>
@endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="py-1 mb-1">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg"> 
                    <div class="p-4 text-gray-900 row">
                        <div class="col font-semibold text-gray-800 leading-tight">
                            <p>Cantidad de pacientes pendientes a ser registrados: {{$q_patients}}</p>
                        </div>
                    </div>
                </div>
            </div>

    @foreach ($prePatients as $prePatient)
    <div class="bg-white shadow rounded-xl p-6 max-w-8xl mx-auto mb-2 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
    <!-- Datos del paciente -->
    <div class="space-y-1 text-sm md:text-base text-gray-700">
        <p><span class="font-semibold">Nombre/s y apellido/s:</span> {{ucfirst($prePatient->name) }} {{ ucfirst($prePatient->surname) }}</p>
        <p><span class="font-semibold">D.N.I. / Pasaporte:</span> {{ $prePatient->user }}</p>
    </div>

    <!-- Botones -->
    <div class="flex gap-2 shrink-0">
        <x-success-a href="{{ route('pacientes.pendiente_save', $prePatient->user ) }}">{{ __('Guardar') }}</x-success-a>
    </div>
    </div>
    @endforeach

            
        </div>
    </div>
</x-app-layout>
