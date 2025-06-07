{{-- filepath: resources/views/student/create.blade.php --}}
<x-app-layout>
  <div class="max-w-lg mx-auto bg-white p-8 rounded shadow">
    <h2 class="text-2xl font-bold mb-6 text-blue-800">Nueva Justificación</h2>
    <form method="POST" action="{{ url('/justifications') }}" enctype="multipart/form-data" class="space-y-4">
      @csrf
      <div>
        <label class="block font-semibold">Clase:</label>
        <select id="classroom_id" name="classroom_id" required class="w-full border rounded px-3 py-2">
          <option value="">Selecciona una clase</option>
          @foreach($classrooms as $classroom)
          <option value="{{ $classroom->id }}" data-profesor="{{ $classroom->professor->name ?? 'Sin profesor' }}">
            {{ $classroom->name }}
          </option>
          @endforeach
        </select>
      </div>
      <div class="mt-2">
        <label class="block font-semibold">Profesor:</label>
        <input type="text" id="profesor_nombre" class="w-full border rounded px-3 py-2 bg-gray-100" readonly>
      </div>
      <div>
        <label class="block font-semibold">Día:</label>
        <input type="date" id="fecha" name="fecha" class="w-full border rounded px-3 py-2">
      </div>
      <div>
        <label class="block font-semibold">Horario:</label>
        <select id="horario_id" name="horario_id" required class="w-full border rounded px-3 py-2">
          <option value="">Selecciona un horario</option>
        </select>
        <p id="date-info" class="mt-2 text-blue-700"></p>
      </div>
      <div>
        <label class="block font-semibold">Motivo:</label>
        <select name="motivo" required class="w-full border rounded px-3 py-2">
          <option value="">Selecciona un motivo</option>
          <option value="Problema de Salud">Problema de Salud</option>
          <option value="Asistencia a evento UAM">Asistencia a evento UAM</option>
          <option value="Otro">Otro</option>
        </select>
      </div>
      <div>
        <label class="block font-semibold">Comentario:</label>
        <textarea name="comentario" class="w-full border rounded px-3 py-2"></textarea>
      </div>
      <div>
        <label class="block font-semibold">Archivo (opcional):</label>
        <input type="file" name="archivo" accept=".pdf,.jpg,.jpeg,.png" class="w-full">
      </div>
      <button type="submit" class="bg-blue-800 text-white px-4 py-2 rounded hover:bg-blue-900">Enviar</button>
    </form>
  </div>
  @php
  $horariosJson = $classrooms->mapWithKeys(function($c) {
  return [$c->id => $c->horarios];
  })->toJson();
  @endphp

  <script>
  const select = document.getElementById('classroom_id');
  const profesorInput = document.getElementById('profesor_nombre');
  const horarioSelect = document.getElementById('horario_id');

  // Ahora classroomHorarios es un objeto JS válido
  const classroomHorarios = JSON.parse(@json($horariosJson));

  function updateProfesorYHorarios() {
    const selected = select.options[select.selectedIndex];
    profesorInput.value = selected.dataset.profesor || '';

    // Limpiar horarios
    horarioSelect.innerHTML = '<option value="">Selecciona un horario</option>';
    const horarios = classroomHorarios[selected.value] || [];
    horarios.forEach(h => {
      const option = document.createElement('option');
      option.value = h.id;
      option.textContent = h.hora;
      horarioSelect.appendChild(option);
    });
  }

  select.addEventListener('change', updateProfesorYHorarios);
  document.addEventListener('DOMContentLoaded', updateProfesorYHorarios);
  </script>
</x-app-layout>