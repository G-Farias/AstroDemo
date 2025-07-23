<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

<script src="https://cdn.ckeditor.com/ckeditor5/41.3.0/classic/ckeditor.js"></script>


<x-app-layout>
        <style>
        @media only screen and (max-width:800px) {
            #no-more-tables tbody,
            #no-more-tables tr,
            #no-more-tables td {
                display: block;
            }
              #no-more-tables tbody {
                    border: 1px solid #ccc;
                    margin-top: 2%;
                    padding-top: 2%;

            }

            #no-more-tables thead tr {
                position: absolute;
                top: -9999px;
                left: -9999px;
                
            }
            #no-more-tables td {
                position: relative;
                padding-left: 50%;
                padding-top: 3%;
                padding-bottom: 3%; 
                
                
            /*    border: none;
                border-bottom: 1px solid #eee; */
            }
            #no-more-tables td:before {
                content: attr(data-title);
                position: absolute;
                left: 6px;
                font-weight: bold;
                padding-left: 6%;
            }
            #no-more-tables tr {
                border-bottom: 1px solid #ccc;
            }
        }
    </style>
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
                <div>  <h2 class="text-2xl md:text-3xl font-semibold text-gray-800  border-gray-200 pb-2 mb-4">
                Archivos del paciente</h2></div> <br>

                <form action="{{ route('archivos.guardar', $patient) }}" method="POST" enctype="multipart/form-data">
                    @csrf
            <input
                type="file"
                name="archivo"
                id="archivo"
                class="block w-full text-sm text-gray-700 file:mr-4 file:py-2 file:px-4
                    file:rounded-lg file:border-0
                    file:text-sm file:font-semibold
                    file:bg-gray-900 file:text-white
                    hover:file:bg-gray-700 transition duration-200  cursor-pointer"
            />
                    <!-- <button type="submit">Subir</button>-->
            </div>

                <select required class="form-select w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded pl-3 pr-8 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-400 shadow-sm focus:shadow-md appearance-none cursor-pointer" aria-label="Default select example" name="tipoArchivo" id="tipoArchivo">
                    <option selected disabled value="">Tipo de archivo</option>
                    <option value="1">Historia clinica</option>
                    <option value="2">Evolución</option>
                    <option value="3">Archivo publico (lo puede ver el paciente)</option>
                </select>

            <div class="flex justify-end gap-2 pt-4">
                <x-success-button type="submit">{{ __('Subir') }}</x-success-button> 
            </div>
                </form>


        </div>

   <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
    <div class="bg-white shadow-md rounded-xl p-4 sm:p-6">

   {{-- Contenedor flexible para filtros y botón --}}
<div class="flex flex-col sm:flex-row justify-between items-center gap-4 mb-6">
    
    {{-- Filtros por tipo --}}
    <div class="flex flex-wrap gap-2 sm:gap-3">
        <a href="{{ route('archivos.show', ['patient' => $patient->id, 'tipo' => 1]) }}"
            class="text-center bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 transition text-sm">Historia Clínica</a>
        <a href="{{ route('archivos.show', ['patient' => $patient->id, 'tipo' => 2]) }}"
            class="text-center bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 transition text-sm">Evolución</a>
        <a href="{{ route('archivos.show', ['patient' => $patient->id, 'tipo' => 3]) }}"
            class="text-center bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 transition text-sm">Archivo Público</a>
        <a href="{{ route('archivos.show', ['patient' => $patient->id]) }}"
            class="text-center bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400 transition text-sm">Todos</a>
    </div>

    {{-- Botón de orden --}}
    <div class="w-full sm:w-auto">
        <a href="{{ route('pacientes.archivos', [$patient, 'orden' => $orden === 'desc' ? 'asc' : 'desc']) }}"
            class="inline-flex items-center gap-2 bg-blue-600 text-white text-sm font-medium px-4 py-2 rounded hover:bg-blue-700 transition w-full sm:w-auto text-center justify-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h11M3 6h11m-7 8h11m-7 4h11" />
            </svg>
            {{ $orden === 'desc' ? 'Ordenar más viejos primero' : 'Ordenar más nuevos primero' }}
        </a>
    </div>
</div>


        {{-- Tabla para pantallas grandes --}}
<div class="hidden sm:block">
    <div class="overflow-x-auto rounded-lg border">
        <table class="min-w-full text-sm text-left text-gray-700">
            <thead class="bg-gray-100 text-gray-800 font-semibold">
                <tr>
                    <th class="px-4 py-3">Nombre</th>
                    <th class="px-4 py-3">Tipo</th>
                    <th class="px-4 py-3">Fecha</th>
                    <th class="px-4 py-3 text-right">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($archivos as $archivo)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-3 break-all">{{ $archivo->nombre }}</td>
                        <td class="px-4 py-3">
                            @switch($archivo->tipoArchivo)
                                @case('1') Historia Clínica @break
                                @case('2') Evolución @break
                                @default Archivo público
                            @endswitch
                        </td>
                        <td class="px-4 py-3">{{ date('d-m-y', strtotime($archivo->updated_at)) }}</td>
                        <td class="px-4 py-3">
                            <div class="flex justify-end gap-2">
                                <a href="{{ url('storage/app/' . $archivo->ruta) }}" target="_blank"
                                    class="inline-flex items-center justify-center px-3 py-1.5 bg-green-600 text-white text-xs font-medium rounded hover:bg-green-700 transition">
                                    Ver
                                </a>
                                <x-confirm-delete
                                    :id="$archivo->id"
                                    :route="route('archivos.destroy', [$patient, $archivo])"
                                    title="Eliminar archivo"
                                    :message="'¿Seguro que quieres eliminar el archivo ' . $archivo->nombre . '?'"
                                    button="Eliminar"
                                    label="Eliminar"
                                />
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- Tarjetas para pantallas chicas (mobile) --}}
<div class="sm:hidden flex flex-col gap-4">
    @foreach($archivos as $archivo)
        <div class="border rounded-lg p-4 shadow-sm bg-white">
            <div class="mb-2">
                <span class="font-semibold">Nombre: </span>{{ $archivo->nombre }}
            </div>
            <div class="mb-2">
                <span class="font-semibold">Tipo: </span>
                @switch($archivo->tipoArchivo)
                    @case('1') Historia Clínica @break
                    @case('2') Evolución @break
                    @default Archivo público
                @endswitch
            </div>
            <div class="mb-4">
                <span class="font-semibold">Fecha: </span>{{ date('d-m-y', strtotime($archivo->updated_at)) }}
            </div>
            <div class="flex flex-col gap-2">
                <a href="{{ url('storage/app/' . $archivo->ruta) }}" target="_blank"
                    class="inline-flex justify-center px-4 py-2 bg-green-600 text-white text-sm font-medium rounded hover:bg-green-700 transition">
                    Ver archivo
                </a>
                <x-confirm-delete
                    :id="$archivo->id"
                    :route="route('archivos.destroy', [$patient, $archivo])"
                    title="Eliminar archivo"
                    :message="'¿Seguro que quieres eliminar el archivo ' . $archivo->nombre . '?'"
                    button="Eliminar"
                    label="Eliminar"
                />
            </div>
        </div>
    @endforeach
</div>


        {{-- Paginación --}}
        <div class="mt-6">
            {{ $archivos->links() }}
        </div>
    </div>
</div>

</x-app-layout>
