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
    <h2 class="text-2xl font-bold mb-4 text-custom-blue">Apelaciones de Justificaciones</h2>

    <?php if(session('success')): ?>
    <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4 font-montserrat"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    
    <h3 class="text-lg font-semibold mb-2 font-montserrat">Justificaciones Rechazadas</h3>
    <div class="overflow-x-auto">
      <table class="min-w-full bg-white rounded-xl shadow-lg overflow-hidden text-sm">
        <tr class="bg-custom-blue text-white">
          <th class="py-2 px-4">Clase</th>
          <th class="py-2 px-4">Profesor</th>
          <th class="py-2 px-4">Motivo</th>
          <th class="py-2 px-4">Comentario</th>
          <th class="py-2 px-4">Motivo Rechazo</th>
          <th class="py-2 px-4">Fecha Rechazo</th>
          <th class="py-2 px-4">Acción</th>
        </tr>
        <?php $__empty_1 = true; $__currentLoopData = $justifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $j): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <?php if($j->status == 'rechazado'): ?>
        <tr class="border-b">
          <td class="py-2 px-4 text-center align-middle"><?php echo e($j->classroom->name); ?></td>
          <td class="py-2 px-4 text-center align-middle"><?php echo e($j->professor->name); ?></td>
          <td class="py-2 px-4 text-center align-middle"><?php echo e($j->motivo); ?></td>
          <td class="py-2 px-4 text-center align-middle"><?php echo e($j->comentario); ?></td>
          <td class="py-2 px-4 text-center align-middle"><?php echo e($j->respuesta_admin); ?></td>
          <td class="py-2 px-4 text-center align-middle"><?php echo e($j->updated_at->format('d/m/Y')); ?></td>
          <td class="py-2 px-4 text-center align-middle">
            <button onclick="openApelacionModal(<?php echo e($j->id); ?>, '<?php echo e(addslashes($j->classroom->name)); ?>')"
              class="bg-custom-blue text-white px-2 py-1 rounded hover:bg-custom-blue font-montserrat">
              Apelar
            </button>
          </td>
        </tr>
        <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <tr>
          <td colspan="7" class="py-4 text-center text-gray-500 font-montserrat">No tienes justificaciones rechazadas en
            los
            últimos 7 días.</td>
        </tr>
        <?php endif; ?>
      </table>
    </div>

    
    <h3 class="text-lg font-semibold mb-2 mt-8 font-montserrat">Apelaciones Realizadas</h3>
    <div class="overflow-x-auto">
      <table class="min-w-full bg-white rounded-xl shadow-lg overflow-hidden text-sm">
        <tr class="bg-custom-blue text-white ">
          <th class="py-2 px-4 ">Clase</th>
          <th class="py-2 px-4">Profesor</th>
          <th class="py-2 px-4">Motivo</th>
          <th class="py-2 px-4">Comentario Apelación</th>
          <th class="py-2 px-4">Motivo Rechazo</th>
          <th class="py-2 px-4">Fecha Apelación</th>
        </tr>
        <?php $hayApeladas = false; ?>
        <?php $__currentLoopData = $justifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $j): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if($j->status == 'apelado'): ?>
        <?php $hayApeladas = true; ?>
        <tr class="border-b">
          <td class="py-2 px-4 text-center align-middle"><?php echo e($j->classroom->name); ?></td>
          <td class="py-2 px-4 text-center align-middle"><?php echo e($j->professor->name); ?></td>
          <td class="py-2 px-4 text-center align-middle"><?php echo e($j->motivo); ?></td>
          <td class="py-2 px-4 text-center align-middle"><?php echo e($j-> motivo_apelacion); ?></td>
          <td class="py-2 px-4 text-center align-middle"><?php echo e($j->respuesta_admin); ?></td>
          <td class="py-2 px-4 text-center align-middle"><?php echo e($j->updated_at->format('d/m/Y')); ?></td>
        </tr>
        <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php if (! ($hayApeladas)): ?>
        <tr>
          <td colspan="6" class="py-4 text-center text-gray-500 font-montserrat">No tienes apelaciones realizadas.</td>
        </tr>
        <?php endif; ?>
      </table>
    </div>

    <!-- Modal de Apelación -->
    <div id="apelacion-modal" class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50 hidden">
      <div class="bg-white rounded shadow-lg p-6 w-full max-w-md mx-4 relative font-montserrat">
        <button onclick="closeApelacionModal()"
          class="absolute top-2 right-2 text-gray-500 hover:text-black text-xl">&times;</button>
        <h3 class="text-lg font-bold mb-4 text-custom-blue">Apelar Justificación <span id="modal-clase"></span></h3>
        <form id="apelacion-form" method="POST" action="" enctype="multipart/form-data">
          <?php echo csrf_field(); ?>
          <input type="text" name="motivo_apelacion" placeholder="Motivo de apelación" required
            class="border border-custom-blue rounded px-2 py-1 text-sm mb-2 w-full font-montserrat focus:ring-custom-blue" />
          <input type="file" name="archivo_apelacion" accept=".pdf,.jpg,.jpeg,.png"
            class="block mt-2 mb-4 font-montserrat" />
          <button type="submit"
            class="bg-custom-blue text-white px-4 py-2 rounded hover:bg-custom-blue w-full font-montserrat">Enviar
            Apelación</button>
        </form>
      </div>
    </div>
  </div>

  <script>
  function openApelacionModal(justificacionId, claseNombre) {
    document.getElementById('apelacion-modal').classList.remove('hidden');
    document.getElementById('modal-clase').textContent = claseNombre;
    document.getElementById('apelacion-form').action = '/student/apelar/' + justificacionId;
  }

  function closeApelacionModal() {
    document.getElementById('apelacion-modal').classList.add('hidden');
    document.getElementById('apelacion-form').reset();
    document.getElementById('modal-clase').textContent = '';
  }

  document.addEventListener('click', function(e) {
    const modal = document.getElementById('apelacion-modal');
    if (!modal.classList.contains('hidden') && e.target === modal) {
      closeApelacionModal();
    }
  });
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
<?php /**PATH /Users/mariabelenaa/JUSTIFICACIONES_GIT_3.0/Justificaciones_Laravel/resources/views/student/apelaciones.blade.php ENDPATH**/ ?>