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
            <th scope="col">Especialista</th>
            <th scope="col">Especialidad</th>
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




 



</body>
</html>