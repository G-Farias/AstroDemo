<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col d-grid gap-2 d-md-flex ">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Agregar obras sociales / prepagas que utiliza el especialista') }}
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

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg"> 
                <div class="p-6 text-gray-900">
                    @foreach ($medicalInsurence as $medicalInsurence)
                        <form action="{{ route('especialistas.store_obras_sociales', $specialist)}}" method="post">  
                            @csrf
                                    <div class ="mb-3">
                                        <div class="card">
                                            <div class="card-body">
                                                <input type="text" hidden value="{{ $medicalInsurence->id }}" name="id_obraSocial" id="id_obraSocial" required class="form-control rounded border-gray-300  shadow-sm focus:ring-indigo-500">
                                                <input type="text" hidden value="{{$specialist->id}}" name="id_especialista" id="id_especialista" required class="form-control rounded border-gray-300  shadow-sm focus:ring-indigo-500">
                                                 <h5 class="card-title"><strong> Obra social / prepaga: </strong>{{ ucfirst($medicalInsurence->nombre_obraSocial) }}</h5>
                                                
                                                <div class="d-grid gap-2 d-md-flex justify-content-md-end">                                                        
                                                    <x-success-button >{{ __('Guardar') }}</x-success-button>
                                                </div>
                        </form>
                            @foreach ($medicalInsurenceSpecialists as $medicalInsurenceSpecialist)
                                @if ($medicalInsurenceSpecialist->id_obraSocial == $medicalInsurence->id)
                                <div class="mt-3 d-grid gap-2 d-md-flex justify-content-md-end">
                                    <form class="mb-0 " action="{{ route('especialistas.obra_social_destroy',$medicalInsurenceSpecialist->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <x-danger-button class="w-100" onclick="return confirm('¿Estás seguro que quieres eliminarla?')">{{ __('Eliminar') }}</x-danger-button>
                                    </form>
                                    <x-grey-anunnce class="fst-italic " disabled="true">{{ __('Ya guardado') }}</x-grey-anunnce>
                                </div>
                                @endif 
                            @endforeach
                        </div>
                    </div>
                </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


