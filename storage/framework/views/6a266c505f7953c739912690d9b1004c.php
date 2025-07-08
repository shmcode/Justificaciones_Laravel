<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sistema de Justificaciones - UAM</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
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
    padding: 20px 5vw;
    border-bottom: 1px solid #ccc;
    flex-wrap: wrap;
  }

  .logo {
    height: 40px;
  }

  .btn-login,
  .btn-register {
    padding: 8px 20px;
    border: none;
    border-radius: 6px;
    text-decoration: none;
    font-weight: 600;
    text-align: center;
    display: inline-block;
  }

  .btn-login {
    color: #01A2C1;
    background: none;
  }

  .btn-register {
    background-color: #01A2C1;
    color: white;
  }

  .header-buttons {
    display: flex;
    gap: 10px;
    margin-top: 10px;
  }

  .hero {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    background-color: #B9D9DE;
    padding: 60px 5vw;
    text-align: center;
  }

  .hero-content h1 {
    font-size: 2rem;
    color: #fff;
  }

  .hero img {
    max-width: 100%;
    width: 280px;
    margin-top: 20px;
  }

  .section-title {
    text-align: center;
    margin: 40px 20px 20px;
    font-size: 1.8rem;
    color: #01A2C1;
    font-weight: bold;
  }

  .steps {
    display: flex;
    justify-content: center;
    gap: 40px;
    margin-bottom: 40px;
    flex-wrap: wrap;
    padding: 0 20px;
    /* <-- Esto añade margen a los lados */
  }


  @media(min-width: 768px) {
    .steps {
      flex-direction: row;
      justify-content: center;
    }
  }

  .step {
    background: #f9f9f9;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
    flex: 1 1 400px;
    /* Fuerza mismo tamaño base y responsividad */
    min-height: 160px;
    /* O el alto que desees */
    display: flex;
    flex-direction: column;
    justify-content: center;
  }


  .step span {
    font-size: 2rem;
    color: #01A2C1;
    font-weight: bold;
  }

  .login-button {
    display: block;
    margin: 0 auto 60px;
    padding: 10px 30px;
    border: 2px solid #01A2C1;
    color: #01A2C1;
    background-color: white;
    font-size: 1rem;
    border-radius: 8px;
    cursor: pointer;
  }

  footer {
    background-color: #007991;
    color: white;
    padding: 30px 5vw;
  }

  footer .footer-content {
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 20px;
  }

  footer a {
    color: white;
    text-decoration: none;
    margin-right: 10px;
  }

  footer .copyright {
    text-align: center;
    margin-top: 20px;
    font-size: 0.9rem;
  }

  .social-icons {
    display: flex;
    gap: 15px;
    margin-top: 10px;
  }

  .social-icons a {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 36px;
    height: 36px;
    background-color: white;
    color: #007991;
    border-radius: 6px;
    text-decoration: none;
    transition: background-color 0.3s ease, color 0.3s ease;
    font-size: 18px;
  }

  .social-icons a:hover {
    background-color: #01A2C1;
    color: white;
  }
  </style>
</head>

<body>
  <header>
    <img src="<?php echo e(asset('img/logouam.webp')); ?>" alt="UAM Logo" class="logo">
    <div class="header-buttons">
      <a href="<?php echo e(route('login')); ?>" class="btn-login">Inicia sesión</a>
      <a href="<?php echo e(route('register')); ?>" class="btn-register">Regístrate</a>
    </div>
  </header>

  <section class="hero">
    <div class="hero-content">
      <h1>Sistema de Justificaciones</h1>
    </div>
    <img src="<?php echo e(asset('img/persona_enferma.svg')); ?>" alt="Persona enferma">
  </section>

  <h2 class="section-title">FALTAS Y JUSTIFICACIONES</h2>

  <div class="steps">
    <div class="step">
      <span>1</span>
      <p>Completar el formulario con los datos requeridos y subir los documentos probatorios escaneados o fotografiados;
        al final el sistema te asignará un número. La presentación debe hacerse dentro de las 48 horas de la
        inasistencia.</p>
    </div>
    <div class="step">
      <span>2</span>
      <p>Te llegará la respuesta de tu solicitud dentro de las 72 horas de haberla registrado.</p>
    </div>
  </div>

  <footer>
    <div class="footer-content">
      <div>
        <strong>REDES SOCIALES</strong><br>
        <a href="https://www.facebook.com/UniversidadAmericana.UAM" target="_blank"><i
            class="fab fa-facebook-f"></i></a>
        <a href="https://www.instagram.com/uam.nicaragua/" target="_blank"><i class="fab fa-instagram"></i></a>
        <a href="https://www.linkedin.com/school/universidad-americana-uam-/posts/?feedView=all" target="_blank"><i
            class="fab fa-linkedin-in"></i></a>
        <a href="https://twitter.com/uamnica" target="_blank"><i class="fab fa-x-twitter"></i></a>
      </div>
      <div>
        <strong>CONÓCENOS</strong><br>
        <a href="https://uam.edu.ni/nosotros/">Sobre Nosotros</a>
      </div>
      <div>
  <strong>CONTÁCTANOS</strong><br>
  <a href="tel:+50522783800" class="btn-call">+(505) 2278-3800</a>
</div>

    </div>
    <div class="copyright">
      © 2025 – Universidad Americana – UAM
    </div>
  </footer>
</body>

</html><?php /**PATH /Users/mariabelenaa/JUSTIFICACIONES_GIT_3.0/Justificaciones_Laravel/resources/views/welcome.blade.php ENDPATH**/ ?>