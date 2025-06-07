{{-- filepath: resources/views/admin/index.blade.php --}}
<x-app-layout>
  <h2 class="text-2xl font-bold mb-6 text-blue-800">Justificaciones</h2>
  <div class="overflow-x-auto">

    <form method="GET" action="{{ url('/admin') }}" class="mb-4">
      <select name="status" onchange="this.form.submit()" class="border rounded px-2 py-1">
        <option value="">Todos</option>
        <option value="pendiente" {{ $status == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
        <option value="aceptado" {{ $status == 'aceptado' ? 'selected' : '' }}>Aceptado</option>
        <option value="rechazado" {{ $status == 'rechazado' ? 'selected' : '' }}>Rechazado</option>
      </select>
    </form>

    <div class="mb-4">
      <a href="{{ url('/admin/reporte_pdf') }}" target="_blank"
        class="bg-blue-800 text-white px-4 py-2 rounded hover:bg-blue-900">Generar Reporte PDF</a>
    </div>


    <table class="min-w-full bg-white rounded shadow">
      <thead>
        <tr class="bg-blue-800 text-white">
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
        <tr class="border-b hover:bg-blue-50 transition-colors">
          <td class="py-2 px-4">{{ $j->classroom->name ?? '-' }}</td>
          <td class="py-2 px-4">{{ $j->student->name ?? '-' }}</td>
          <td class="py-2 px-4">{{ $j->motivo }}</td>
          <td class="py-2 px-4">{{ $j->comentario }}</td>
          <td class="py-2 px-4">
            @if($j->archivo)
            <a href="{{ Storage::url($j->archivo) }}" target="_blank"
              class="text-blue-700 underline hover:text-blue-900">Ver archivo</a>
            @endif
          </td>
          <td class="py-2 px-4">
            <span class="px-2 py-1 rounded 
              @if($j->status == 'pendiente') bg-yellow-100 text-yellow-800 
              @elseif($j->status == 'aceptado') bg-green-100 text-green-800 
              @else bg-red-100 text-red-800 @endif">
              {{ ucfirst($j->status) }}
            </span>
          </td>
          <td class="py-2 px-4">
            @if($j->status == 'pendiente')
            <button onclick="openModal('accept', {{ $j->id }})"
              class="bg-green-600 text-white px-2 py-1 rounded hover:bg-green-700 transition">Aceptar</button>
            <button onclick="openModal('reject', {{ $j->id }})"
              class="bg-red-600 text-white px-2 py-1 rounded hover:bg-red-700 ml-2 transition">Rechazar</button>
            @else
            <span class="text-gray-400">-</span>
            @endif
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  <!-- Modal -->
  <div id="modal-justificacion"
    class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded shadow-lg p-6 w-full max-w-md">
      <form id="modal-form" method="POST">
        @csrf
        <div class="mb-4">
          <label class="block font-semibold mb-2" id="modal-label">Motivo:</label>
          <input type="text" name="respuesta_admin" id="modal-respuesta" required
            class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
        </div>
        <div class="flex justify-end">
          <button type="button" onclick="closeModal()"
            class="mr-2 px-4 py-2 rounded bg-gray-300 hover:bg-gray-400">Cancelar</button>
          <button type="submit" class="px-4 py-2 rounded bg-blue-800 text-white hover:bg-blue-900">Enviar</button>
        </div>
      </form>
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
    setTimeout(() => respuestaInput.focus(), 100);
  }

  function closeModal() {
    modal.classList.add('hidden');
  }

  // Cierra el modal al presionar ESC
  document.addEventListener('keydown', function(e) {
    if (!modal.classList.contains('hidden') && e.key === "Escape") closeModal();
  });
  </script>
</x-app-layout>