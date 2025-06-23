<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col d-grid gap-2 d-md-flex ">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Especialista') }}: {{ucfirst($specialist->nombre) }} {{ ucfirst($specialist->apellido) }}
                </h2>
            </div>            
            <div class="col-3 d-grid gap-2 d-md-flex justify-content-md-end">
                <x-success-a href="{{ route('especialistas.index') }}">{{ __('Volver') }}</x-success-a>
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
    Información del especialista</h2></div> <br>
    <div><span class="font-semibold">Nombre/s y apellido/s:</span> {{ucfirst($specialist->nombre) }} {{ ucfirst($specialist->apellido) }}</div>
    <div><span class="font-semibold">D.N.I. / Pasaporte:</span>  {{ $specialist->dni }}</div>
    <div><span class="font-semibold">Matrícula: </span>{{$specialist->matricula}}</div>
    <div><span class="font-semibold">Especialidad:</span> {{ucfirst($specialist->specialty->nombre_especialidad)}}</div>


    <div><span class="font-semibold">Celular:</span> {{$specialist->celular}}</div>
    <div><span class="font-semibold">Teléfono:</span> {{$specialist->telefono}}</div>
    <div><span class="font-semibold">Email:</span> {{$specialist->email}}</div>

    <div><span class="font-semibold">Provincia:</span> {{ucfirst($specialist->provincia_residencia)}}</div>
    <div><span class="font-semibold">Localidad:</span> {{ucfirst($specialist->localidad_residencia)}}</div>

    <div><span class="font-semibold">Día de antención:</span> {{$specialist->dia_atencion}}</div>
    <div><span class="font-semibold">Horario de atención:</span> {{$specialist->hr_atencion}}</div>
    <div><span class="font-semibold">Obra social / prepaga: </span> 
                    @foreach ($medicalInsurenceSpecialists as $medicalInsurenceSpecialist)
                    {{ucfirst($medicalInsurenceSpecialist->medicalInsurence?->nombre_obraSocial)}}
                    @endforeach</div>
    <div><span class="font-semibold"></span></div>
 
  </div>

  <div class="flex justify-end gap-2 pt-4">
        <x-third-a href="{{ route('especialistas.edit', $specialist) }}">{{__('Editar')}}</x-third-a>
<!-- 
        <form class="mb-0 " action="{{ route('especialistas.destroy', $specialist) }}" method="POST">
            @csrf
            @method('DELETE')
            <x-danger-button class="w-100" onclick="return confirm('Estás seguro que quieres eliminarlo?')">{{ __('Eliminar') }}</x-danger-button>
        </form> -->

        <x-confirm-delete
        :id="$specialist->id "
        :route="route('especialistas.destroy', $specialist)"
        title="Eliminar especialista"
        :message="'¿Seguro que quieres eliminar al siguiente especialista?'"
        button="Eliminar"
        label="Eliminar"
        />
  </div>
</div>

            </div>
        </div>
    </div>
</x-app-layout>
