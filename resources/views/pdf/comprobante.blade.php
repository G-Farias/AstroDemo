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
    <p><strong>Nombre y apellido </strong> {{ $reservedTurn->nombre }}</p>
    <p><strong>Fecha de atención: </strong> {{ date("d-m-y",strtotime($schedule->fecha_atencion)) }}</p>
    <p><strong>Horario de atención: </strong> {{ date("H:i",strtotime($schedule->hr_atencion)) }}hs</p>
    <p><strong>Especialista: </strong> {{ucfirst($schedule->Specialist->nombre)}} {{ucfirst($schedule->Specialist->apellido)}}</p>
    <p><strong>Especialidad </strong> {{$schedule->specialty->nombre_especialidad}}</p>


</body>
</html>