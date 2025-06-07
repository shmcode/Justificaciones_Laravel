{{-- filepath: resources/views/layouts/app.blade.php --}}
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>Justificaciones UAM</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen">
  <nav class="bg-blue-800 text-white px-6 py-4 flex justify-between items-center">
    <div class="font-bold text-lg">Justificaciones UAM</div>
    <div class="space-x-4">
      @auth
      @if(auth()->user()->role === 'student')
      <a href="/student" class="hover:underline">Mis Justificaciones</a>
      <a href="/justifications/create" class="hover:underline">Nueva Justificación</a>
      @elseif(auth()->user()->role === 'admin')
      <a href="/admin" class="hover:underline">Panel Admin</a>
      <a href="/teachers" class="hover:underline">Profesores</a>
      @elseif(auth()->user()->role === 'professor')
      <a href="/teacher" class="hover:underline">Panel Profesor</a>
      @endif
      <a href="/profile" class="hover:underline">Perfil</a>
      <form method="POST" action="/logout" class="inline">
        @csrf
        <button type="submit" class="hover:underline">Salir</button>
      </form>
      @endauth
    </div>
  </nav>
  <div class="container mx-auto mt-8">
    {{ $slot }}
  </div>
</body>

</html>