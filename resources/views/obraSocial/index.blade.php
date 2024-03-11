<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<x-app-layout>
    <x-slot name="header" class="container">
        <h2 class="mb-2 font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Obras sociales / Prepagas') }}
        </h2>
        <div class="col d-grid gap-2 d-md-flex justify-content-md-end">
            <x-primary-a href="{{ route('obraSocial.create') }}">{{ __('Registrar obra social / prepaga') }}</x-primary-a>
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
                @foreach ($medicalInsurences as $medicalInsurence)
                <div class="card border-light">
        
                    <div class="card-body">
                      <p class="card-text"><strong>Obra social / Prepaga : </strong> {{ucfirst($medicalInsurence->nombre_obraSocial) }}</p>
                      <p class="card-text"><strong>Monto : </strong> {{ $medicalInsurence->precio_obraSocial }}</p> 
                      <p class="card-text"><strong>Información adicional : </strong>{{$medicalInsurence->info_obraSocial}}</p>

                      <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <x-third-a href="{{ route('obraSocial.edit', $medicalInsurence) }}">{{__('Editar')}}</x-third-a>
                        <form class="mb-0 " action="{{ route('obraSocial.destroy', $medicalInsurence) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <x-danger-button onclick="return confirm('¿Estás seguro que quieres eliminar a {{ $medicalInsurence->nombre }} ?')">{{ __('Eliminar') }}</x-danger-button>
                        </form>
                      </div>
                    </div>
                 </div>
                 @endforeach

                 {{ $medicalInsurences->links() }}

            </div>
        </div>
    </div>
</x-app-layout>
