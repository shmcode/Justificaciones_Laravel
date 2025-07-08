<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
  <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
  <style>
    .custom-blue-hover:hover {
      background-color: #f5f5f5 !important;
      transition: background 0.2s;
    }
  </style>

  <div class="container mx-auto px-4" x-data="teacherModal()">
    <h2 class="text-2xl font-bold mb-6 text-custom-blue">Justificaciones de mis clases</h2>

    
    <div class="mb-6 flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4">
      
      <div x-data="{ open: false }" class="relative w-full sm:w-auto">
      <button type="button" @click="open = !open"
          class="bg-white border border-gray-200 text-custom-blue px-4 py-2 rounded-xl shadow hover:bg-gray-100 transition font-semibold flex items-center gap-2">
          <svg class="w-5 h-5 text-custom-blue" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round"
              d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-.293.707l-6.414 6.414A1 1 0 0013 14.414V19a1 1 0 01-1.447.894l-2-1A1 1 0 019 18v-3.586a1 1 0 00-.293-.707L2.293 6.707A1 1 0 012 6V4z" />
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
          class="absolute left-0 mt-2 w-full sm:w-auto sm:max-w-md bg-white rounded-2xl shadow-xl p-6 z-10 border border-gray-100 flex flex-col space-y-4"
        >
          <form method="GET" action="<?php echo e(url('/teacher')); ?>" class="flex flex-col space-y-4">
            
            <div class="flex-1 min-w-[200px]">
              <div x-data="{
                openClase: false,
                selectedClase: '<?php echo e(request('classroom_id')); ?>',
                clases: [
                  { id: '', name: 'Todas las clases' },
                  <?php $__currentLoopData = $classrooms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $classroom): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    { id: '<?php echo e($classroom->id); ?>', name: '<?php echo e(addslashes($classroom->name)); ?>' },
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                ]
              }" class="relative">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Clase</label>
                <input type="hidden" name="classroom_id" :value="selectedClase">
                <button type="button" @click="openClase = !openClase"
                  class="w-full bg-gray-50 border border-gray-300 rounded-xl px-5 py-3 text-left shadow focus:outline-none flex justify-between items-center">
                  <span x-text="clases.find(o => o.id == selectedClase)?.name || 'Selecciona una clase'"></span>
                  <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                  </svg>
                </button>
                <div x-show="openClase" @click.away="openClase = false" x-transition
                  class="absolute z-10 mt-2 w-full bg-white rounded-xl shadow-lg border border-gray-100 max-h-60 overflow-auto">
                  <template x-for="option in clases" :key="option.id">
                    <div @click="selectedClase = option.id; openClase = false" :class="{
                      'bg-custom-blue text-white': selectedClase == option.id,
                      'hover:bg-custom-blue hover:text-white cursor-pointer': selectedClase != option.id
                    }" class="px-5 py-3 text-base transition select-none">
                      <span x-text="option.name"></span>
                    </div>
                  </template>
                </div>
              </div>
            </div>

            
            <div class="flex-1 min-w-[200px]">
            <div x-data="{
  openEstado: false,
  selectedEstado: '<?php echo e(request()->has('status') ? request('status') : null); ?>',
  estados: [
    { id: '', name: 'Todos los estados' },
    { id: 'pendiente', name: 'Pendiente' },
    { id: 'aceptado', name: 'Aceptado' },
    { id: 'rechazado', name: 'Rechazado' },
    { id: 'apelado', name: 'Apelado' }
  ],
  init() {
    // Solo ejecuta esto si NO hay parámetro 'status' en la URL
    <?php if(!request()->has('status')): ?>
      this.selectedEstado = 'aceptado';
      this.$nextTick(() => {
        this.$el.closest('form').submit();
      });
    <?php endif; ?>
  }
}" class="relative">


                <label class="block text-sm font-semibold text-gray-700 mb-2">Estado</label>
                <input type="hidden" name="status" :value="selectedEstado">
                <button type="button" @click="openEstado = !openEstado"
                  class="w-full bg-gray-50 border border-gray-300 rounded-xl px-5 py-3 text-left shadow focus:outline-none flex justify-between items-center">
                  <span x-text="estados.find(o => o.id == selectedEstado)?.name || 'Selecciona un estado'"></span>
                  <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                  </svg>
                </button>
                <div x-show="openEstado" @click.away="openEstado = false" x-transition
                  class="absolute z-10 mt-2 w-full bg-white rounded-xl shadow-lg border border-gray-100 max-h-60 overflow-auto">
                  <template x-for="option in estados" :key="option.id">
                    <div @click="selectedEstado = option.id; openEstado = false" :class="{
                      'bg-custom-blue text-white': selectedEstado == option.id,
                      'hover:bg-custom-blue hover:text-white cursor-pointer': selectedEstado != option.id
                    }" class="px-5 py-3 text-base transition select-none">
                      <span x-text="option.name"></span>
                    </div>
                  </template>
                </div>
              </div>
            </div>

            
            <div>
              <button type="submit"
                class="bg-custom-blue text-white px-6 py-3 rounded-xl shadow hover:bg-custom-blue-700 transition font-semibold">
                Filtrar
              </button>
            </div>
          </form>
        </div>
      </div>

      
      <div class="w-full sm:w-auto text-right">
      <a
  href="<?php echo e(route('teacher.reporte_pdf', [
    'classroom_id' => request('classroom_id'),
    'status'       => request('status'),
  ])); ?>"
  target="_blank"
  class="inline-block bg-custom-blue text-white px-6 py-3 rounded-xl shadow hover:bg-blue-900 font-semibold transition w-full sm:w-auto text-center"
>
  Generar Reporte PDF
</a>

      </div>
    </div>

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
          <?php $__currentLoopData = $justifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $j): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <tr class="border-b custom-blue-hover cursor-pointer"
              @click="openModal({
                id: '<?php echo e($j->id); ?>',
                estudiante: '<?php echo e(addslashes($j->student->name ?? '-')); ?>',
                clase: '<?php echo e(addslashes($j->classroom->name ?? '-')); ?>',
                motivo: '<?php echo e(addslashes($j->motivo)); ?>',
                comentario: '<?php echo e(addslashes($j->comentario)); ?>',
                archivo: '<?php echo e($j->archivo ? Storage::url($j->archivo) : ''); ?>',
                estado: '<?php echo e(ucfirst($j->status)); ?>'
              })">
            <td class="py-2 px-4 text-center align-middle"><?php echo e($j->student->name ?? '-'); ?></td>
            <td class="py-2 px-4 text-center align-middle"><?php echo e($j->classroom->name ?? '-'); ?></td>
            <td class="py-2 px-4 text-center align-middle"><?php echo e($j->motivo); ?></td>
            <td class="py-2 px-4 text-center align-middle"><?php echo e($j->comentario); ?></td>
            <td class="py-2 px-4 text-center align-middle">
              <?php if($j->archivo): ?>
              <a href="<?php echo e(Storage::url($j->archivo)); ?>" target="_blank" class="text-blue-700 underline">Ver archivo</a>
              <?php endif; ?>
            </td>
            <td class="py-2 px-4 text-center align-middle"><?php echo e(ucfirst($j->status)); ?></td>
          </tr>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
      </table>
    </div>

    
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
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php /**PATH /Users/mariabelenaa/JUSTIFICACIONES_GIT_3.0/Justificaciones_Laravel/resources/views/teacher/index.blade.php ENDPATH**/ ?>