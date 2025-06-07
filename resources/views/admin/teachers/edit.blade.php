<x-app-layout>
  <h2 class="text-2xl font-bold mb-6 text-blue-800">Editar Profesor</h2>
  <form method="POST" action="{{ route('teachers.update', $teacher->id) }}"
    class="max-w-md mx-auto bg-white p-6 rounded shadow space-y-4">
    @csrf
    @method('PUT')
    <div>
      <label class="block font-semibold">Nombre:</label>
      <input type="text" name="name" value="{{ $teacher->name }}" required class="w-full border rounded px-3 py-2">
    </div>
    <div>
      <label class="block font-semibold">Email:</label>
      <input type="email" name="email" value="{{ $teacher->email }}" required class="w-full border rounded px-3 py-2">
    </div>
    <div>
      <label class="block font-semibold">Nueva Contraseña (opcional):</label>
      <input type="password" name="password" class="w-full border rounded px-3 py-2">
    </div>
    <button type="submit" class="bg-blue-800 text-white px-4 py-2 rounded hover:bg-blue-900">Actualizar</button>
  </form>
</x-app-layout>