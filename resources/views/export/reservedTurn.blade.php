
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
     @foreach ($reservedTurns as $reservedTurns)
        <tr>
          <td>{{ucfirst($reservedTurns->nombre)}}</td>
          <td>{{ucfirst($reservedTurns->apellido)}}</td>
          <td>{{$reservedTurns->dni}}</td>
          <td>{{$reservedTurns->celular}}</td>
          <td>{{$reservedTurns->telefono}}</td>
          <td>{{$reservedTurns->email}}</td>
          <td>{{ucfirst($reservedTurns->medicalInsurence?->nombre_obraSocial)}}</td>
          <td>{{$reservedTurns->numero_obraSocial}}</td>
          <td data-title="Fecha y hora">{{ date("d-m-y",strtotime($reservedTurns->schedule->fecha_atencion)) }}<br>{{ date("H:i",strtotime($reservedTurns->schedule->hr_atencion)) }}</td>
          <td>{{ ucfirst($reservedTurns->schedule->specialist->nombre) }} {{ucfirst($reservedTurns->schedule->specialist->apellido)}}</td>
          <td>{{ucfirst($reservedTurns->schedule->specialty->nombre_especialidad)}}</td>
        </tr>
    @endforeach
</tbody>
</table>
