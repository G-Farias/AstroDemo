<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<x-app-layout>
    <x-slot name="header" class="container">
        <div class="row">
            <div class="col d-grid gap-2 d-md-flex">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Especialistas') }}
                </h2>
            </div>     
        </div>
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

<div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @can('isAdmin')
            <div class="py-1">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg"> 
                    <div class="p-3 text-gray-900">
                        <div class="font-semibold text-gray-800 leading-tight">
                            <p>Cantidad de especialistas registrados: {{$q_specialist}} de {{ $limit_q_specialist }}</p>
                        </div>
                    </div>
                </div>
            </div>
            @endcan
            @can('isAdmin')
                <div class="py-1">
            @elsecan('isUser')
             @endcan
                @forelse ($specialists as $specialist)
                    <div class="bg-white shadow-md rounded-xl p-6 max-w-8xl mx-auto mb-4 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                        <!-- Datos del profesional -->
                        <div class="space-y-1 text-sm md:text-base text-gray-700">
                            <p><span class="font-semibold">Nombre/s y apellido/s:</span> {{ucfirst($specialist->nombre) }} {{ ucfirst($specialist->apellido) }}</p>
                            <p><span class="font-semibold">Especialidad:</span> {{ ucfirst($specialist->specialty->nombre_especialidad) }}</p>
                            <p><span class="font-semibold">Días de atención:</span> {{$specialist->dia_atencion}}</p>
                            <p><span class="font-semibold">Horario de atención:</span> {{$specialist->hr_atencion}}</p>
                            <p><span class="font-semibold">D.N.I. / Pasaporte:</span> {{ $specialist->dni }}</p>
                            <p><span class="font-semibold">Celular:</span> {{$specialist->celular}}</p>
                            <p><span class="font-semibold">Teléfono:</span> {{$specialist->telefono}}</p>
                        </div>

                        <!-- Botones de acción -->
                        <div class="flex flex-wrap gap-2 shrink-0">
                                <x-success-a  href="{{ route('especialistas.show', $specialist) }}">{{ __('Ver más') }}</x-success-a>
                                <x-primary-a href="{{ route('especialistas.obras_sociales', $specialist) }}">{{__('Agregar obras sociales')}}</x-primary-a>

                                @can('isAdmin')
                                    <x-primary-a href="{{ route('especialistas.horario_atencion', $specialist) }}">{{__('Agregar turnos de atención')}}</x-primary-a>
                                @endcan

                                    <x-confirm-delete
                                    :id="$specialist->id "
                                    :route="route('especialistas.destroy', $specialist)"
                                    title="Eliminar especialista"
                                    :message="'¿Seguro que querés eliminar al especialista '. ucfirst($specialist->nombre)  .' '.ucfirst($specialist->apellido).'?'"
                                    button="Eliminar"
                                    label="Eliminar"
                                    />
                        </div>
                    </div>
                 @empty 
            <div class="py-1">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg"> 
                    <div class="p-3 text-gray-900">
                        <div class="font-semibold text-gray-800 leading-tight">
                                {{__('No hay especialistas registrados.')}}
                        </div>
                    </div>
                </div>
            </div>
                 @endforelse
            </div>
            <div class="py-3">
                {{$specialists->links()}}
            </div>





        </div>
    </div>
</x-app-layout>
