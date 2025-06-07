<x-app-layout>
  <h2 class="text-2xl font-bold mb-6 text-blue-800">Nuevo Profesor</h2>
  <form method="POST" action="{{ route('teachers.store') }}"
    class="max-w-md mx-auto bg-white p-6 rounded shadow space-y-4">
    @csrf
    <div>
      <label class="block font-semibold">Nombre:</label>
      <input type="text" name="name" required class="w-full border rounded px-3 py-2">
    </div>
    <div>
      <label class="block font-semibold">Email:</label>
      <input type="email" name="email" required class="w-full border rounded px-3 py-2">
    </div>
    <div>
      <label class="block font-semibold">Contraseña:</label>
      <input type="password" name="password" required class="w-full border rounded px-3 py-2">
    </div>
    <button type="submit" class="bg-blue-800 text-white px-4 py-2 rounded hover:bg-blue-900">Guardar</button>
  </form>
</x-app-layout>