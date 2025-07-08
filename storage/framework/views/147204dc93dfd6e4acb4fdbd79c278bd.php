
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
  <div class="max-w-3xl mx-auto bg-white rounded-2xl shadow-xl p-10 mt-8">
    <h2 class="text-2xl font-bold mb-8 text-custom-blue flex items-center gap-2">
      <svg class="w-6 h-6 text-custom-blue" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
      </svg>
      Nueva Justificación
    </h2>
    <form method="POST" action="<?php echo e(route('student.store')); ?>" enctype="multipart/form-data" class="space-y-8">
      <?php echo csrf_field(); ?>
      <script>
      window.allFacultades = <?php echo json_encode($facultades, 15, 512) ?>;
      </script>
      <div x-data="{
            facultad: '',
            profesor: '',
            clase: '',
            profesores: [],
            clases: [],
            openFacultad: false,
            openProfesor: false,
            openClase: false,
            allFacultades: window.allFacultades,
            updateProfesores() {
                const fac = this.allFacultades.find(f => f.id == this.facultad);
                this.profesores = fac ? fac.profesores : [];
                this.profesor = '';
                this.clases = [];
                this.clase = '';
            },
            updateClases() {
                const prof = this.profesores.find(p => p.id == this.profesor);
                this.clases = prof ? prof.clases : [];
                this.clase = '';
            }
        }" class="space-y-6">

        <!-- Facultad  -->
        <div class="relative">
          <label class="block text-sm font-semibold text-gray-700 mb-2">Facultad</label>
          <input type="hidden" name="facultad_id" :value="facultad">
          <button type="button" @click="openFacultad = !openFacultad"
            class="w-full bg-gray-50 border border-gray-300 rounded-xl px-5 py-3 text-left shadow focus:outline-none focus:ring-2 focus:ring-custom-blue flex justify-between items-center">
            <span x-text="allFacultades.find(f => f.id == facultad)?.name || 'Selecciona una facultad'"></span>
            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
            </svg>
          </button>
          <div x-show="openFacultad" @click.away="openFacultad = false" x-transition
            class="absolute z-10 mt-2 w-full bg-white rounded-xl shadow-lg border border-gray-100 max-h-60 overflow-auto">
            <template x-for="fac in allFacultades" :key="fac.id">
              <div @click="facultad = fac.id; openFacultad = false; updateProfesores()" :class="{
                            'bg-custom-blue text-white': facultad == fac.id,
                            'hover:bg-custom-blue hover:text-white cursor-pointer': facultad != fac.id
                        }" class="px-5 py-3 text-base transition select-none">
                <span x-text="fac.name"></span>
              </div>
            </template>
          </div>
        </div>

        <!-- Profesor  -->
        <div class="relative">
          <label class="block text-sm font-semibold text-gray-700 mb-2">Profesor</label>
          <input type="hidden" name="profesor_id" :value="profesor">
          <button type="button" @click="openProfesor = profesores.length ? !openProfesor : false"
            :disabled="!profesores.length"
            class="w-full bg-gray-50 border border-gray-300 rounded-xl px-5 py-3 text-left shadow focus:outline-none focus:ring-2 focus:ring-custom-blue flex justify-between items-center"
            :class="{'opacity-50': !profesores.length}">
            <span x-text="profesores.find(p => p.id == profesor)?.name || 'Selecciona un profesor'"></span>
            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
            </svg>
          </button>
          <div x-show="openProfesor" @click.away="openProfesor = false" x-transition
            class="absolute z-10 mt-2 w-full bg-white rounded-xl shadow-lg border border-gray-100 max-h-60 overflow-auto">
            <template x-for="prof in profesores" :key="prof.id">
              <div @click="profesor = prof.id; openProfesor = false; updateClases()" :class="{
                            'bg-custom-blue text-white': profesor == prof.id,
                            'hover:bg-custom-blue hover:text-white cursor-pointer': profesor != prof.id
                        }" class="px-5 py-3 text-base transition select-none">
                <span x-text="prof.name"></span>
              </div>
            </template>
          </div>
          <template x-if="facultad && !profesores.length">
            <p class="text-xs text-gray-400 mt-1">No hay profesores para esta facultad.</p>
          </template>
        </div>


        <!-- Clase  -->
        <div class="relative">
          <label class="block text-sm font-semibold text-gray-700 mb-2">Clase</label>
          <input type="hidden" name="classroom_id" :value="clase">
          <button type="button" @click="openClase = clases.length ? !openClase : false" :disabled="!clases.length"
            class="w-full bg-gray-50 border border-gray-300 rounded-xl px-5 py-3 text-left shadow focus:outline-none focus:ring-2 focus:ring-custom-blue flex justify-between items-center"
            :class="{'opacity-50': !clases.length}">
            <span x-text="clases.find(c => c.id == clase)?.name || 'Selecciona una clase'"></span>
            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
            </svg>
          </button>
          <div x-show="openClase" @click.away="openClase = false" x-transition
            class="absolute z-10 mt-2 w-full bg-white rounded-xl shadow-lg border border-gray-100 max-h-60 overflow-auto">
            <template x-for="cl in clases" :key="cl.id">
              <div @click="clase = cl.id; openClase = false" :class="{
                            'bg-custom-blue text-white': clase == cl.id,
                            'hover:bg-custom-blue hover:text-white cursor-pointer': clase != cl.id
                        }" class="px-5 py-3 text-base transition select-none">
                <span x-text="cl.name"></span>
              </div>
            </template>
          </div>
          <template x-if="profesor && !clases.length">
            <p class="text-xs text-gray-400 mt-1">No hay clases para este profesor.</p>
          </template>
        </div>

        <div x-data="{
        openMotivo: false,
        selectedMotivo: '<?php echo e(old('motivo')); ?>',
        motivos: [
            { id: 'Malestar', name: 'Problema de Salud' },
            { id: 'Actividad Universitaria', name: 'Actividad Universitaria' },
            { id: 'Otros', name: 'Otros' }
        ]
    }" class="relative mt-8">
          <label class="block text-sm font-semibold text-gray-700 mb-2">Motivo</label>
          <input type="hidden" name="motivo" :value="selectedMotivo">
          <button type="button" @click="openMotivo = !openMotivo"
            class="w-full bg-gray-50 border border-gray-300 rounded-xl px-5 py-3 text-left shadow focus:outline-none focus:ring-2 focus:ring-custom-blue flex justify-between items-center">
            <span x-text="motivos.find(o => o.id == selectedMotivo)?.name || 'Selecciona un motivo'"></span>
            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
            </svg>
          </button>
          <div x-show="openMotivo" @click.away="openMotivo = false" x-transition
            class="absolute z-10 mt-2 w-full bg-white rounded-xl shadow-lg border border-gray-100 max-h-60 overflow-auto">
            <template x-for="option in motivos" :key="option.id">
              <div @click="selectedMotivo = option.id; openMotivo = false" :class="{
                    'bg-custom-blue text-white': selectedMotivo == option.id,
                    'hover:bg-custom-blue hover:text-white cursor-pointer': selectedMotivo != option.id
                }" class="px-5 py-3 text-base transition select-none">
                <span x-text="option.name"></span>
              </div>
            </template>
          </div>
          <?php $__errorArgs = ['motivo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
          <span class="text-red-500 text-xs"><?php echo e($message); ?></span>
          <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div>
          <label for="comentario" class="block text-sm font-semibold text-gray-700 mb-2">Comentario</label>
          <textarea name="comentario" id="comentario" rows="3"
            class="block w-full rounded-xl border-gray-300 shadow focus:border-custom-blue focus:ring focus:ring-custom-blue-200 focus:ring-opacity-50 px-5 py-3 text-base bg-gray-50 <?php echo e($errors->has('comentario') ? 'border-red-500' : ''); ?>"><?php echo e(old('comentario')); ?></textarea>
          <?php $__errorArgs = ['comentario'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
          <span class="text-red-500 text-xs"><?php echo e($message); ?></span>
          <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div>
          <label for="archivo" class="block text-sm font-semibold text-gray-700 mb-2">Archivo (opcional)</label>
          <div class="flex items-center gap-4">
            <label
              class="cursor-pointer inline-flex items-center px-5 py-3 bg-custom-blue text-white rounded-xl shadow hover:bg-custom-blue-700 transition font-semibold">
              <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
              </svg>
              Elegir archivo
              <input type="file" name="archivo" id="archivo" class="hidden"
                onchange="document.getElementById('archivo_nombre').textContent = this.files[0]?.name || 'Ningún archivo seleccionado';">
            </label>
            <span id="archivo_nombre" class="text-gray-500 text-sm">Ningún archivo seleccionado</span>
          </div>
          <?php $__errorArgs = ['archivo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
          <span class="text-red-500 text-xs"><?php echo e($message); ?></span>
          <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div class="flex justify-end">
          <button type="submit"
            class="bg-custom-blue text-white px-8 py-3 rounded-xl shadow hover:bg-custom-blue-700 transition font-semibold">
            Enviar Justificación
          </button>
        </div>
    </form>
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
<?php endif; ?><?php /**PATH /Users/mariabelenaa/JUSTIFICACIONES_GIT_3.0/Justificaciones_Laravel/resources/views/student/create.blade.php ENDPATH**/ ?>