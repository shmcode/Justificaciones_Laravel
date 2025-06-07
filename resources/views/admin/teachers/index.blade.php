{{-- filepath: resources/views/admin/teachers/index.blade.php --}}
<x-app-layout>
  <h2 class="text-2xl font-bold mb-6 text-blue-800">Profesores</h2>
  <a href="{{ route('teachers.create') }}"
    class="bg-blue-800 text-white px-4 py-2 rounded hover:bg-blue-900 mb-4 inline-block">Nuevo Profesor</a>
  <table class="min-w-full bg-white rounded shadow">
    <thead>
      <tr class="bg-blue-800 text-white">
        <th class="py-2 px-4">Nombre</th>
        <th class="py-2 px-4">Email</th>
        <th class="py-2 px-4">Acciones</th>
      </tr>
    </thead>
    <tbody>
      @forelse($teachers as $teacher)
      <tr class="border-b hover:bg-blue-50">
        <td class="py-2 px-4">{{ $teacher->name }}</td>
        <td class="py-2 px-4">{{ $teacher->email }}</td>
        <td class="py-2 px-4">
          <a href="{{ route('teachers.show', $teacher->id) }}" class="text-blue-700 underline">Ver</a>
          <a href="{{ route('teachers.edit', $teacher->id) }}" class="text-yellow-700 underline ml-2">Editar</a>
          <form action="{{ route('teachers.destroy', $teacher->id) }}" method="POST" class="inline ml-2">
            @csrf
            @method('DELETE')
            <button type="submit" class="text-red-700 underline"
              onclick="return confirm('¿Eliminar profesor?')">Eliminar</button>
          </form>
        </td>
      </tr>
      @empty
      <tr>
        <td colspan="3" class="py-2 px-4 text-center text-gray-500">No hay profesores registrados.</td>
      </tr>
      @endforelse
    </tbody>
  </table>
</x-app-layout>