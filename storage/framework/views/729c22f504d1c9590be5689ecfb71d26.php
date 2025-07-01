
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>Reporte de Justificaciones</title>
  <style>
  body {
    font-family: DejaVu Sans, sans-serif;
    font-size: 12px;
  }

  table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
  }

  th,
  td {
    border: 1px solid #444;
    padding: 4px;
    text-align: left;
  }

  th {
    background: #2563eb;
    color: #fff;
  }
  </style>
</head>

<body>
  <h2>Reporte de Justificaciones</h2>
  <table>
    <thead>
      <tr>
        <th>Estudiante</th>
        <th>Clase</th>
        <th>Profesor</th>
        <th>Motivo</th>
        <th>Comentario</th>
        <th>Estado</th>
        <th>Fecha</th>
      </tr>
    </thead>
    <tbody>
      <?php $__currentLoopData = $justifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $j): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <tr>
        <td><?php echo e($j->student->name ?? '-'); ?></td>
        <td><?php echo e($j->classroom->name ?? '-'); ?></td>
        <td><?php echo e($j->professor->name ?? '-'); ?></td>
        <td><?php echo e($j->motivo); ?></td>
        <td><?php echo e($j->comentario); ?></td>
        <td><?php echo e(ucfirst($j->status)); ?></td>
        <td><?php echo e($j->created_at->format('d/m/Y')); ?></td>
      </tr>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
  </table>
</body>

</html><?php /**PATH /Users/mariabelenaa/JUSTIFICACIONES_GIT_3.0/Justificaciones_Laravel/resources/views/admin/reporte_pdf.blade.php ENDPATH**/ ?>