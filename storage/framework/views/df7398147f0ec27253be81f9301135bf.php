
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
  <h2 class="text-2xl font-bold mb-4 text-custom-blue">Profesores</h2>

  <div x-data="{ open: false, selected: {} }">
    <div class="overflow-x-auto">
      <a href="<?php echo e(url('/teachers/create')); ?>">
        <button
          class="bg-custom-blue hover:bg-blue-600 text-white font-bold px-6 py-2 rounded-xl shadow mb-4 transition">
          <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
          </svg>
          Agregar Profesor
        </button>
      </a>
      <table class="min-w-full bg-white rounded-xl shadow-lg overflow-hidden">
        <thead>
          <tr class="bg-custom-blue text-white">
            <th class="py-3 px-4 text-center align-middle">Nombre</th>
            <th class="py-3 px-4 text-center align-middle">Correo</th>
          </tr>
        </thead>
        <tbody>
          <?php $__currentLoopData = $teachers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $teacher): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <tr class="border-b custom-blue-hover transition cursor-pointer" @click="open = true; selected = {
                                id: '<?php echo e($teacher->id); ?>',
                                name: '<?php echo e(addslashes($teacher->name)); ?>',
                                email: '<?php echo e(addslashes($teacher->email)); ?>'
                            }">
            <td class="py-2 px-4 text-center align-middle"><?php echo e($teacher->name); ?></td>
            <td class="py-2 px-4 text-center align-middle"><?php echo e($teacher->email); ?></td>

            </td>
          </tr>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
      </table>
    </div>

    <!-- Modal Detalle Profesor -->
    <div x-show="open" x-transition class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-40 z-50"
      style="display: none;">
      <div class="bg-white rounded-2xl shadow-2xl p-10 w-full max-w-lg relative max-h-[90vh] overflow-y-auto">
        <button class="absolute top-2 right-2 text-gray-400 hover:text-gray-600 text-2xl"
          @click="open = false">&times;</button>
        <div class="flex justify-between items-center mb-6">
          <h3 class="text-xl font-bold text-custom-blue">Detalle del Profesor</h3>
        </div>
        <div class="space-y-4">
          <label class="block text-sm font-medium text-gray-700">Nombre</label>
          <input type="text" class="mt-1 block w-full rounded border-gray-300 bg-gray-100" x-model="selected.name"
            disabled>
          <label class="block text-sm font-medium text-gray-700 mt-4">Correo</label>
          <input type="text" class="mt-1 block w-full rounded border-gray-300 bg-gray-100" x-model="selected.email"
            disabled>
        </div>
        <div class="flex justify-end gap-4 mt-8">
          <a :href="`/teachers/${selected.id}/edit`"
            class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold px-6 py-2 rounded-xl shadow transition flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round"
                d="M15.232 5.232l3.536 3.536M9 13l6-6m2 2l-6 6m-2 2h6" />
            </svg>
            Editar
          </a>
          <form :action="`/teachers/${selected.id}`" method="POST"
            @submit.prevent="if(confirm('¿Seguro que deseas eliminar este profesor?')) $el.submit()" class="inline">
            <?php echo csrf_field(); ?>
            <?php echo method_field('DELETE'); ?>
            <button type="submit"
              class="bg-red-500 hover:bg-red-600 text-white font-bold px-6 py-2 rounded-xl shadow transition flex items-center gap-2">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
              </svg>
              Eliminar
            </button>
          </form>

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
<?php endif; ?><?php /**PATH /Users/mariabelenaa/JUSTIFICACIONES_GIT_3.0/Justificaciones_Laravel/resources/views/admin/teachers/index.blade.php ENDPATH**/ ?>