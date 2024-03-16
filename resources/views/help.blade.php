<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<x-app-layout>
    <x-slot name="header" class="container">
        <h2 class="mb-2 font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Guía de uso') }}
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
            @can('isAdmin')
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg"> 
                <div class="card border-light">
                    <div class="card-body">
                        <header class="mb-3">
                            <h4 class="fs-3 text-gray-900 mb-1">
                              {{ __('Guía de inicio') }}
                            </h4>
                            <p class="text-sm text-gray-600 mb-2">
                              {{ __("Aquí encontrarás la información para poder comenzar a utilizar tu sistema.") }}
                            </p>
                          </header>
                          <p class="mb-2 text-m text-gray">
                              - Al comenzar lo primero que se necesita hacer es crear una nueva especialidad, en la pestaña <strong>Especialidad</strong>. <br>
                              - Después, puedes crear el primer especialista, en la pestaña <strong>Especialista->registrar especialista</strong>.<br>
                              - Una vez  creado, se recomienda  en la pestaña <strong>Obra social</strong> crear todas las obras sociales o prepagas que atienda el centro médico o los especialistas, comenzando por crear una que se llame <strong>particular</strong> o <strong>no dispone</strong>. <br>
                              - Después de ese paso, se deben agregar a cada especialista creado. Yendo a la pestaña <strong>Especialistas -> agregar obras sociales</strong> y deberás seleccionar las que el especialista utiliza en su atención.<br>
                              - Una vez hecho todos estos pasos, se podrán crear los turnos para reservar en la pestaña <strong>Especialistas-> agregar turnos de atención</strong>.<br>
                            </p>
                    </div>
                 </div>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-1"> 
                <div class="card border-light">
                    <div class="card-body">
                        <header class="mb-3">
                            <h4 class="fs-3 text-gray-900 mb-1">
                              {{ __('Consideraciones  importantes administrativo') }}
                            </h4>
                            <p class="text-sm text-gray-600 mb-2">
                              {{ __("Aquí encontrarás consideraciones  importantes para tener en cuenta al uso.") }}
                            </p>
                          </header>
                          <p class="mb-2 text-m text-gray">
                            - Al reservar un turno (desde el lado administrativo), el paciente será registrado automáticamente si no está registrado. <br>
                            - El <strong>D.N.I. / Pasaporte</strong> será utilizado como ID a la hora de modificar, eliminar o ver turnos. <strong>Se recomienda completar correctamente.</strong><br>
                           - El nombre, apellido, día y horario de atención es visible a las vistas del público, se recomienda completar correctamente y sin errores ortográficos.<br>
                            - Los turnos un día posterior se borran automáticamente, para más optimización. <br>
                            - Los turnos serán notificados dos días previos a la fecha.<br>
                            - Las obras sociales y especialidades se recomiendan <strong>NO REPETIR.</strong><br>
                          </p>
                    </div>
                 </div>
            </div>
@elsecan('isUser')
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-1"> 
                <div class="card border-light">
                    <div class="card-body">
                        <header class="mb-3">
                            <h4 class="fs-3 text-gray-900 mb-1">
                              {{ __('Consideraciones  importantes especialista') }}
                            </h4>
                            <p class="text-sm text-gray-600 mb-2">
                              {{ __("Aquí encontrarás consideraciones o consejos de uso para el modo especialista.") }}
                            </p>
                          </header>
                          <p class="mb-2 text-m text-gray">
                            - Al reservar un turno (desde el lado especialista), el paciente será registrado automáticamente si no está registrado. <br>
                            - El <strong>D.N.I. / Pasaporte</strong> será utilizado como ID a la hora de modificar, eliminar o ver turnos. <strong>Se recomienda completar correctamente.</strong><br>
                            - El nombre, apellido, día y horario de atención es visible a las vistas del público, se recomienda completar correctamente y sin errores ortográficos.<br>
                            - Los turnos serán notificados dos días previos a la fecha.<br>
                            - Solo se muestran los pacientes del especialista logueado.<br>
                            - El botón de agregar turnos está en la vista <strong>Turnos->agregar turnos de atención</strong>.<br>
                            - Solo se verán los turnos reservados del especialista logueado. <br>
                          </p>
                    </div>
                 </div>
            </div>
        </div>
    </div>
@endcan
@can('isAdmin')
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-1"> 
    <div class="card border-light">
        <div class="card-body">
            <header class="mb-3">
                <h4 class="fs-3 text-gray-900 mb-1">
                  {{ __('Consideraciones  importantes especialista') }}
                </h4>
                <p class="text-sm text-gray-600 mb-2">
                  {{ __("Aquí encontrarás consideraciones o consejos de uso para el modo especialista.") }}
                </p>
              </header>
              <p class="mb-2 text-m text-gray">
                - Al reservar un turno (desde el lado especialista), el paciente será registrado automáticamente si no está registrado. <br>
                - El <strong>D.N.I. / Pasaporte</strong> será utilizado como ID a la hora de modificar, eliminar o ver turnos. <strong>Se recomienda completar correctamente.</strong><br>
                - El nombre, apellido, día y horario de atención es visible a las vistas del público, se recomienda completar correctamente y sin errores ortográficos.<br>
                - Los turnos serán notificados dos días previos a la fecha.<br>
                - Solo se muestran los pacientes del especialista logueado.<br>
                - El botón de agregar turnos está en la vista <strong>Turnos->agregar turnos de atención</strong>.<br>
                - Solo se verán los turnos reservados del especialista logueado. <br>
              </p>
        </div>
     </div>
</div>
</div>
</div>
@endcan
</x-app-layout>
