<table>
    <thead>
    <tr>
        <th>Nombre</th>
        <th>Apellido</th>
        <th>D.N.I</th>
        <th>Fecha de nacimiento</th>
        <th>Celular</th>
        <th>Teléfono</th>
        <th>email</th>
        <th>Obra social</th>
        <th>Número afiliado</th>
        <th>Dirección</th>
        <th>País residencia</th>
        <th>Provincia residencia</th>
        <th>Localidad residencia</th>
    </tr>
    </thead>
    <tbody>
    @foreach($patients as $patient)
        <tr>
            <td>{{ $patient->nombre }}</td>
            <td>{{ $patient->apellido }}</td>
            <td>{{ $patient->dni }}</td>
            <td>{{ $patient->fecha_nacimiento }}</td>
            <td>{{ $patient->celular }}</td>
            <td>{{ $patient->telefono }}</td>
            <td>{{ $patient->email }}</td>
            <td>{{ $patient->medicalInsurence?->obra_social }}</td>
            <td>{{ $patient->numero_obraSocial }}</td>
            <td>{{ $patient->direccion }}</td>
            <td>{{ $patient->pais_residencia }}</td>
            <td>{{ $patient->provincia_residencia }}</td>
            <td>{{ $patient->localidad_residencia }}</td>
        </tr>
    @endforeach
    </tbody>
</table>