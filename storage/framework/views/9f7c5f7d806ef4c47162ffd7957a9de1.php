
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
  <div class="container mx-auto px-4">
    <script src="//unpkg.com/alpinejs" defer></script>
    <style>
    .custom-blue-hover:hover {
      background-color: #f5f5f5 !important;
      transition: background 0.2s;
    }
    </style>

    <div x-data="{ open: false, selected: {}, showApelacion: false }">
      <h2 class="text-2xl font-bold mb-4 text-custom-blue">Te damos la bienvenida, <?php echo e(Auth::user()->name); ?>!</h2>

      
      <div x-data="{ open: false }" class="mb-6 relative">
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
        <div x-show="open" @click.away="open = false" x-transition
          class="absolute left-0 mt-2 w-full max-w-md bg-white rounded-2xl shadow-xl p-6 z-10 border border-gray-100"
          style="display: none;">
          <form method="GET" action="<?php echo e(url('/student')); ?>" class="flex flex-wrap gap-6 items-end">
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
                  class="w-full bg-gray-50 border border-gray-300 rounded-xl px-5 py-3 text-left shadow focus:outline-none focus:ring-2 focus:ring-custom-blue flex justify-between items-center">
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
            <div class="flex-1 min-w-[180px]">
              <div x-data="{
                openEstado: false,
                selectedEstado: '<?php echo e(request('status')); ?>',
                estados: [
                  { id: '', name: 'Todos los estados' },
                  { id: 'pendiente', name: 'Pendiente' },
                  { id: 'aceptado', name: 'Aceptado' },
                  { id: 'rechazado', name: 'Rechazado' }
                   
                ]
              }" class="relative">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Estado</label>
                <input type="hidden" name="status" :value="selectedEstado">
                <button type="button" @click="openEstado = !openEstado"
                  class="w-full bg-gray-50 border border-gray-300 rounded-xl px-5 py-3 text-left shadow focus:outline-none focus:ring-2 focus:ring-custom-blue flex justify-between items-center">
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

      
      <div class="overflow-x-auto">
        <table class="min-w-full bg-white rounded-xl shadow-lg overflow-hidden">
          <thead>
            <tr class="bg-custom-blue text-white">
              <th class="py-3 px-4">Clase</th>
              <th class="py-3 px-4">Profesor</th>
              <th class="py-3 px-4">Motivo</th>
              <th class="py-3 px-4">Comentario</th>
              <th class="py-3 px-4">Archivo</th>
              <th class="py-3 px-4">Estado</th>
            </tr>
          </thead>
          <tbody>
            <?php $__currentLoopData = $justifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $j): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr class="cursor-pointer custom-blue-hover border-b border-gray-200" @click="open = true; showApelacion = false; selected = {
              id: '<?php echo e($j->id); ?>',
              clase: '<?php echo e(addslashes($j->classroom->name)); ?>',
              profesor: '<?php echo e(addslashes($j->professor->name)); ?>',
              motivo: '<?php echo e(addslashes($j->motivo)); ?>',
              comentario: '<?php echo e(addslashes($j->comentario)); ?>',
              archivo: '<?php echo e(addslashes($j->archivo_url)); ?>',
              status: '<?php echo e(ucfirst($j->status)); ?>',
              respuesta_admin: '<?php echo e(addslashes(ucfirst($j->respuesta_admin))); ?>'
            }">
              <td class="py-2 px-4 text-center align-middle "><?php echo e($j->classroom->name); ?></td>
              <td class="py-2 px-4 text-center align-middle"><?php echo e($j->professor->name); ?></td>
              <td class="py-2 px-4 text-center align-middle"><?php echo e($j->motivo); ?></td>
              <td class="py-2 px-4 text-center align-middle"><?php echo e($j->comentario); ?></td>
              <td class="py-2 px-4 text-center align-middle">
                <?php if($j->archivo): ?>
                <a href="<?php echo e(Storage::url($j->archivo)); ?>" target="_blank" class="text-custom-blue underline">Ver
                  archivo</a>
                <?php endif; ?>
              </td>
              <td class="py-2 px-4 text-center align-middle"><?php echo e(ucfirst($j->status)); ?></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </tbody>
        </table>
      </div>

      
      <div x-show="open" x-transition class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-40 z-50"
        style="display: none;">
        <div class="px-4 w-full">
          <div
            class="bg-white rounded-xl shadow-xl p-10 w-full max-w-2xl mx-auto relative max-h-[90vh] overflow-y-auto">
            <button class="absolute top-2 right-2 text-gray-400 hover:text-gray-600 text-2xl"
              @click="open = false">&times;</button>
            <div class="flex justify-between items-center mb-6">
              <h3 class="text-xl font-bold text-custom-blue">Detalle de Justificación</h3>
              <template x-if="selected.status">
                <span class="px-3 py-1 rounded-full text-sm font-semibold" :class="{
                  'bg-yellow-100 text-yellow-800': selected.status === 'Pendiente',
                  'bg-green-100 text-green-800': selected.status === 'Aceptado',
                  'bg-red-100 text-red-800': selected.status === 'Rechazado'
                }" x-text="selected.status"></span>
              </template>
            </div>

            
            <div class="flex justify-end gap-4 mt-8" x-show="selected.status === 'Rechazado' && !showApelacion">
              <button type="button"
                class="bg-custom-blue hover:bg-custom-blue-700 text-white font-semibold px-6 py-3 rounded-xl shadow transition flex items-center gap-2"
                @click="showApelacion = true">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
                Apelar
              </button>

              <button type="button" @click="open = false"
                class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-bold px-6 py-2 rounded-xl shadow transition">
                Cerrar
              </button>
            </div>

            
            <form x-show="showApelacion" :action="`/student/apelar/${selected.id}`" method="POST"
              enctype="multipart/form-data" class="mt-6 space-y-4">
              <?php echo csrf_field(); ?>
              <label class="block text-sm font-medium text-gray-700">Motivo de apelación</label>
              <textarea name="motivo_apelacion" required class="block w-full rounded border-gray-300 bg-gray-100"
                rows="3" placeholder="Explica por qué deseas apelar..."></textarea>
              <label class="block text-sm font-medium text-gray-700">Archivo adjunto (opcional)</label>
              <input type="file" name="archivo_apelacion" accept=".pdf,.jpg,.jpeg,.png"
                class="block w-full text-sm text-gray-700">
              <div class="flex justify-end gap-4">
                <button type="submit"
                  class="bg-custom-blue hover:bg-custom-blue-700 text-white font-semibold px-6 py-3 rounded-xl shadow transition flex items-center gap-2">
                  <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                  </svg>
                  Enviar apelación
                </button>

                <button type="button" @click="showApelacion = false"
                  class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-bold px-6 py-2 rounded-xl shadow transition">
                  Cancelar
                </button>
              </div>
            </form>

            
<form class="space-y-4 mt-6">
  <div>
    <label class="block text-sm font-medium text-gray-700">Clase</label>
    <input type="text" class="mt-1 block w-full rounded border-gray-300 bg-gray-100"
      x-model="selected.clase" disabled>
  </div>
  <div>
    <label class="block text-sm font-medium text-gray-700">Profesor</label>
    <input type="text" class="mt-1 block w-full rounded border-gray-300 bg-gray-100"
      x-model="selected.profesor" disabled>
  </div>
  <div>
    <label class="block text-sm font-medium text-gray-700">Motivo</label>
    <input type="text" class="mt-1 block w-full rounded border-gray-300 bg-gray-100"
      x-model="selected.motivo" disabled>
  </div>
  <div>
    <label class="block text-sm font-medium text-gray-700">Comentario</label>
    <textarea class="mt-1 block w-full rounded border-gray-300 bg-gray-100" x-model="selected.comentario"
      rows="2" disabled></textarea>
  </div>
  <div>
    <label class="block text-sm font-medium text-gray-700">Respuesta</label>
    <textarea class="mt-1 block w-full rounded border-gray-300 bg-gray-100"
      x-model="selected.respuesta_admin" rows="2" disabled></textarea>
  </div>
  <template x-if="selected.archivo">
    <div>
      <label class="block text-sm font-medium text-gray-700">Archivo</label>
      <template x-if="selected.archivo.toLowerCase().endsWith('.pdf')">
        <iframe :src="selected.archivo"
          class="w-full h-64 rounded border mt-2"></iframe>
      </template>
      <template
        x-if="['.jpg','.jpeg','.png','.gif','.bmp','.webp'].some(ext => selected.archivo.toLowerCase().endsWith(ext))">
        <img :src="selected.archivo" alt="Previsualización"
          class="w-auto max-h-64 rounded border mt-2 mx-auto">
      </template>
      <template
        x-if="!selected.archivo.toLowerCase().endsWith('.pdf') && !['.jpg','.jpeg','.png','.gif','.bmp','.webp'].some(ext => selected.archivo.toLowerCase().endsWith(ext))">
        <a :href="selected.archivo" target="_blank"
          class="text-custom-blue underline mt-2 block">Descargar archivo</a>
      </template>
    </div>
  </template>
</form>
          </div>
        </div>
      </div>

    </div>
  </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?><?php /**PATH /Users/mariabelenaa/JUSTIFICACIONES_GIT_3.0/Justificaciones_Laravel/resources/views/student/index.blade.php ENDPATH**/ ?>