<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<x-app-layout>
    <x-slot name="header" class="container">
        <h2 class="mb-2 font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Especialidad') }}
        </h2>
        <div class="col d-grid gap-2 d-md-flex justify-content-md-end">
            <x-primary-a href="{{ route('especialidad.create') }}">{{ __('Registrar especialidad') }}</x-primary-a>
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
                @forelse ($specialtys as $specialty)
                <div class="card border-light">
                    <div class="card-body">
                      <p class="card-text"><strong>Nombre de la especialidad : </strong> {{ucfirst($specialty->nombre_especialidad) }}</p>
                      <p class="card-text"><strong>¿Se pueden hacer sobreturnos? : </strong>
                        @if ($specialty->sobreturno == '1')
                            Si
                        @else
                            No
                        @endif
                        </p> 


                      <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-3">
                        <x-third-a href="{{ route('especialidad.edit', $specialty) }}">{{__('Editar')}}</x-third-a>
                        <form class="mb-0 " action="{{ route('especialidad.destroy', $specialty) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <x-danger-button onclick="return confirm('¿Estás seguro que quieres eliminar la especialidad {{ $specialty->nombre_especialidad }} ?')">{{ __('Eliminar') }}</x-danger-button>
                        </form>
                      </div>
                    </div>
                 </div>
                 @empty 
                 <h2 class="mt-3 mb-3 ml-3 font-semibold text-l text-gray-800 leading-tight">
                    {{__('No hay especialidades registradas.')}}
                </h2>
                 @endforelse

                 {{ $specialtys->links() }}

            </div>
        </div>
    </div>
</x-app-layout>
