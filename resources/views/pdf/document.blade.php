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
          </tr>
        </thead>
        <tbody>
    @foreach ($patient as $patient)
     
        <tr>
          <td>{{ucfirst($patient->nombre)}}</td>
          <td>{{ucfirst($patient->apellido)}}</td>
          <td>{{$patient->dni}}</td>
          <td>{{$patient->celular}}</td>
          <td>{{$patient->telefono}}</td>
          <td>{{$patient->email}}</td>
          <td>{{ucfirst($patient->medicalInsurence?->nombre_obraSocial)}}</td>
          <td>{{$patient->numero_obraSocial}}</td>
        </tr>

    @endforeach
</tbody>
</table>




 



</body>
</html>