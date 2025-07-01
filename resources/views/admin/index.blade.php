{{-- resources/views/admin/index.blade.php --}}
<x-app-layout>
  <script src="//unpkg.com/alpinejs" defer></script>
  <style>
    .custom-blue-hover:hover {
      background-color: #f5f5f5 !important;
      transition: background 0.2s;
    }
    [x-cloak] { display: none !important; }
  </style>

  <div x-data="{ openDetail: false, selected: {} }" class="relative">
    <div class="max-w-screen-xl mx-auto px-4 py-6">
      <h2 class="text-2xl font-bold mb-6 text-custom-blue">Justificaciones de mis clases</h2>

      <div class="mb-6 flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4">
        {{-- Filtro estilo desplegable --}}
        <div x-data="{ open: false }" class="relative w-full sm:w-auto">
          <button type="button" @click="open = !open"
            class="bg-white border border-gray-200 text-custom-blue px-4 py-2 rounded-xl shadow hover:bg-gray-100 transition font-semibold flex items-center gap-2 w-full sm:w-auto">
            <!-- Icono de filtro -->
            <svg class="w-5 h-5 text-custom-blue" fill="none" stroke="currentColor" stroke-width="2"
                 viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round"
                    d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-.293.707l-6.414 6.414A1 1 0 0013 14.414V19a1 1 0 01-1.447.894l-2-1A1 1 0 09 18v-3.586a1 1 0 00-.293-.707L2.293 6.707A1 1 0 012 6V4z" />
            </svg>
            Filtro
            <svg :class="{'rotate-180': open}" class="w-4 h-4 ml-1 transition-transform text-custom-blue" fill="none"
                 stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
            </svg>
          </button>

          <div
  x-show="open"
  @click.away="open = false"
  x-transition
  class="
    absolute left-0 mt-2
    w-full               /* móvil: ocupa 100% */
    sm:w-80              /* ≥640px: 20rem (320px) */
    md:w-96              /* ≥768px: 24rem (384px) */
    lg:w-[32rem]         /* ≥1024px: 32rem (512px) */
    bg-white rounded-2xl shadow-xl p-6 z-10 border border-gray-100 flex flex-col space-y-4
  "
>

            {{-- Formulario de filtros --}}
            <form method="GET" action="{{ url('/admin') }}" class="flex flex-col space-y-4">
            <input type="hidden" name="classroom_id" value="{{ $classroomId }}">
            <input type="hidden" name="status"       value="{{ $status }}">
              {{-- Filtro por clase --}}
              <div>
                <div x-data="{
                  openClase: false,
                  selectedClase: '{{ request('classroom_id') }}',
                  clases: [
                    { id: '', name: 'Todas las clases' },
                    @foreach($classrooms as $c)
                      { id: '{{ $c->id }}', name: '{{ addslashes($c->name) }}' },
                    @endforeach
                  ]
                }" class="relative">
                  <label class="block text-sm font-semibold text-gray-700 mb-2">Clase</label>
                  <input type="hidden" name="classroom_id" :value="selectedClase">
                  <button type="button" @click="openClase = !openClase"
                          class="w-full bg-gray-50 border border-gray-300 rounded-xl px-5 py-3 text-left shadow focus:outline-none flex justify-between items-center">
                    <span x-text="clases.find(o => o.id == selectedClase)?.name"></span>
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" stroke-width="2"
                         viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                    </svg>
                  </button>
                  <div x-show="openClase" @click.away="openClase = false" x-transition
                       class="absolute z-10 mt-2 w-full bg-white rounded-xl shadow-lg border border-gray-100 max-h-60 overflow-auto">
                    <template x-for="opt in clases" :key="opt.id">
                      <div @click="selectedClase = opt.id; openClase = false"
                           :class="{'bg-custom-blue text-white': selectedClase==opt.id,'hover:bg-custom-blue hover:text-white cursor-pointer': selectedClase!=opt.id}"
                           class="px-5 py-3 text-base transition select-none">
                        <span x-text="opt.name"></span>
                      </div>
                    </template>
                  </div>
                </div>
              </div>

              {{-- Filtro por estado --}}
              <div>
                <div x-data="{
                  openEstado: false,
                  selectedEstado: '{{ request('status') }}',
                  estados: [
                    { id: '', name: 'Todos los estados' },
                    { id: 'pendiente', name: 'Pendiente' },
                    { id: 'aceptado', name: 'Aceptado' },
                    { id: 'rechazado', name: 'Rechazado' },
                    { id: 'apelado', name: 'Apelado' }
                  ]
                }" class="relative">
                  <label class="block text-sm font-semibold text-gray-700 mb-2">Estado</label>
                  <input type="hidden" name="status" :value="selectedEstado">
                  <button type="button" @click="openEstado = !openEstado"
                          class="w-full bg-gray-50 border border-gray-300 rounded-xl px-5 py-3 text-left shadow focus:outline-none flex justify-between items-center">
                    <span x-text="estados.find(o => o.id == selectedEstado)?.name"></span>
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" stroke-width="2"
                         viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                    </svg>
                  </button>
                  <div x-show="openEstado" @click.away="openEstado = false" x-transition
                       class="absolute z-10 mt-2 w-full bg-white rounded-xl shadow-lg border border-gray-100 max-h-60 overflow-auto">
                    <template x-for="opt in estados" :key="opt.id">
                      <div @click="selectedEstado = opt.id; openEstado = false"
                           :class="{'bg-custom-blue text-white': selectedEstado==opt.id,'hover:bg-custom-blue hover:text-white cursor-pointer': selectedEstado!=opt.id}"
                           class="px-5 py-3 text-base transition select-none">
                        <span x-text="opt.name"></span>
                      </div>
                    </template>
                  </div>
                </div>
              </div>

              {{-- Botón Filtrar --}}
              <div>
                <button type="submit"
                        class="bg-custom-blue text-white px-6 py-3 rounded-xl shadow hover:bg-custom-blue-700 transition font-semibold">
                  Filtrar
                </button>
              </div>
            </form>
          </div>
        </div>

        {{-- Botón Generar PDF --}}
        <div class="w-full sm:w-auto text-right">
          <a href="{{ route('admin.reporte.pdf', [
                'classroom_id' => request('classroom_id'),
                'status'       => request('status'),
              ]) }}"
             target="_blank"
             class="block sm:inline bg-custom-blue text-white px-4 py-2 rounded hover:bg-blue-900 text-center w-full sm:w-auto">
            Generar Reporte PDF
          </a>
        </div>
      </div>

      {{-- Tabla de justificaciones --}}
      <div class="overflow-x-auto">
        <table class="min-w-full bg-white rounded-xl shadow-lg overflow-hidden text-sm">
          {{-- <thead> y <tbody> igual que antes --}}
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
            <tr class="border-b custom-blue-hover transition cursor-pointer"
                @click="openDetail = true; selected = {
                   id: '{{ $j->id }}',
                   clase: '{{ addslashes($j->classroom->name ?? "-") }}',
                   estudiante: '{{ addslashes($j->student->name ?? "-") }}',
                   motivo: '{{ addslashes($j->motivo) }}',
                   comentario: '{{ addslashes($j->comentario) }}',
                   archivo: '{{ $j->archivo ? Storage::url($j->archivo) : null }}',
                   status: '{{ ucfirst($j->status) }}',
                   respuesta_admin: '{{ addslashes($j->respuesta_admin ?? "-") }}',
                   pendiente: '{{ in_array($j->status, ["pendiente","apelado"]) ? "1":"0" }}'
                }">
              {{-- ... celdas igual que antes ... --}}
              <td class="py-2 px-4 text-center">{{ $j->classroom->name }}</td>
              <td class="py-2 px-4 text-center">{{ $j->student->name }}</td>
              <td class="py-2 px-4 text-center">{{ $j->motivo }}</td>
              <td class="py-2 px-4 text-center">{{ $j->comentario }}</td>
              <td class="py-2 px-4 text-center">
                @if($j->archivo)
                  <a href="{{ Storage::url($j->archivo) }}" target="_blank"
                     class="text-custom-blue underline">Ver archivo</a>
                @endif
              </td>
              <td class="py-2 px-4 text-center">
                <span class="px-2 py-1 rounded text-xs font-medium
                  @if($j->status=='pendiente') bg-yellow-100 text-yellow-800
                  @elseif($j->status=='aceptado') bg-green-100 text-green-800
                  @elseif($j->status=='rechazado') bg-red-100 text-red-800
                  @else bg-yellow-200 text-yellow-900 @endif">
                  {{ ucfirst($j->status) }}
                </span>
              </td>
              <td class="py-2 px-4 text-center">
                @if(in_array($j->status, ['pendiente','apelado']))
                  <button onclick="openModal('accept', {{ $j->id }})"
                          class="bg-green-600 text-white px-2 py-1 rounded hover:bg-green-700 text-xs">Aceptar</button>
                  <button onclick="openModal('reject', {{ $j->id }})"
                          class="bg-red-600 text-white px-2 py-1 rounded hover:bg-red-700 ml-2 text-xs">Rechazar</button>
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

    {{-- ↓ Resto de los modales y scripts (igual que antes) ↓ --}}
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

    // Establecer mensaje personalizado en español si el campo está vacío al enviar
    respuestaInput.addEventListener('invalid', function() {
      this.setCustomValidity('Por favor llena este campo');
    });

    // Limpiar el mensaje personalizado si ya es válido
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
