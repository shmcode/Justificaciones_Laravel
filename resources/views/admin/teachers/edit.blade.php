<x-app-layout>
  <h2 class="text-2xl font-bold mb-6 text-custom-blue">Editar Profesor</h2>
  {{-- Mostrar errores si los hay --}}
  @if ($errors->any())
  <ul style="color: red; margin-bottom: 20px; padding-left: 20px; list-style-type: disc;">
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
  </ul>
  @endif
  <form method="POST" action="{{ route('teachers.update', $teacher->id) }}"
    class="max-w-md mx-auto bg-white p-6 rounded shadow space-y-4">
    @csrf
    @method('PUT')
    <div>
      <label class="block font-semibold">Nombre:</label>
      <input type="text" name="name" value="{{ $teacher->name }}" class="w-full border rounded px-3 py-2" required
        oninvalid="this.setCustomValidity('Por favor llena este campo')" oninput="this.setCustomValidity('')">
    </div>
    <div>
      <label class="block font-semibold">Email:</label>
      <input type="email" name="email" value="{{ $teacher->email }}" class="w-full border rounded px-3 py-2" required
        oninvalid="this.setCustomValidity('Por favor ingresa un correo válido')" oninput="this.setCustomValidity('')">
    </div>

    <div>
      <label class="block font-semibold">Nueva Contraseña (opcional):</label>
      <input type="password" name="password" class="w-full border rounded px-3 py-2"
        oninvalid="this.setCustomValidity('Por favor llena este campo')" oninput="this.setCustomValidity('')">
    </div>
    <button type="submit" class="bg-custom-blue text-white px-4 py-2 rounded hover:bg-blue-900">Actualizar</button>
  </form>
</x-app-layout>