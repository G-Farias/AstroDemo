<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<x-app-layout>
    <x-slot name="header" class="container">
        <div class="row">
            <div class="col d-grid gap-2 d-md-flex ">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Obras sociales / Prepagas') }}
                </h2>
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
                @forelse ($medicalInsurences as $medicalInsurence)
                    <div class="bg-white shadow-md rounded-xl p-6 max-w-8xl mx-auto mb-4 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                    <!-- Datos del profesional -->
                    <div class="space-y-1 text-sm md:text-base text-gray-700">
                        <p><span class="font-semibold">Obra social / Prepaga :</span> {{ucfirst($medicalInsurence->nombre_obraSocial) }}</p>
                        <p><span class="font-semibold">Monto :</span> {{ $medicalInsurence->precio_obraSocial }}</p>
                        <p><span class="font-semibold">Información adicional :</span> {{$medicalInsurence->info_obraSocial}}</p>
                    </div>

                    <!-- Botones de acción -->
                    <div class="flex flex-wrap justify-end gap-2 shrink-0">
                        <x-third-a href="{{ route('obraSocial.edit', $medicalInsurence) }}">{{__('Editar')}}</x-third-a>
                            <form class="mb-0 " action="{{ route('obraSocial.destroy', $medicalInsurence) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <x-danger-button class="w-100" onclick="return confirm('¿Estás seguro que quieres eliminar a {{ $medicalInsurence->nombre }} ?')">{{ __('Eliminar') }}</x-danger-button>
                        </form>
                        
                    </div>
                    </div>
                 @empty 
                 <h2 class="mt-3 mb-3 ml-3 font-semibold text-l text-gray-800 leading-tight">
                    {{__('No hay obras sociales o prepagas registradas.')}}
                </h2>
                 @endforelse
            </div>
            <div class="py-3">
                {{ $medicalInsurences->links() }}
            </div>
    </div>
</x-app-layout>
