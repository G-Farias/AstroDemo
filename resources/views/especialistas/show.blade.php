<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Especialista') }}: {{ucfirst($specialist->nombre) }} {{ ucfirst($specialist->apellido) }}
        </h2>
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
                <div class="card">
                    <div class="card-header">
                        Datos personales
                    </div>
                    <div class="card-body">
                      <p class="card-text"><strong>Nombre/s y apellido/s : </strong> {{ucfirst($specialist->nombre) }} {{ ucfirst($specialist->apellido) }}</p>
                      <p class="card-text"><strong>D.N.I / Pasaporte : </strong> {{ $specialist->dni }}</p> 
                      <p class="card-text"><strong>Matrícula : </strong>{{$specialist->matricula}}</p>
                      <br>
                      <p class="card-text"><strong>Celular : </strong>{{$specialist->celular}}</p>
                      <p class="card-text"><strong>Teléfono : </strong>{{$specialist->telefono}}</p>
                      <p class="card-text"><strong>Email : </strong>{{$specialist->email}}</p>
                      <p class="card-text"><strong>Provincia : </strong>{{$specialist->provincia_residencia}}</p>
                      <p class="card-text"><strong>Localidad : </strong>{{$specialist->localidad_residencia}}</p>
                      <br>   
                      <p class="card-text"><strong>Días de atención : </strong>{{$specialist->dia_atencion}}</p>
                      <p class="card-text"><strong>Horario de atención : </strong>{{$specialist->hr_atencion}}</p>
                      <p class="card-text"><strong>Especialidad : </strong>{{$specialist->especialidad}}</p>
                      


                      <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <x-success-a href="{{ route('especialistas.index') }}">{{ __('Volver') }}</x-success-a>
                        <x-third-a href="{{ route('especialistas.edit', $specialist) }}">{{__('Editar')}}</x-third-a>
                        <form class="mb-0 " action="{{ route('especialistas.destroy', $specialist) }}" method="POST">
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
