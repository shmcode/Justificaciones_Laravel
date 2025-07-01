<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>Justificaciones UAM</title>
  <script src="https://cdn.tailwindcss.com"></script>


  <style>
  body,
  .font-montserrat,
  input,
  button,
  select,
  textarea,
  th,
  td,
  h1,
  h2,
  h3,
  h4,
  h5,
  h6 {
    font-family: 'Montserrat', Arial, sans-serif !important;
  }

  .bg-custom-blue {
    background-color: #38aeb6 !important;
  }

  .text-custom-blue {
    color: #38aeb6 !important;
  }

  .border-custom-blue {
    border-color: #38aeb6 !important;
  }

  .hover\:bg-custom-blue:hover {
    background-color: #38aeb6 !important;
  }

  .focus\:ring-custom-blue:focus {
    box-shadow: 0 0 0 2px #38aeb6 !important;
  }
  </style>
  <!-- Google Fonts Montserrat -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700&display=swap" rel="stylesheet">
</head>

<body class="bg-gray-100 min-h-screen">
  <nav class="bg-gray-50 border-b border-gray-200 shadow-sm font-montserrat">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex justify-between items-center h-16">
        <div class="flex-shrink-0">
          <img src="{{ asset('img/logouam.webp') }}" alt="UAM Logo" class="h-10">
        </div>
        <div class="hidden md:flex space-x-4 items-center">
          @auth
          @if(auth()->user()->role === 'student')
          <a href="/student" class="px-3 py-2 rounded text-black transition hover:bg-custom-blue hover:text-white">Mis
            Justificaciones</a>
          <a href="/justifications/create"
            class="px-3 py-2 rounded text-black transition hover:bg-custom-blue hover:text-white">Nueva
            Justificación</a>
          <a href="/student/apelaciones"
            class="px-3 py-2 rounded text-black transition hover:bg-custom-blue hover:text-white">Apelaciones</a>
          @elseif(auth()->user()->role === 'admin')
          <a href="/admin" class="px-3 py-2 rounded text-black transition hover:bg-custom-blue hover:text-white">Panel
            Admin</a>
          <a href="/teachers"
            class="px-3 py-2 rounded text-black transition hover:bg-custom-blue hover:text-white">Profesores</a>
          @elseif(auth()->user()->role === 'professor')
          <a href="/teacher" class="px-3 py-2 rounded text-black transition hover:bg-custom-blue hover:text-white">Panel
            Profesor</a>
          @endif
          <form method="POST" action="/logout" class="inline">
            @csrf
            <button type="submit"
              class="px-3 py-2 rounded text-black transition hover:bg-custom-blue hover:text-white">Salir</button>
          </form>
          @endauth
        </div>
        <!-- Botón hamburguesa -->
        <div class="md:hidden flex items-center">
          <button onclick="toggleMenu()" class="text-gray-700 focus:outline-none">
            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
          </button>
        </div>
      </div>
    </div>

    <!-- Menú móvil -->
    <div id="mobile-menu" class="md:hidden hidden px-4 pb-4">
      @auth
      @if(auth()->user()->role === 'student')
      <a href="/student" class="block px-3 py-2 rounded text-black transition hover:bg-custom-blue hover:text-white">Mis
        Justificaciones</a>
      <a href="/justifications/create"
        class="block px-3 py-2 rounded text-black transition hover:bg-custom-blue hover:text-white">Nueva
        Justificación</a>
      <a href="/student/apelaciones"
        class="block px-3 py-2 rounded text-black transition hover:bg-custom-blue hover:text-white">Apelaciones</a>
      @elseif(auth()->user()->role === 'admin')
      <a href="/admin" class="block px-3 py-2 rounded text-black transition hover:bg-custom-blue hover:text-white">Panel
        Admin</a>
      <a href="/teachers"
        class="block px-3 py-2 rounded text-black transition hover:bg-custom-blue hover:text-white">Profesores</a>
      @elseif(auth()->user()->role === 'professor')
      <a href="/teacher"
        class="block px-3 py-2 rounded text-black transition hover:bg-custom-blue hover:text-white">Panel Profesor</a>
      @endif
      <form method="POST" action="/logout">
        @csrf
        <button type="submit"
          class="block w-full text-left px-3 py-2 rounded text-black transition hover:bg-custom-blue hover:text-white">Salir</button>
      </form>
      @endauth
    </div>
  </nav>

  <div class="container mx-auto mt-8 px-4 sm:px-6 lg:px-8">
    {{ $slot }}
  </div>

  <script>
  function toggleMenu() {
    const menu = document.getElementById('mobile-menu');
    menu.classList.toggle('hidden');
  }
  </script>
</body>

</html>