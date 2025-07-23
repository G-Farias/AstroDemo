<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<style>
        @media only screen and (max-width:800px) {
            #no-more-tables tbody,
            #no-more-tables tr,
            #no-more-tables td {
                display: block;
         
            }
                #no-more-tables tbody {
                    border: 1px solid #ccc;
                    margin-top: 3%;
                    padding-left: 5%;
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
                padding-top: 5%;
                padding-bottom: 5%; 
                border: none;
                border-bottom: 1px solid #fff;
            }
            #no-more-tables td:before {
                content: attr(data-title);
                position: absolute;
                left: 6px;
                font-weight: bold;

            }
        }
</style>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @can('isAdmin-or-isUser')
                {{ __('Inicio') }}
            @elsecan('isPatient')
                {{ __('Portal del paciente')}}
            @endcan
        </h2>
    </x-slot>
@can('isAdmin-or-isUser')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg"> 
                <div class="p-6 text-gray-900">
                    <div class="row mb-3">
                        <div class="col">
                            <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-2">
                                {{ __('Turnos reservados del día de la fecha') }}
                            </h2>
                        </div>
                        <div class="col d-grid gap-2 d-md-flex justify-content-md-end">
                            <x-primary-a  href="{{ route('generate-turn-hoy') }}" target="_blank"><i class="bi bi-printer-fill"> {{ __('Imprimir turnos de hoy') }}</i></x-primary-a>
                        
                        </div>
                    </div>
                    <div class="overflow-x-auto border rounded-lg table-responsive overflow-visible" id="no-more-tables" >
                        <table class="min-w-full text-sm text-center text-gray-700 table-borderless">
                        <thead class="bg-gray-100 text-gray-800 font-semibold sticky top-0 z-10">
                          <tr>
                            <th class="px-4 py-3" scope="col">Fecha y hora</th>
                            <th class="px-4 py-3" scope="col">Especialista</th>
                            <th class="px-4 py-3" scope="col">Paciente</th>
                            <th class="px-4 py-3" scope="col">Contacto</th>
                            <th class="px-4 py-3" scope="col"></th>
                            <th class="px-4 py-3" scope="col"></th>
                            <th class="px-4 py-3" scope="col"></th>
                          </tr>
                        </thead>
                        @foreach ($reservedTurns as $reservedTurn)
                        <tbody class="border border-gray rounded">                       
                            <tr>
                              <input type="text" name="id" id="id" hidden value="{{ $reservedTurn->id }}">
                              <td class="px-4 py-3" data-title="Fecha y hora :" class="table-borderless">{{ date("d-m-y",strtotime($reservedTurn->schedule?->fecha_atencion)) }}<br>{{ date("H:i",strtotime($reservedTurn->schedule?->hr_atencion)) }}</td>
                              <td class="px-4 py-3" data-title="Especialista :"> <strong>{{ucfirst($reservedTurn->schedule?->specialty->nombre_especialidad)}}</strong> <br> {{ ucfirst($reservedTurn->schedule?->specialist->nombre) }} {{ucfirst($reservedTurn->schedule?->specialist->apellido)}}</td>
                              <td class="px-4 py-3" data-title="Paciente :">{{ ucfirst($reservedTurn->nombre) }} {{ucfirst($reservedTurn->apellido)}} <br>{{$reservedTurn->dni}} </td>
                              <td class="px-4 py-3" data-title="Contacto :">{{ $reservedTurn->celular }}</td>
                               <td colspan="2" class="px-4 py-1 align-middle">
    <div class="border border-gray-300 rounded-lg shadow-sm p-2 bg-white w-full">
        <form action="{{ route('turno.actualizar_estado', $reservedTurn) }}" method="post"
              class="flex flex-col sm:flex-row items-center gap-3 w-full">
            @csrf
            @method('PUT')

            {{-- Select Estado --}}
            <div class="w-full sm:w-48">
                <select required id="estado" name="estado"
                        class="form-select text-sm rounded-lg border border-slate-300 text-slate-700 bg-white pl-3 pr-8 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition duration-300 ease-in-out cursor-pointer w-full">
                    <option selected value="{{ $reservedTurn->estado }}">
                        @switch($reservedTurn->estado)
                            @case(0) Disponible @break
                            @case(1) Reservado @break
                            @case(3) Asistido @break
                            @default Ausente
                        @endswitch
                    </option>
                    <option value="1">Reservado</option>
                    <option value="3">Asistido</option>
                    <option value="4">Ausente</option>
                </select>
            </div>

            {{-- Input Observación --}}
            <div class="flex-1 w-full">
                <input type="text" value="{{ $reservedTurn->observacion }}" name="observacion" id="observacion"
                       placeholder="Observación"
                       class="form-input text-sm rounded-lg border border-slate-300 text-slate-700 px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-indigo-500" />
            </div>

            {{-- Botón Guardar --}}
            <x-success-button-non-r class="btn btn-outline-success">
                <i class="bi bi-floppy"></i>
            </x-success-button-non-r>
        </form>
    </div>
</td>
                         {{--     <td>
                                <form class="mb-0 " action="{{ route('turno.destroy', $reservedTurn) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <x-danger-button onclick="return confirm('¿Estás seguro que quieres eliminar?')"><i class="bi bi-x-lg"></i></x-danger-button>
                                </form>
                              </td>
                              <td>
                                <x-success-a href="{{ route('turno.show', $reservedTurn->id) }}">{{ __('Ver más') }}</x-success-a>
                            </td> --}}
<!-- Modal Bootstrap -->
<div class="modal fade" id="cancelarTurno{{$reservedTurn->id}}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <h5 class="modal-title font-bold text-xl mb-2">Cancelar turno reservado</h5>
                <p>¿Estás seguro de que deseas cancelar el turno del día <br> {{ date("d-m-y",strtotime($reservedTurn->schedule?->fecha_atencion)) }} a las {{ date("H:i",strtotime($reservedTurn->schedule?->hr_atencion)) }}hs?</p>
            </div>
            <div class="modal-footer border-0">
                <x-primary-button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    Cancelar
                </x-primary-button>
                <form class="mb-0 " action="{{ route('turno.destroy', $reservedTurn) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <x-danger-button>Cancelar</x-danger-button>
                </form>
            </div>

        </div>
    </div>
</div>                           
                            <td>
                                <div class="dropdown col d-grid gap-2 d-md-flex justify-content-md-end">
                                    <x-primary-a  href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="bi bi-three-dots"></i>
                                    </x-primary-a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <button class="dropdown-item"  data-bs-toggle="modal" data-bs-target="#cancelarTurno{{$reservedTurn->id}}" style="color:crimson;">Cancelar turno</button>
                                        </li>
                                        <li><a class="dropdown-item" href="{{ route('turno.show', $reservedTurn->id) }}">Más información</a></li>
                                    </ul>
                                </div>
                            </td>
                            </tr>
                          </tbody>  
                          @endforeach                  
                    </table>
                    </div>
                </div>    
            </div>

        </div>
    </div>

@elsecan('isPatient')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg"> 
                <div class="p-6 text-gray-900">
                    <h2 class="mb-2 font-semibold text-xl text-gray-800 leading-tight">
                        {{ __('Mis turnos: ')}}{{ (ucfirst(auth()->user()->name))}} {{ (ucfirst(auth()->user()->surname))}} 
                    </h2>
                    <div class="row">
                        @forelse ($reservedTurns as $reservedTurn)
                        @foreach ($schedules as $schedule)
                        @if ($schedule->id == $reservedTurn->id_horario_atencion)
                        <div class="card border-light-subtle mt-1">
                            <div class="card-body ">
                              <h2 class="card-tittle font-semibold text-xl text-gray-800 leading-tight">
                              </h2>
                              <p class="card-text"><strong>DNI / Pasaporte: </strong>{{$reservedTurn->dni}}</p>
                              <p class="card-text"><strong>Especialidad: </strong>{{ucfirst($schedule->specialty->nombre_especialidad)}}</p>
                              <p class="card-text"><strong>Especialista: </strong>{{ucfirst($schedule->specialist->nombre)}} {{ucfirst($schedule->specialist->apellido)}}</p>
                             
                              <p class="card-text mt-3"><i class="bi bi-calendar-check"></i> <strong>Fecha de atención: </strong>{{date("d-m-y",strtotime($schedule->fecha_atencion))}}</p>
                              <p class="card-text mb-3"><i class="bi bi-clock"></i> <strong>Hora de atención: </strong>{{date("H:i",strtotime($schedule->hr_atencion))}}hs</p>

                              <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <form class="mb-0 " action="{{route('reservarTurno.destroy',$reservedTurn )}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    @if($reservedTurn->estado == '1')
                                    <x-danger-button onclick="return confirm('¿Estás seguro que quieres cancelar el turno seleccionado?')">{{ __('Cancelar turno') }}</x-danger-button>
                                    @elseif($reservedTurn->estado == '3')
                                     <x-grey-anunnce  type="button" class="btn btn-dark" disabled>{{__('Turno ya asistido')}}</x-grey-anunnce> 
                                    @else
                                     <x-grey-anunnce  type="button" class="btn btn-dark" disabled>{{__('Ausente')}}</x-grey-anunnce>
                                    @endif
                                </form>
                              </div>
                            </div>                        
                        </div>
                        @endif
                        @endforeach
                        @empty 
                        <p class="text-muted font-semibold leading-tight">
                            Usted no posee turnos registrados.
                        </p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

    </div>
@endcan
</x-app-layout>
