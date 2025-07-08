<x-app-layout>
  <h2 class="text-2xl font-bold mb-6 text-custom-blue">Nuevo Profesor</h2>

  <form method="POST" action="{{ route('teachers.store') }}"
    class="max-w-md mx-auto bg-white p-6 rounded shadow space-y-4">
    @csrf

    {{-- Nombre --}}
    <div>
      <label for="name" class="block font-semibold">Nombre:</label>
      <input id="name" type="text" name="name" value="{{ old('name') }}" 
        class="w-full border rounded px-3 py-2" required
        oninvalid="this.setCustomValidity('Por favor llena este campo')" 
        oninput="this.setCustomValidity('')">
      @error('name')
        <span class="text-red-500 text-xs">{{ $message }}</span>
      @enderror
    </div>

    {{-- Email --}}
    <div>
      <label for="email" class="block font-semibold">Email:</label>
      <input id="email" type="email" name="email" value="{{ old('email') }}" 
        class="w-full border rounded px-3 py-2" required
        oninvalid="this.setCustomValidity('Por favor ingresa un correo válido')" 
        oninput="this.setCustomValidity('')">
      @error('email')
        <span class="text-red-500 text-xs">{{ $message }}</span>
      @enderror
    </div>

    {{-- Contraseña --}}
    <div>
      <label for="password" class="block font-semibold">Contraseña:</label>
      <input id="password" type="password" name="password" 
        class="w-full border rounded px-3 py-2" required
        oninvalid="this.setCustomValidity('Por favor llena este campo')" 
        oninput="this.setCustomValidity('')">
      @error('password')
        <span class="text-red-500 text-xs">{{ $message }}</span>
      @enderror
    </div>

    {{-- Facultad --}}
    <div>
      <label for="facultad_id" class="block font-semibold">Facultad:</label>
      <select id="facultad_id" name="facultad_id" 
        class="w-full border rounded px-3 py-2" required>
        <option value="">Selecciona una facultad</option>
        @foreach($facultades as $facultad)
          <option value="{{ $facultad->id }}" 
            {{ old('facultad_id') == $facultad->id ? 'selected' : '' }}>
            {{ $facultad->name }}
          </option>
        @endforeach
      </select>
      @error('facultad_id')
        <span class="text-red-500 text-xs">{{ $message }}</span>
      @enderror
    </div>

    {{-- Botón --}}
    <button type="submit" class="bg-custom-blue text-white px-4 py-2 rounded hover:bg-blue-900">
      Guardar
    </button>
  </form>
</x-app-layout>
