<?php if (isset($component)) { $__componentOriginal5863877a5171c196453bfa0bd807e410 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5863877a5171c196453bfa0bd807e410 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.app','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.app'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
  <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
  <style>
    .custom-blue-hover:hover {
      background-color: #f5f5f5 !important;
      transition: background 0.2s;
    }
  </style>

  <div class="container mx-auto px-4 py-8">
    <h2 class="text-2xl font-bold mb-6 text-custom-blue">
      Resumen de Justificaciones — <?php echo e($classroom->name); ?>

    </h2>

    
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 mb-8">
      <div class="bg-white shadow rounded-xl p-5 text-center">
        <h3 class="text-gray-600 font-semibold">Pendientes</h3>
        <p class="text-3xl font-bold text-yellow-500"><?php echo e($status['pendiente'] ?? 0); ?></p>
      </div>
      <div class="bg-white shadow rounded-xl p-5 text-center">
        <h3 class="text-gray-600 font-semibold">Aceptadas</h3>
        <p class="text-3xl font-bold text-green-600"><?php echo e($status['aceptado'] ?? 0); ?></p>
      </div>
      <div class="bg-white shadow rounded-xl p-5 text-center">
        <h3 class="text-gray-600 font-semibold">Rechazadas</h3>
        <p class="text-3xl font-bold text-red-600"><?php echo e($status['rechazado'] ?? 0); ?></p>
      </div>
      <div class="bg-white shadow rounded-xl p-5 text-center">
        <h3 class="text-gray-600 font-semibold">Apeladas</h3>
        <p class="text-3xl font-bold text-yellow-700"><?php echo e($status['apelado'] ?? 0); ?></p>
      </div>
    </div>

    
    <?php $__currentLoopData = ['Pendientes','Aceptadas','Rechazadas','Apeladas']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $groupTitle): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <?php $collection = $groups[$groupTitle] ?? collect(); ?>

      <?php if($collection->count() > 0): ?>
        <div class="mb-8">
          <div class="flex justify-between items-center mb-3">
            <h3 class="text-lg font-bold text-gray-700 flex items-center gap-2">
              <?php echo e($groupTitle); ?>

              <span class="text-sm text-gray-500">(<?php echo e($collection->count()); ?>)</span>
            </h3>
          </div>

          <div class="overflow-x-auto shadow-lg rounded-xl">
            <table class="min-w-full bg-white rounded-xl">
              <thead>
                <tr class="bg-custom-blue text-white text-sm uppercase">
                  <th class="py-3 px-4 text-left">ID</th>
                  <th class="py-3 px-4 text-left">Estudiante</th>
                  <th class="py-3 px-4 text-left">Motivo</th>
                  <th class="py-3 px-4 text-left">Comentario</th>
                  <th class="py-3 px-4 text-left">Fecha</th>
                  <th class="py-3 px-4 text-center">Archivo</th>
                </tr>
              </thead>
              <tbody>
                <?php $__currentLoopData = $collection; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $j): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <tr class="border-b custom-blue-hover transition cursor-pointer">
                    <td class="py-3 px-4">#<?php echo e($j->id); ?></td>
                    <td class="py-3 px-4"><?php echo e($j->student?->name ?? '—'); ?></td>
                    <td class="py-3 px-4"><?php echo e($j->motivo); ?></td>
                    <td class="py-3 px-4"><?php echo e(\Illuminate\Support\Str::limit($j->comentario, 80)); ?></td>
                    <td class="py-3 px-4"><?php echo e($j->created_at?->format('Y-m-d H:i')); ?></td>
                    <td class="py-3 px-4 text-center">
                      <?php if($j->archivo): ?>
                        <a href="<?php echo e(Storage::url($j->archivo)); ?>" target="_blank" class="text-blue-700 underline">Ver</a>
                      <?php else: ?>
                        <span class="text-gray-400">—</span>
                      <?php endif; ?>
                    </td>
                  </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </tbody>
            </table>
          </div>
        </div>
      <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <div class="text-right mt-8">
      <a href="<?php echo e(url('/teacher')); ?>" class="bg-gray-200 text-gray-700 px-5 py-2 rounded-xl shadow hover:bg-gray-300 transition font-semibold">
        Volver
      </a>
    </div>
  </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5863877a5171c196453bfa0bd807e410)): ?>
<?php $attributes = $__attributesOriginal5863877a5171c196453bfa0bd807e410; ?>
<?php unset($__attributesOriginal5863877a5171c196453bfa0bd807e410); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5863877a5171c196453bfa0bd807e410)): ?>
<?php $component = $__componentOriginal5863877a5171c196453bfa0bd807e410; ?>
<?php unset($__componentOriginal5863877a5171c196453bfa0bd807e410); ?>
<?php endif; ?>
<?php /**PATH /Users/mariabelenaa/Desktop/JUSTIFICACIONES_LARAVEL/Justificaciones_Laravel/resources/views/teacher/summary.blade.php ENDPATH**/ ?>