<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<x-app-layout>
    <x-slot name="header" class="container">
        <h2 class="mb-2 font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Especialistas') }}
        </h2>
        @can('isAdmin')
        <div class="col d-grid gap-2 d-md-flex justify-content-md-end">
            <x-primary-a href="{{ route('especialistas.create') }}">{{ __('Registrar especialista') }}</x-primary-a>
        </div>
        @endcan
    </x-slot>
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
@can('isAdmin')
<div class="py-4">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg"> 
        <div class="p-4 text-gray-900">
            <div class="font-semibold text-gray-800 leading-tight">
                <p>Cantidad de especialistas registrados: {{$q_specialist}}</p>
            </div>
        </div>
    </div>
</div>
@endcan
@can('isAdmin')
    <div class="py-3">
@elsecan('isUser')
<div class="py-12">

@endcan
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg"> 
                @foreach ($specialists as $specialist)
                <div class="card border-light">
                    <div class="card-body">
                      <p class="card-text"><strong>Nombre/s y apellido/s : </strong> {{ucfirst($specialist->nombre) }} {{ ucfirst($specialist->apellido) }}</p>
                      <p class="card-text"><strong>Especialidad : </strong> {{ ucfirst($specialist->specialty->nombre_especialidad) }}</p> 
                      <p class="card-text"><strong>Días de atención : </strong> {{$specialist->dia_atencion}}</p> 
                      <p class="card-text"><strong>Horario de atención : </strong> {{$specialist->hr_atencion}}</p> 
                      <p class="card-text"><strong>D.N.I / Pasaporte : </strong> {{ $specialist->dni }}</p> 
                      <p class="card-text"><strong>Celular : </strong>{{$specialist->celular}}</p>
                      <p class="card-text"><strong>Teléfono : </strong>{{$specialist->telefono}}</p>

                      <div class="mt-2 d-grid gap-2 d-md-flex justify-content-md-end">
                        <x-success-a href="{{ route('especialistas.show', $specialist) }}">{{ __('Ver más') }}</x-success-a>
                        <x-third-a href="{{ route('especialistas.edit', $specialist) }}">{{__('Editar')}}</x-third-a>
                        <form class="mb-0 " action="{{ route('especialistas.destroy', $specialist) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <x-danger-button onclick="return confirm('¿Estás seguro que quieres eliminar a {{ $specialist->nombre }} {{ $specialist->apellido }}?')">{{ __('Eliminar') }}</x-danger-button>
                        </form>
                        <x-primary-a href="{{ route('especialistas.obras_sociales', $specialist) }}">{{__('Agregar obras sociales')}}</x-primary-a>
                        @can('isAdmin')
                        <x-primary-a href="{{ route('especialistas.horario_atencion', $specialist) }}">{{__('Agregar turnos de atención')}}</x-primary-a>
                        @endcan
                      </div>
                    </div>
                 </div>
                 @endforeach


            </div>
        </div>
    </div>
</x-app-layout>
