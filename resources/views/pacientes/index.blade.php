<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<x-app-layout>
    <x-slot name="header" class="container">
        <div class="row">
            <div class="col d-grid gap-2 d-md-flex ">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pacientes') }}
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
            <div class="bg-white mb-1 overflow-hidden shadow-sm sm:rounded-lg"> 
                <div class="p-6 text-gray-900">
                    <form action="{{ route('pacientes.buscar')}}" method="get">
                        @csrf
                        <header class="mb-3">
                            <h2 class="text-lg font-medium text-gray-900">
                              {{ __('Buscar paciente') }}
                            </h2>
                          </header>
                    <div class="input-group mb-3">
                        <input type="text" name="busqueda" id="busqueda" required class="form-control rounded-left border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" placeholder="Ingrese D.N.I, nombre o apellido para buscar..." aria-label="Nombre">
                        <x-success-button-non-r class="btn btn-outline-success" href=""><i class="bi bi-search"></i></x-success-button-non-r>                                        

                    </div>
                    </form>
                </div>
            </div>
            <div class="py-1 mb-1">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg"> 
                    <div class="p-4 text-gray-900 row">
                        <div class="col font-semibold text-gray-800 leading-tight">
                            <p>Cantidad de pacientes registrados: {{$q_patients}}</p>
                        </div>
                        <div class="col d-grid gap-2 d-md-flex justify-content-md-end">
                            <x-primary-a  href="{{ route('generate-patient-pdf') }}" target="_blank"><i class="bi bi-printer-fill"> {{ __('Imprimir') }}</i></x-primary-a>
                            <x-primary-a  href="{{ route('export-patient') }}" target="_blank"><i class="bi bi-file-earmark-excel"> {{ __('Exportar excel') }}</i></x-primary-a>
                        </div>
                    </div>
                </div>
            </div>

    @forelse ($patients as $patient)
    <div class="bg-white shadow rounded-xl p-6 max-w-8xl mx-auto mb-2 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
    <!-- Datos del paciente -->
    <div class="space-y-1 text-sm md:text-base text-gray-700">
        <p><span class="font-semibold">Nombre/s y apellido/s:</span> {{ucfirst($patient->nombre) }} {{ ucfirst($patient->apellido) }}</p>
        <p><span class="font-semibold">D.N.I. / Pasaporte:</span> {{ $patient->dni }}</p>
        <p><span class="font-semibold">Celular:</span> {{$patient->celular}}</p>
        @can('isAdmin')
        <p><span class="font-semibold">Especialista asignado:</span>
        @if($patient->specialist)
        {{ ucfirst($patient->specialist->nombre) }} {{ ucfirst($patient->specialist->apellido) }}
        @else
        Sin especialista asignado
        @endif
        </p>
        @endcan
    </div>

    <!-- Botones -->
    <div class="flex gap-2 shrink-0">
        <x-success-a href="{{ route('pacientes.show', $patient) }}">{{ __('Ver más') }}</x-success-a>
        <x-success-a href="{{ route('pacientes.archivos', $patient) }}">{{ __('Archivos') }}</x-success-a>

        <x-third-a href="{{ route('pacientes.edit', $patient) }}">{{__('Editar')}}</x-third-a>

        <x-confirm-delete
        :id="$patient->id"
        :route="route('pacientes.destroy', $patient)"
        title="Eliminar paciente"
        :message="'¿Seguro que quieres eliminar al paciente ' . $patient->nombre . ' '.$patient->apellido.'?'"
        button="Eliminar"
        label="Eliminar"
        />

    </div>
    </div>

             @empty
            <div class="alert alert-danger">
            {{ __('No se encontraron pacientes') }}
            </div>
    @endforelse
    <div class="py-3">
        {{$patients->links()}}
    </div>
            
        </div>
    </div>
</x-app-layout>
