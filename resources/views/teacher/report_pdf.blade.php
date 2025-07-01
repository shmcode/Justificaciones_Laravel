{{-- resources/views/admin/reporte_pdf.blade.php --}}
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Reporte de Justificaciones</title>
  <style>
    body {
      font-family: sans-serif;
      font-size: 12px;
      margin: 0;
      padding: 0;
    }
    h2 {
      text-align: center;
      color: #319795;
      margin: 1rem 0;
    }
    .filtros {
      margin: 0 1rem 1rem;
      font-size: 12px;
    }
    .filtros p {
      margin: 0.2rem 0;
    }
    .filtros span {
      font-weight: bold;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin: 0 1rem;
    }
    th, td {
      border: 1px solid #CBD5E0;
      padding: 8px;
      text-align: center;
    }
    th {
      background-color: #319795;
      color: white;
    }
  </style>
</head>
<body>
  <h2>Reporte de Justificaciones</h2>

  <div class="filtros">
    <p>
      <span>Clase:</span>
      @if($classroomId && $classrooms->find($classroomId))
        {{ $classrooms->find($classroomId)->name }}
      @else
        Todas las clases
      @endif
    </p>
    <p>
      <span>Estado:</span>
      {{ $status ? ucfirst($status) : 'Todos los estados' }}
    </p>
    <p>
      <span>Fecha:</span> {{ now()->format('d/m/Y H:i') }}
    </p>
  </div>

  <table>
    <thead>
      <tr>
        <th>Estudiante</th>
        <th>Clase</th>
        <th>Motivo</th>
        <th>Comentario</th>
        <th>Estado</th>
      </tr>
    </thead>
    <tbody>
      @forelse($justifications as $j)
        <tr>
          <td>{{ $j->student->name ?? '-' }}</td>
          <td>{{ $j->classroom->name ?? '-' }}</td>
          <td>{{ $j->motivo }}</td>
          <td>{{ $j->comentario }}</td>
          <td>{{ ucfirst($j->status) }}</td>
        </tr>
      @empty
        <tr>
          <td colspan="5">No hay justificaciones con esos filtros.</td>
        </tr>
      @endforelse
    </tbody>
  </table>
</body>
</html>
