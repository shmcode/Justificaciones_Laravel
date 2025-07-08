
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Reporte de Justificaciones</title>
  <style>
    body {
      font-family: sans-serif;
      font-size: 12px;
      margin: 0;
      padding: 0;
    }
    h2 {
      text-align: center;
      color: #319795;
      margin: 1rem 0;
    }
    .filtros {
      margin: 0 1rem 1rem;
      font-size: 12px;
    }
    .filtros p {
      margin: 0.2rem 0;
    }
    .filtros span {
      font-weight: bold;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin: 0 1rem;
    }
    th, td {
      border: 1px solid #CBD5E0;
      padding: 8px;
      text-align: center;
    }
    th {
      background-color: #319795;
      color: white;
    }
  </style>
</head>
<body>
  <h2>Reporte de Justificaciones</h2>

  <div class="filtros">
    <p>
      <span>Clase:</span>
      <?php if($classroomId && $classrooms->find($classroomId)): ?>
        <?php echo e($classrooms->find($classroomId)->name); ?>

      <?php else: ?>
        Todas las clases
      <?php endif; ?>
    </p>
    <p>
      <span>Estado:</span>
      <?php echo e($status ? ucfirst($status) : 'Todos los estados'); ?>

    </p>
    <p>
      <span>Fecha:</span> <?php echo e(now()->format('d/m/Y H:i')); ?>

    </p>
  </div>

  <table>
    <thead>
      <tr>
        <th>Estudiante</th>
        <th>Clase</th>
        <th>Motivo</th>
        <th>Comentario</th>
        <th>Estado</th>
      </tr>
    </thead>
    <tbody>
      <?php $__empty_1 = true; $__currentLoopData = $justifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $j): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <tr>
          <td><?php echo e($j->student->name ?? '-'); ?></td>
          <td><?php echo e($j->classroom->name ?? '-'); ?></td>
          <td><?php echo e($j->motivo); ?></td>
          <td><?php echo e($j->comentario); ?></td>
          <td><?php echo e(ucfirst($j->status)); ?></td>
        </tr>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <tr>
          <td colspan="5">No hay justificaciones con esos filtros.</td>
        </tr>
      <?php endif; ?>
    </tbody>
  </table>
</body>
</html>
<?php /**PATH /Users/mariabelenaa/JUSTIFICACIONES_GIT_3.0/Justificaciones_Laravel/resources/views/teacher/report_pdf.blade.php ENDPATH**/ ?>