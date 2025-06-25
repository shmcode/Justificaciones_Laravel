{{-- filepath: resources/views/teacher/index.blade.php --}}
<x-app-layout>
  <script src="//unpkg.com/alpinejs" defer></script>
  <style>
  .custom-blue-hover:hover {
    background-color: #f5f5f5 !important;
    transition: background 0.2s;
  }
  </style>

  <div class="container mx-auto px-4">
    <h2 class="text-2xl font-bold mb-6 text-custom-blue">Justificaciones de mis clases</h2>

    <div class="overflow-x-auto">
      <table class="min-w-full bg-white rounded-xl shadow-lg overflow-hidden">
        <thead>
          <tr class="bg-custom-blue text-white">
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
          <tr class="border-b custom-blue-hover">
            <td class="py-2 px-4 text-center align-middle">{{ $j->student->name ?? '-' }}</td>
            <td class="py-2 px-4 text-center align-middle">{{ $j->classroom->name ?? '-' }}</td>
            <td class="py-2 px-4 text-center align-middle">{{ $j->motivo }}</td>
            <td class="py-2 px-4 text-center align-middle">{{ $j->comentario }}</td>
            <td class="py-2 px-4 text-center align-middle">
              @if($j->archivo)
              <a href="{{ Storage::url($j->archivo) }}" target="_blank" class="text-blue-700 underline">Ver archivo</a>
              @endif
            </td>
            <td class="py-2 px-4 text-center align-middle">{{ ucfirst($j->status) }}</td>
          </tr>
          @empty
          <tr>
            <td colspan="6" class="py-2 px-4 text-center text-gray-500">No hay justificaciones registradas.</td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</x-app-layout>