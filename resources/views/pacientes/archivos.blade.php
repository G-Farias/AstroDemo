<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

<script src="https://cdn.ckeditor.com/ckeditor5/41.3.0/classic/ckeditor.js"></script>


<x-app-layout>
    <x-slot name="header" >
        <div class="row">
            <div class="col d-grid gap-2 d-md-flex ">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Paciente') }}: {{ucfirst($patient->nombre) }} {{ ucfirst($patient->apellido) }}
                </h2>
            </div>            
            <div class="col-3 d-grid gap-2 d-md-flex justify-content-md-end">
                <x-success-a href="{{ route('pacientes.index') }}">{{ __('Volver') }}</x-success-a>
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
                Archivos del paciente</h2></div> <br>

                <form action="{{ route('archivos.guardar', $patient) }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <label for="archivo">Elegir archivo:</label>
                    <input type="file" name="archivo" id="archivo">

                    <!-- <button type="submit">Subir</button>-->
            </div>

            <div class="flex justify-end gap-2 pt-4">
                <x-success-button type="submit">{{ __('Subir') }}</x-success-button> 
            </div>
                </form>
        </div>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 pb-5 mt-5">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg"> 
            <div class="p-6 text-gray-900">
                    <div class="flex justify-end mb-4">
                        @if($orden == 'desc')
                            <a href="{{ route('pacientes.archivos', [$patient, 'orden' => 'asc']) }}"
                            class="bg-blue-600 text-white px-3 py-2 rounded hover:bg-blue-700">
                                Ordenar más viejos primero
                            </a>
                        @else
                            <a href="{{ route('pacientes.archivos', [$patient, 'orden' => 'desc']) }}"
                            class="bg-blue-600 text-white px-3 py-2 rounded hover:bg-blue-700">
                                Ordenar más nuevos primero
                            </a>
                        @endif
                    </div>
            <div class="table-responsive" id="no-more-tables" style="max-height: 400px; overflow-y: auto;">
        <table class="table table-borderless">
            <thead>
            <tr>
                <th scope="col">Nombre</th>
                <th scope="col">Fecha</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
                @foreach($archivos as $archivo)
                <tr>
                    <td data-title="Nombre: ">{{ $archivo->nombre }}</td>
                    <td data-title="Fecha: ">{{ date("d-m-y",strtotime($archivo->updated_at)) }}</td>
                    <td>
                        <x-success-a target="_blank" href="{{ url('storage/app/' . $archivo->ruta) }}">
                            {{ __('Ver') }}
                        </x-success-a>
                    </td>   
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
     <div class="py-3">
        {{$archivos->links() }}
        </div>
    </div>
</div>
    </div>
</x-app-layout>
