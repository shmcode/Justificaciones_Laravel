<x-app-layout>
  <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
  <style>
    .custom-blue-hover:hover {
      background-color: #f5f5f5 !important;
      transition: background 0.2s;
    }
  </style>

  <div class="container mx-auto px-4" x-data="teacherModal()">
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
          @foreach($justifications as $j)
          <tr class="border-b custom-blue-hover cursor-pointer"
              @click="openModal({
                id: '{{ $j->id }}',
                estudiante: '{{ addslashes($j->student->name ?? '-') }}',
                clase: '{{ addslashes($j->classroom->name ?? '-') }}',
                motivo: '{{ addslashes($j->motivo) }}',
                comentario: '{{ addslashes($j->comentario) }}',
                archivo: '{{ $j->archivo ? Storage::url($j->archivo) : '' }}',
                estado: '{{ ucfirst($j->status) }}'
              })">
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
          @endforeach
        </tbody>
      </table>
    </div>

    {{-- Modal Detalle --}}
    <div x-show="open" x-cloak class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-40 z-50">
      <div class="px-4 w-full">
        <div class="bg-white rounded-xl shadow-xl p-10 w-full max-w-2xl mx-auto relative max-h-[90vh] overflow-y-auto">
          <button class="absolute top-2 right-2 text-gray-400 hover:text-gray-600 text-2xl" @click="open = false">&times;</button>
          <div class="flex justify-between items-center mb-6">
            <h3 class="text-xl font-bold text-custom-blue">Detalle de Justificación</h3>
            <template x-if="selected.estado">
              <span class="px-3 py-1 rounded-full text-sm font-semibold" :class="{
  'bg-yellow-100 text-yellow-800': selected.estado.toLowerCase() === 'pendiente',
  'bg-green-100 text-green-800': selected.estado.toLowerCase() === 'aceptado',
  'bg-red-100 text-red-800': selected.estado.toLowerCase() === 'rechazado',
  'bg-yellow-200 text-yellow-900': selected.estado.toLowerCase() === 'apelado'
              }" x-text="selected.estado"></span>
            </template>
          </div>

          <form class="space-y-4 mt-4">
            <div>
              <label class="block text-sm font-medium text-gray-700">Estudiante</label>
              <input type="text" class="mt-1 block w-full rounded border-gray-300 bg-gray-100" x-model="selected.estudiante" disabled>
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700">Clase</label>
              <input type="text" class="mt-1 block w-full rounded border-gray-300 bg-gray-100" x-model="selected.clase" disabled>
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700">Motivo</label>
              <input type="text" class="mt-1 block w-full rounded border-gray-300 bg-gray-100" x-model="selected.motivo" disabled>
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700">Comentario</label>
              <textarea class="mt-1 block w-full rounded border-gray-300 bg-gray-100" x-model="selected.comentario" rows="2" disabled></textarea>
            </div>
            <template x-if="selected.archivo">
              <div>
                <label class="block text-sm font-medium text-gray-700">Archivo</label>
                <template x-if="selected.archivo.toLowerCase().endsWith('.pdf')">
                  <iframe :src="selected.archivo" class="w-full h-64 rounded border mt-2"></iframe>
                </template>
                <template x-if="['.jpg','.jpeg','.png','.gif','.bmp','.webp'].some(ext => selected.archivo.toLowerCase().endsWith(ext))">
                  <img :src="selected.archivo" alt="Previsualización" class="w-auto max-h-64 rounded border mt-2 mx-auto">
                </template>
                <template x-if="!selected.archivo.toLowerCase().endsWith('.pdf') && !['.jpg','.jpeg','.png','.gif','.bmp','.webp'].some(ext => selected.archivo.toLowerCase().endsWith(ext))">
                  <a :href="selected.archivo" target="_blank" class="text-custom-blue underline mt-2 block">Descargar archivo</a>
                </template>
              </div>
            </template>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script>
    function teacherModal() {
      return {
        open: false,
        selected: {},
        openModal(data) {
          this.selected = data;
          this.open = true;
        }
      }
    }
  </script>
</x-app-layout>