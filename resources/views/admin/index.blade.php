{{-- resources/views/admin/index.blade.php --}}
<x-app-layout>
  <script src="//unpkg.com/alpinejs" defer></script>
  <style>
  .custom-blue-hover:hover {
    background-color: #f5f5f5 !important;
    transition: background 0.2s;
  }

  [x-cloak] {
    display: none !important;
  }
  </style>

  <div x-data="{ openDetail: false, selected: {} }">
    <div class="max-w-screen-xl mx-auto px-4 py-6">
      <h2 class="text-2xl font-bold mb-6 text-custom-blue">Justificaciones</h2>

      <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-4">
        <form method="GET" action="{{ url('/admin') }}" class="w-full sm:w-auto">
          <select name="status" onchange="this.form.submit()"
            class="border rounded px-3 py-2 w-full sm:w-auto focus:outline-none focus:ring-2 focus:ring-custom-blue">
            <option value="">Todos</option>
            <option value="pendiente" {{ $status == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
            <option value="aceptado" {{ $status == 'aceptado' ? 'selected' : '' }}>Aceptado</option>
            <option value="rechazado" {{ $status == 'rechazado' ? 'selected' : '' }}>Rechazado</option>
            <option value="apelado" {{ $status == 'apelado' ? 'selected' : '' }}>Apelado</option>
          </select>
        </form>

        <div class="w-full sm:w-auto text-right">
          <a href="{{ url('/admin/reporte_pdf') }}?status={{ request('status') }}" target="_blank"
            class="block sm:inline bg-custom-blue text-white px-4 py-2 rounded hover:bg-blue-900 text-center w-full sm:w-auto">
            Generar Reporte PDF
          </a>
        </div>
      </div>

      <div class="overflow-x-auto">
        <table class="min-w-full bg-white rounded-xl shadow-lg overflow-hidden text-sm">
          <thead>
            <tr class="bg-custom-blue text-white whitespace-nowrap">
              <th class="py-2 px-4">Clase</th>
              <th class="py-2 px-4">Estudiante</th>
              <th class="py-2 px-4">Motivo</th>
              <th class="py-2 px-4">Comentario</th>
              <th class="py-2 px-4">Archivo</th>
              <th class="py-2 px-4">Estado</th>
              <th class="py-2 px-4">Acciones</th>
            </tr>
          </thead>
          <tbody>
            @foreach($justifications as $j)
            <tr class="border-b custom-blue-hover transition cursor-pointer" @click="openDetail = true; selected = {
      id: '{{ $j->id }}',
      clase: '{{ addslashes($j->classroom->name ?? "-") }}',
      estudiante: '{{ addslashes($j->student->name ?? "-") }}',
      motivo: '{{ addslashes($j->motivo) }}',
      comentario: '{{ addslashes($j->comentario) }}',
      archivo: '{{ $j->archivo ? Storage::url($j->archivo) : '' }}',
      status: '{{ ucfirst($j->status) }}',
      respuesta_admin: '{{ addslashes($j->respuesta_admin ?? "-") }}',
      pendiente: '{{ in_array($j->status, ["pendiente", "apelado"]) ? "1" : "0" }}'
    }">

              <td class="py-2 px-4 text-center">{{ $j->classroom->name ?? '-' }}</td>
              <td class="py-2 px-4 text-center">{{ $j->student->name ?? '-' }}</td>
              <td class="py-2 px-4 text-center">{{ $j->motivo }}</td>
              <td class="py-2 px-4 text-center">{{ $j->comentario }}</td>
              <td class="py-2 px-4 text-center">
                @if($j->archivo)
                <a href="{{ Storage::url($j->archivo) }}" target="_blank"
                  class="text-custom-blue underline hover:text-custom-blue">Ver archivo</a>
                @endif
              </td>
              <td class="py-2 px-4 text-center">
                <span class="px-2 py-1 rounded text-xs font-medium
                  @if($j->status == 'pendiente') bg-yellow-100 text-yellow-800
                  @elseif($j->status == 'aceptado') bg-green-100 text-green-800
                  @elseif($j->status == 'rechazado') bg-red-100 text-red-800
                  @else bg-yellow-200 text-yellow-900 @endif">
                  {{ ucfirst($j->status) }}
                </span>
              </td>
              <td class="py-2 px-4 text-center">
                @if(in_array($j->status, ['pendiente', 'apelado']))
                <button onclick="openModal('accept', {{ $j->id }})"
                  class="bg-green-600 text-white px-2 py-1 rounded hover:bg-green-700 text-xs transition">Aceptar</button>
                <button onclick="openModal('reject', {{ $j->id }})"
                  class="bg-red-600 text-white px-2 py-1 rounded hover:bg-red-700 ml-2 text-xs transition">Rechazar</button>
                @else
                <span class="text-gray-400">-</span>
                @endif
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>

    <!-- Modal Detalle (nuevo diseño) -->
    <div x-show="openDetail" x-transition x-cloak
      class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-40 z-50" style="display: none;">
      <div class="px-4 w-full">
        <div class="bg-white rounded-xl shadow-xl p-10 w-full max-w-2xl mx-auto relative max-h-[90vh] overflow-y-auto">
          <button class="absolute top-2 right-2 text-gray-400 hover:text-gray-600 text-2xl"
            @click="openDetail = false">&times;</button>

          <div class="flex justify-between items-center mb-6">
            <h3 class="text-xl font-bold text-custom-blue">Detalle de Justificación</h3>
            <template x-if="selected.status">
              <span class="px-3 py-1 rounded-full text-sm font-semibold" :class="{
                'bg-yellow-100 text-yellow-800': selected.status === 'Pendiente',
                'bg-green-100 text-green-800': selected.status === 'Aceptado',
                'bg-red-100 text-red-800': selected.status === 'Rechazado',
                'bg-yellow-200 text-yellow-900': selected.status === 'Apelado'
              }" x-text="selected.status"></span>
            </template>
          </div>

          <form class="space-y-4">
            <div>
              <label class="block text-sm font-medium text-gray-700">Clase</label>
              <input type="text" class="mt-1 block w-full rounded border-gray-300 bg-gray-100" x-model="selected.clase"
                disabled>
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700">Estudiante</label>
              <input type="text" class="mt-1 block w-full rounded border-gray-300 bg-gray-100"
                x-model="selected.estudiante" disabled>
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700">Motivo</label>
              <input type="text" class="mt-1 block w-full rounded border-gray-300 bg-gray-100" x-model="selected.motivo"
                disabled>
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700">Comentario</label>
              <textarea class="mt-1 block w-full rounded border-gray-300 bg-gray-100" x-model="selected.comentario"
                rows="2" disabled></textarea>
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700">Respuesta del Admin</label>
              <textarea class="mt-1 block w-full rounded border-gray-300 bg-gray-100" x-model="selected.respuesta_admin"
                rows="2" disabled></textarea>
            </div>
            <template x-if="selected.archivo">
              <div>
                <label class="block text-sm font-medium text-gray-700">Archivo</label>
                <template x-if="selected.archivo.toLowerCase().endsWith('.pdf')">
                  <iframe :src="selected.archivo" class="w-full h-64 mt-2 rounded border"></iframe>
                </template>
                <template
                  x-if="['.jpg','.jpeg','.png','.gif','.bmp','.webp'].some(ext => selected.archivo.toLowerCase().endsWith(ext))">
                  <img :src="selected.archivo" class="w-auto max-h-64 mt-2 mx-auto rounded border">
                </template>
                <template
                  x-if="!selected.archivo.toLowerCase().endsWith('.pdf') && !['.jpg','.jpeg','.png','.gif','.bmp','.webp'].some(ext => selected.archivo.toLowerCase().endsWith(ext))">
                  <a :href="selected.archivo" target="_blank" class="text-custom-blue underline mt-2 block">Ver
                    archivo</a>
                </template>
              </div>
            </template>
          </form>

          <div class="flex justify-end gap-4 mt-8" x-show="selected.pendiente === '1'">
            <button @click="openModal('accept', selected.id)"
              class="bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-3 rounded-xl shadow transition">
              Aceptar
            </button>
            <button @click="openModal('reject', selected.id)"
              class="bg-red-600 hover:bg-red-700 text-white font-semibold px-6 py-3 rounded-xl shadow transition">
              Rechazar
            </button>
            <button @click="openDetail = false"
              class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-bold px-6 py-2 rounded-xl shadow transition">
              Cerrar
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal de aceptación/rechazo -->
    <div id="modal-justificacion"
      class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50 hidden px-4">
      <div class="bg-white rounded shadow-lg p-6 w-full max-w-md">
        <form id="modal-form" method="POST">
          @csrf
          <div class="mb-4">
            <label class="block font-semibold mb-2" id="modal-label">Motivo:</label>
            <input type="text" name="respuesta_admin" id="modal-respuesta" required
              class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-custom-blue">
          </div>
          <div class="flex justify-end">
            <button type="button" onclick="closeModal()"
              class="mr-2 px-4 py-2 rounded bg-gray-300 hover:bg-gray-400">Cancelar</button>
            <button type="submit"
              class="px-4 py-2 rounded bg-custom-blue text-white hover:bg-custom-blue">Enviar</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script>
  let modal = document.getElementById('modal-justificacion');
  let form = document.getElementById('modal-form');
  let label = document.getElementById('modal-label');
  let respuestaInput = document.getElementById('modal-respuesta');

  function openModal(tipo, id) {
    modal.classList.remove('hidden');

    if (tipo === 'accept') {
      form.action = '/justifications/' + id + '/accept';
      label.textContent = 'Motivo de aceptación:';
      respuestaInput.placeholder = 'Motivo de aceptación';
    } else {
      form.action = '/justifications/' + id + '/reject';
      label.textContent = 'Motivo de rechazo:';
      respuestaInput.placeholder = 'Motivo de rechazo';
    }

    respuestaInput.value = '';

    respuestaInput.addEventListener('invalid', function() {
      this.setCustomValidity('Por favor llena este campo');
    });

    // Limpiar el mensaje si ya es válido
    respuestaInput.addEventListener('input', function() {
      this.setCustomValidity('');
    });

    setTimeout(() => respuestaInput.focus(), 100);
  }


  function closeModal() {
    modal.classList.add('hidden');
  }

  document.addEventListener('keydown', function(e) {
    if (!modal.classList.contains('hidden') && e.key === "Escape") closeModal();
  });
  </script>
</x-app-layout>