<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar especialidad') }}
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
                <div class="p-6 text-gray-900">

                  <form action="{{ route('especialidad.update', $specialty )}}" method="post">  
                    <div class="input-group mb-3">
                        @csrf
                        @method('PUT')
                          <div class="input-group mb-3">
                            <input type="text" value="{{ ucfirst($specialty->nombre_especialidad) }}" name="nombre_especialidad" id="nombre_especialidad" required class="form-control rounded border-gray-300  shadow-sm focus:ring-indigo-500" placeholder="Nombre especialidad" aria-label="Nombre especialidad">
                          </div>

                          <div class="input-group mb-3">
                            <select name="sobreturno" id="sobreturno"  class="form-control rounded border-gray-300  shadow-sm focus:ring-indigo-500">
                              <option disabled>¿Puede hacer sobreturnos?</option>
                              <option selected value="{{ $specialty->sobreturno }}">
                                @if ($specialty->sobreturno == '1')
                                    Si
                                @else
                                   No 
                                @endif
                                </option>
                              <option value="1">SI</option>
                              <option value="0">No</option>
                            </select>
                          </div>
                        
                          <x-success-button>{{ __('Guardar') }}</x-success-button>
                          <x-primary-a href="{{ route('especialidad.index') }}">{{ __('Volver') }}</x-primary-a>

                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
