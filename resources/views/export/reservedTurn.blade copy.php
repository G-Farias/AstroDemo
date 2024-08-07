
    <table>
        <thead>
          <tr>
            <th >Nombre</th>
            <th >Apellido</th>
            <th >D.N.I</th>
            <th >Celular</th>
            <th >Teléfono</th>
            <th >Email</th>
            <th >Obra social</th>
            <th >Numero afilíado</th>
            <th >Fecha y hora</th>
            <th >Especialista</th>
            <th >Especialidad</th>

          </tr>
        </thead>
        <tbody>
    @foreach ($turn as $turn)
     @foreach ($schedules as $schedule)
      @if ($schedule->id == $turn->id_horario_atencion)
        <tr>
          <td>{{ucfirst($turn->nombre)}}</td>
          <td>{{ucfirst($turn->apellido)}}</td>
          <td>{{$turn->dni}}</td>
          <td>{{$turn->celular}}</td>
          <td>{{$turn->telefono}}</td>
          <td>{{$turn->email}}</td>
          <td>{{ucfirst($turn->medicalInsurence?->nombre_obraSocial)}}</td>
          <td>{{$turn->numero_obraSocial}}</td>
          <td data-title="Fecha y hora">{{ date("d-m-y",strtotime($schedule->fecha_atencion)) }}<br>{{ date("H:i",strtotime($schedule->hr_atencion)) }}</td>
          <td>{{ ucfirst($schedule->specialist->nombre) }} {{ucfirst($schedule->specialist->apellido)}}</td>
          <td>{{ucfirst($schedule->specialty->nombre_especialidad)}}</td>
        </tr>

            @endif
        @endforeach
    @endforeach
</tbody>
</table>
