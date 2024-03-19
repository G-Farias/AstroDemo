<!DOCTYPE html>
<html>
    
<head>
    <title>{{ $title }}</title>
</head>

<style>

    table, th, td {
        border: 1px solid;
        border-collapse: collapse;
        }
        
    th, td {
	padding: 10px;
    }
    th {
	background-color: gray;
	color: white;
    border: 1px solid black;

}
</style>

<body>
    <h1>{{ $title }}</h1>
    <table>
        <thead>
          <tr>
            <th scope="col">Nombre</th>
            <th scope="col">Apellido</th>
            <th scope="col">D.N.I</th>
            <th scope="col">Celular</th>
            <th scope="col">Teléfono</th>
            <th scope="col">Email</th>
            <th scope="col">Obra social</th>
            <th scope="col">Numero afilíado</th>
            <th scope="col">Fecha y hora</th>
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

        </tr>

            @endif
        @endforeach
    @endforeach
</tbody>
</table>




 



</body>
</html>