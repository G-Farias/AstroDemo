<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<x-app-layout>
    <x-slot name="header" class="container">
        <h2 class="mb-2 font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pacientes') }}
        </h2>
        <div class="col d-grid gap-2 d-md-flex justify-content-md-end">
            <x-primary-a href="{{ route('pacientes.create') }}">{{ __('Registrar paciente') }}</x-primary-a>
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
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg"> 
                @foreach ($patients as $patient)
                <div class="card mb-1">
                    <div class="card-header">
                        Paciente
                    </div>
                    <div class="card-body">
                      <p class="card-text"><strong>Nombre/s y apellido/s : </strong> {{ucfirst($patient->nombre) }} {{ ucfirst($patient->apellido) }}</p>
                      <p class="card-text"><strong>D.N.I / Pasaporte : </strong> {{ $patient->dni }}</p> 
                      <p class="card-text"><strong>Celular : </strong>{{$patient->celular}}</p>
                      <p class="card-text"><strong>Teléfono : </strong>{{$patient->telefono}}</p>

                      <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <x-success-a href="{{ route('pacientes.show', $patient) }}">{{ __('Ver más') }}</x-success-a>
                        <x-third-a href="{{ route('pacientes.edit', $patient) }}">{{__('Editar')}}</x-third-a>
                        <form class="mb-0 " action="{{ route('pacientes.destroy', $patient) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <x-danger-button onclick="return confirm('¿Estás seguro que quieres eliminar a {{ $patient->nombre }} {{ $patient->apellido }}?')">{{ __('Eliminar') }}</x-danger-button>
                        </form>
                      </div>
                    </div>
                 </div>
                 @endforeach

                 {{ $patients->links() }}

            </div>
        </div>
    </div>
</x-app-layout>
