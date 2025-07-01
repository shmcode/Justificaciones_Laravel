
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

            
            <form method="GET" action="<?php echo e(url('/admin')); ?>" class="flex flex-col space-y-4">
            <input type="hidden" name="classroom_id" value="<?php echo e($classroomId); ?>">
            <input type="hidden" name="status"       value="<?php echo e($status); ?>">
              
              <div>
                <div x-data="{
                  openClase: false,
                  selectedClase: '<?php echo e(request('classroom_id')); ?>',
                  clases: [
                    { id: '', name: 'Todas las clases' },
                    <?php $__currentLoopData = $classrooms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      { id: '<?php echo e($c->id); ?>', name: '<?php echo e(addslashes($c->name)); ?>' },
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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

              
              <div>
                <div x-data="{
                  openEstado: false,
                  selectedEstado: '<?php echo e(request('status')); ?>',
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
          <a href="<?php echo e(route('admin.reporte.pdf', [
                'classroom_id' => request('classroom_id'),
                'status'       => request('status'),
              ])); ?>"
             target="_blank"
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
            <?php $__currentLoopData = $justifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $j): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr class="border-b custom-blue-hover transition cursor-pointer"
                @click="openDetail = true; selected = {
                   id: '<?php echo e($j->id); ?>',
                   clase: '<?php echo e(addslashes($j->classroom->name ?? "-")); ?>',
                   estudiante: '<?php echo e(addslashes($j->student->name ?? "-")); ?>',
                   motivo: '<?php echo e(addslashes($j->motivo)); ?>',
                   comentario: '<?php echo e(addslashes($j->comentario)); ?>',
                   archivo: '<?php echo e($j->archivo ? Storage::url($j->archivo) : null); ?>',
                   status: '<?php echo e(ucfirst($j->status)); ?>',
                   respuesta_admin: '<?php echo e(addslashes($j->respuesta_admin ?? "-")); ?>',
                   pendiente: '<?php echo e(in_array($j->status, ["pendiente","apelado"]) ? "1":"0"); ?>'
                }">
              
              <td class="py-2 px-4 text-center"><?php echo e($j->classroom->name); ?></td>
              <td class="py-2 px-4 text-center"><?php echo e($j->student->name); ?></td>
              <td class="py-2 px-4 text-center"><?php echo e($j->motivo); ?></td>
              <td class="py-2 px-4 text-center"><?php echo e($j->comentario); ?></td>
              <td class="py-2 px-4 text-center">
                <?php if($j->archivo): ?>
                  <a href="<?php echo e(Storage::url($j->archivo)); ?>" target="_blank"
                     class="text-custom-blue underline">Ver archivo</a>
                <?php endif; ?>
              </td>
              <td class="py-2 px-4 text-center">
                <span class="px-2 py-1 rounded text-xs font-medium
                  <?php if($j->status=='pendiente'): ?> bg-yellow-100 text-yellow-800
                  <?php elseif($j->status=='aceptado'): ?> bg-green-100 text-green-800
                  <?php elseif($j->status=='rechazado'): ?> bg-red-100 text-red-800
                  <?php else: ?> bg-yellow-200 text-yellow-900 <?php endif; ?>">
                  <?php echo e(ucfirst($j->status)); ?>

                </span>
              </td>
              <td class="py-2 px-4 text-center">
                <?php if(in_array($j->status, ['pendiente','apelado'])): ?>
                  <button onclick="openModal('accept', <?php echo e($j->id); ?>)"
                          class="bg-green-600 text-white px-2 py-1 rounded hover:bg-green-700 text-xs">Aceptar</button>
                  <button onclick="openModal('reject', <?php echo e($j->id); ?>)"
                          class="bg-red-600 text-white px-2 py-1 rounded hover:bg-red-700 ml-2 text-xs">Rechazar</button>
                <?php else: ?>
                  <span class="text-gray-400">-</span>
                <?php endif; ?>
              </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </tbody>
        </table>
      </div>
    </div>

    
    <!-- Modal Detalle, Modal de aceptación/rechazo, scripts... -->

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
<?php endif; ?>
<?php /**PATH /Users/mariabelenaa/JUSTIFICACIONES_GIT_3.0/Justificaciones_Laravel/resources/views/admin/index.blade.php ENDPATH**/ ?>