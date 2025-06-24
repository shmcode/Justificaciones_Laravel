<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Crear Cuenta - Sistema de Justificaciones</title>
  <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
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
    padding: 20px 40px;
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
    font-weight: bold;
  }

  .container {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    align-items: center;
    gap: 40px;
    padding: 40px 20px;
    max-width: 1200px;
    margin: 0 auto;
  }

  .image-side img {
    max-width: 350px;
    width: 100%;
    border-radius: 10px;
  }

  .form-side {
    width: 100%;
    max-width: 500px;
  }

  .form-side h2 {
    font-size: 2rem;
    color: #01A2C1;
    margin-bottom: 30px;
    text-align: center;
  }

  .form-group {
    margin-bottom: 20px;
  }

  label {
    display: block;
    margin-bottom: 5px;
    font-weight: 600;
  }

  input[type="text"],
  input[type="email"],
  input[type="password"] {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 6px;
    background-color: #f6f9ff;
  }

  .login-link {
    font-size: 0.9rem;
    margin-bottom: 20px;
    display: block;
    text-decoration: none;
    color: #333;
    text-align: center;
  }

  .login-link:hover {
    text-decoration: underline;
  }

  .btn-submit {
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

  .btn-submit:hover {
    background-color: #007b9a;
  }

  @media (max-width: 768px) {
    header {
      flex-direction: column;
      align-items: flex-start;
      gap: 10px;
      padding: 20px;
    }

    .container {
      flex-direction: column;
      padding: 20px;
    }

    .form-side {
      padding: 0 10px;
    }
  }
  </style>
</head>

<body>

  <header>
    <img src="{{ asset('img/logouam.webp') }}" alt="Logo UAM" class="logo">
    <a href="{{ url('/') }}" class="btn-sistema">Sistema de Justificaciones</a>
  </header>

  <main class="container">
    <div class="image-side">
      <img src="{{ asset('img/estudiante_sonriendo.webp') }}" alt="Estudiante">
    </div>

    <div class="form-side">
      <h2>Crear Cuenta</h2>

      @if ($errors->any())
      <div style="color: red; margin-bottom: 20px;">
        <ul>
          @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
      @endif

      <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="form-group">
          <label for="name">NOMBRE</label>
          <input type="text" id="name" name="name" value="{{ old('name') }}" required
            oninvalid="this.setCustomValidity('Por favor llena este campo')" oninput="this.setCustomValidity('')">
        </div>

        <div class="form-group">
          <label for="email">EMAIL</label>
          <input type="email" id="email" name="email" value="{{ old('email') }}" required
            oninvalid="this.setCustomValidity('Por favor ingresa un correo válido')"
            oninput="this.setCustomValidity('')">
        </div>

        <div class="form-group">
          <label for="password">CONTRASEÑA</label>
          <input type="password" id="password" name="password" required
            oninvalid="this.setCustomValidity('Por favor llena este campo')" oninput="this.setCustomValidity('')">
        </div>

        <div class="form-group">
          <label for="password_confirmation">CONFIRMAR CONTRASEÑA</label>
          <input type="password" id="password_confirmation" name="password_confirmation" required
            oninvalid="this.setCustomValidity('Por favor llena este campo')" oninput="this.setCustomValidity('')">
        </div>

        <a href="{{ route('login') }}" class="login-link">¿Ya tienes cuenta? Inicia Sesión</a>

        <button type="submit" class="btn-submit">CREAR CUENTA</button>
      </form>
    </div>
  </main>

</body>

</html>