{{-- filepath: resources/views/admin/reporte_pdf.blade.php --}}
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>Reporte de Justificaciones</title>
  <style>
  body {
    font-family: DejaVu Sans, sans-serif;
    font-size: 12px;
  }

  table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
  }

  th,
  td {
    border: 1px solid #444;
    padding: 4px;
    text-align: left;
  }

  th {
    background: #2563eb;
    color: #fff;
  }
  </style>
</head>

<body>
  <h2>Reporte de Justificaciones</h2>
  <table>
    <thead>
      <tr>
        <th>Estudiante</th>
        <th>Clase</th>
        <th>Profesor</th>
        <th>Motivo</th>
        <th>Comentario</th>
        <th>Estado</th>
        <th>Fecha</th>
      </tr>
    </thead>
    <tbody>
      @foreach($justifications as $j)
      <tr>
        <td>{{ $j->student->name ?? '-' }}</td>
        <td>{{ $j->classroom->name ?? '-' }}</td>
        <td>{{ $j->professor->name ?? '-' }}</td>
        <td>{{ $j->motivo }}</td>
        <td>{{ $j->comentario }}</td>
        <td>{{ ucfirst($j->status) }}</td>
        <td>{{ $j->created_at->format('d/m/Y') }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
</body>

</html>