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
    @foreach ($schedules as $schedule)
    @if ($schedule->id == $reservedTurn->id_horario_atencion)
    <h1>{{ $title }}</h1>
    <p><strong>Especialista: </strong> {{ucfirst($schedule->Specialist->nombre)}} {{ucfirst($schedule->Specialist->apellido)}}</p>
    <p><strong>Especialidad: </strong> {{$schedule->specialty->nombre_especialidad}}</p>
    <p><strong>Fecha de atención: </strong> {{ date("d-m-y",strtotime($schedule->fecha_atencion)) }}</p>
    <p><strong>Horario de atención: </strong> {{ date("H:i",strtotime($schedule->hr_atencion)) }}hs</p>
    <br>
    <p><strong>Nombre y apellido: </strong> {{ ucfirst($reservedTurn->nombre) }} {{ ucfirst($reservedTurn->apellido) }}</p>
    <p><strong>D.N.I / Pasaporte: </strong>{{$reservedTurn->dni}}</p>
    <p><strong>Celular / Teléfono: </strong>{{$reservedTurn->celular}}</p>
    <p><strong>Email: </strong>{{$reservedTurn->email}}</p>
    <p><strong>Obra social / Prepaga: </strong>{{ ucfirst($reservedTurn->medicalInsurence?->nombre_obraSocial)}}</p>
    <p><strong>Número de afiliado: </strong>{{ $reservedTurn->numero_obraSocial }}</p>
    @endif
    @endforeach
</body>
</html>