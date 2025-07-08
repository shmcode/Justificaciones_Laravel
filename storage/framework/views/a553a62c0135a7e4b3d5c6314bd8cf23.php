<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>Iniciar Sesión - Sistema de Justificaciones</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/x-icon" href="<?php echo e(asset('favicon.ico')); ?>">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">
  <style>
  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Inter', sans-serif;
  }

  body {
    background-color: #ffffff;
  }

  header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px 60px;
    border-bottom: 1px solid #ccc;
  }

  .logo {
    height: 40px;
  }

  .btn-sistema {
    border: 1px solid #01A2C1;
    background-color: white;
    color: #01A2C1;
    padding: 8px 20px;
    border-radius: 6px;
    text-decoration: none;
  }

  .container {
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 60px 20px;
    gap: 40px;
    flex-wrap: wrap;
  }

  .image-side img {
    max-width: 350px;
    border-radius: 10px;
    width: 100%;
    height: auto;
  }

  .form-side {
    max-width: 350px;
    width: 100%;
  }

  .form-side h2 {
    font-size: 2rem;
    color: #01A2C1;
    margin-bottom: 20px;
  }

  label {
    display: block;
    margin-bottom: 5px;
    font-weight: 500;
  }

  input[type="text"],
  input[type="password"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 6px;
    background-color: #f6f9ff;
  }

  .register-link {
    font-size: 0.9rem;
    margin-bottom: 20px;
    display: block;
    text-decoration: none;
    color: #333;
  }

  .register-link:hover {
    text-decoration: underline;
  }

  .btn-acceder {
    width: 100%;
    background-color: #01A2C1;
    color: white;
    border: none;
    padding: 12px;
    font-size: 1rem;
    border-radius: 8px;
    cursor: pointer;
    transition: background-color 0.3s ease;
  }

  .btn-acceder:hover {
    background-color: #007b9a;
  }

  @media (max-width: 768px) {
    header {
      padding: 20px;
      flex-direction: column;
      align-items: flex-start;
      gap: 10px;
    }

    .form-side {
      margin-left: 0;
    }
  }
  </style>
</head>

<body>

  <header>
    <img src="<?php echo e(asset('img/logouam.webp')); ?>" alt="Logo UAM" class="logo">
    <a href="<?php echo e(url('/')); ?>" class="btn-sistema">Sistema de Justificaciones</a>
  </header>

  <main class="container">
    <div class="image-side">
      <img src="<?php echo e(asset('img/estudiante_sonriendo.webp')); ?>" alt="Estudiante">
    </div>

    <div class="form-side">
      <h2>Iniciar Sesión</h2>

      
      <?php if($errors->any()): ?>
      <ul style="color: red; margin-bottom: 20px; padding-left: 20px;">
        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <li><?php echo e($error); ?></li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </ul>
      <?php endif; ?>

      <form method="POST" action="<?php echo e(route('login')); ?>">
        <?php echo csrf_field(); ?>

        <label for="email">EMAIL</label>
        <input type="text" name="email" id="email" value="<?php echo e(old('email')); ?>" required
          oninvalid="this.setCustomValidity('Por favor ingresa un correo válido')" oninput="this.setCustomValidity('')">

        <label for="password">CONTRASEÑA</label>
        <input type="password" name="password" id="password" required
          oninvalid="this.setCustomValidity('Por favor llena este campo')" oninput="this.setCustomValidity('')">

        <a href="<?php echo e(route('register')); ?>" class="register-link">¿No tienes cuenta? Regístrate</a>

        <button type="submit" class="btn-acceder">ACCEDER</button>
      </form>
    </div>
  </main>

</body>

</html><?php /**PATH /Users/mariabelenaa/JUSTIFICACIONES_GIT_3.0/Justificaciones_Laravel/resources/views/auth/login.blade.php ENDPATH**/ ?>