{{-- filepath: resources/views/teacher/index.blade.php --}}
<x-app-layout>
  <h2 class="text-2xl font-bold mb-6 text-blue-800">Justificaciones de mis clases</h2>
  <div class="overflow-x-auto">
    <table class="min-w-full bg-white rounded shadow">
      <thead>
        <tr class="bg-blue-800 text-white">
          <th class="py-2 px-4">Estudiante</th>
          <th class="py-2 px-4">Clase</th>
          <th class="py-2 px-4">Motivo</th>
          <th class="py-2 px-4">Comentario</th>
          <th class="py-2 px-4">Archivo</th>
          <th class="py-2 px-4">Estado</th>
        </tr>
      </thead>
      <tbody>
        @forelse($justifications as $j)
        <tr class="border-b hover:bg-blue-50">
          <td class="py-2 px-4">{{ $j->student->name ?? '-' }}</td>
          <td class="py-2 px-4">{{ $j->classroom->name ?? '-' }}</td>
          <td class="py-2 px-4">{{ $j->motivo }}</td>
          <td class="py-2 px-4">{{ $j->comentario }}</td>
          <td class="py-2 px-4">
            @if($j->archivo)
            <a href="{{ Storage::url($j->archivo) }}" target="_blank" class="text-blue-700 underline">Ver archivo</a>
            @endif
          </td>
          <td class="py-2 px-4">{{ ucfirst($j->status) }}</td>
        </tr>
        @empty
        <tr>
          <td colspan="6" class="py-2 px-4 text-center text-gray-500">No hay justificaciones registradas.</td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</x-app-layout>