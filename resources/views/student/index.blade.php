{{-- filepath: resources/views/student/index.blade.php --}}
<x-app-layout>
  <h2 class="text-2xl font-bold mb-4 text-blue-800">Mis Justificaciones</h2>
  <form method="GET" action="{{ url('/student') }}" class="mb-4">
    <select name="status" onchange="this.form.submit()" class="border rounded px-2 py-1">
      <option value="">Todos</option>
      <option value="pendiente" {{ $status == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
      <option value="aceptado" {{ $status == 'aceptado' ? 'selected' : '' }}>Aceptado</option>
      <option value="rechazado" {{ $status == 'rechazado' ? 'selected' : '' }}>Rechazado</option>
    </select>
  </form>
  <table class="min-w-full bg-white rounded shadow">
    <tr class="bg-blue-800 text-white">
      <th class="py-2 px-4">Clase</th>
      <th class="py-2 px-4">Profesor</th>
      <th class="py-2 px-4">Motivo</th>
      <th class="py-2 px-4">Comentario</th>
      <th class="py-2 px-4">Archivo</th>
      <th class="py-2 px-4">Estado</th>
      <th class="py-2 px-4">Respuesta</th>
    </tr>
    @foreach($justifications as $j)
    <tr class="border-b">
      <td class="py-2 px-4">{{ $j->classroom->name }}</td>
      <td class="py-2 px-4">{{ $j->professor->name }}</td>
      <td class="py-2 px-4">{{ $j->motivo }}</td>
      <td class="py-2 px-4">{{ $j->comentario }}</td>
      <td class="py-2 px-4">
        @if($j->archivo)
        <a href="{{ Storage::url($j->archivo) }}" target="_blank" class="text-blue-700 underline">Ver archivo</a>
        @endif
      </td>
      <td class="py-2 px-4">{{ ucfirst($j->status) }}</td>
      <td class="py-2 px-4">{{ ucfirst($j->respuesta_admin) }}</td>
    </tr>
    @endforeach
  </table>
</x-app-layout>