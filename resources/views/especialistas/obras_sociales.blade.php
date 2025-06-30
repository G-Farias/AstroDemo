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

    @php
        $yaExiste = $medicalInsurenceSpecialists->contains(function ($item) use ($medicalInsurence) {
            return $item->id_obraSocial == $medicalInsurence->id;
        });
    @endphp

    <div class="mb-3">
        <div class="card">
            <div class="card-body">

                <h5 class="card-title">
                    <strong>Obra social / prepaga:</strong> {{ ucfirst($medicalInsurence->nombre_obraSocial) }}
                </h5>

                @if (!$yaExiste)
                    {{-- Si NO está registrada, muestro formulario para guardar --}}
                    <form action="{{ route('especialistas.store_obras_sociales', $specialist) }}" method="POST">
                        @csrf
                        <input type="hidden" name="id_obraSocial" value="{{ $medicalInsurence->id }}">
                        <input type="hidden" name="id_especialista" value="{{ $specialist->id }}">

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <x-success-button>{{ __('Guardar') }}</x-success-button>
                        </div>
                    </form>
                @else
                    {{-- Si YA está registrada, muestro botón eliminar y mensaje --}}
                    @php
                        // Busco la relación concreta para eliminar
                        $relation = $medicalInsurenceSpecialists->firstWhere('id_obraSocial', $medicalInsurence->id);
                    @endphp

                    <div class="mt-3 d-grid gap-2 d-md-flex justify-content-md-end">
                                <x-confirm-delete
                            :id="$relation->id"
                            :route="route('especialistas.obra_social_destroy', $relation)"
                            title="Eliminar obra social/prepaga"
                            :message="'¿Seguro que quieres eliminar la obra social/prepaga '.$relation->medicalInsurence->nombre_obraSocial.'?'"
                            button="Eliminar"
                            label="Eliminar"
                            />
                        <x-grey-anunnce class="fst-italic" disabled>
                            {{ __('Ya guardado') }}
                        </x-grey-anunnce>
                    </div>
                @endif

            </div>
        </div>
    </div>

@endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


