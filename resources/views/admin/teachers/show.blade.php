<x-app-layout>
  <h2 class="text-2xl font-bold mb-6 text-blue-800">Detalle del Profesor</h2>
  <div class="bg-white p-6 rounded shadow max-w-md mx-auto">
    <p><strong>Nombre:</strong> {{ $teacher->name }}</p>
    <p><strong>Email:</strong> {{ $teacher->email }}</p>
    <a href="{{ route('teachers.edit', $teacher->id) }}" class="text-yellow-700 underline">Editar</a>
    <a href="{{ route('teachers.index') }}" class="text-blue-700 underline ml-4">Volver</a>
  </div>
</x-app-layout>