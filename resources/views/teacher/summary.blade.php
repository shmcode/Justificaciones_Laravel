<x-layouts.app>
  <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
  <style>
    .custom-blue-hover:hover {
      background-color: #f5f5f5 !important;
      transition: background 0.2s;
    }
  </style>

  <div class="container mx-auto px-4 py-8">
    <h2 class="text-2xl font-bold mb-6 text-custom-blue">
      Resumen de Justificaciones — {{ $classroom->name }}
    </h2>

    {{-- Tarjetas de conteo --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 mb-8">
      <div class="bg-white shadow rounded-xl p-5 text-center">
        <h3 class="text-gray-600 font-semibold">Pendientes</h3>
        <p class="text-3xl font-bold text-yellow-500">{{ $status['pendiente'] ?? 0 }}</p>
      </div>
      <div class="bg-white shadow rounded-xl p-5 text-center">
        <h3 class="text-gray-600 font-semibold">Aceptadas</h3>
        <p class="text-3xl font-bold text-green-600">{{ $status['aceptado'] ?? 0 }}</p>
      </div>
      <div class="bg-white shadow rounded-xl p-5 text-center">
        <h3 class="text-gray-600 font-semibold">Rechazadas</h3>
        <p class="text-3xl font-bold text-red-600">{{ $status['rechazado'] ?? 0 }}</p>
      </div>
      <div class="bg-white shadow rounded-xl p-5 text-center">
        <h3 class="text-gray-600 font-semibold">Apeladas</h3>
        <p class="text-3xl font-bold text-yellow-700">{{ $status['apelado'] ?? 0 }}</p>
      </div>
    </div>

    {{-- Listados por estado --}}
    @foreach (['Pendientes','Aceptadas','Rechazadas','Apeladas'] as $groupTitle)
      @php $collection = $groups[$groupTitle] ?? collect(); @endphp

      @if($collection->count() > 0)
        <div class="mb-8">
          <div class="flex justify-between items-center mb-3">
            <h3 class="text-lg font-bold text-gray-700 flex items-center gap-2">
              {{ $groupTitle }}
              <span class="text-sm text-gray-500">({{ $collection->count() }})</span>
            </h3>
          </div>

          <div class="overflow-x-auto shadow-lg rounded-xl">
            <table class="min-w-full bg-white rounded-xl">
              <thead>
                <tr class="bg-custom-blue text-white text-sm uppercase">
                  <th class="py-3 px-4 text-left">ID</th>
                  <th class="py-3 px-4 text-left">Estudiante</th>
                  <th class="py-3 px-4 text-left">Motivo</th>
                  <th class="py-3 px-4 text-left">Comentario</th>
                  <th class="py-3 px-4 text-left">Fecha</th>
                  <th class="py-3 px-4 text-center">Archivo</th>
                </tr>
              </thead>
              <tbody>
                @foreach($collection as $j)
                  <tr class="border-b custom-blue-hover transition cursor-pointer">
                    <td class="py-3 px-4">#{{ $j->id }}</td>
                    <td class="py-3 px-4">{{ $j->student?->name ?? '—' }}</td>
                    <td class="py-3 px-4">{{ $j->motivo }}</td>
                    <td class="py-3 px-4">{{ \Illuminate\Support\Str::limit($j->comentario, 80) }}</td>
                    <td class="py-3 px-4">{{ $j->created_at?->format('Y-m-d H:i') }}</td>
                    <td class="py-3 px-4 text-center">
                      @if($j->archivo)
                        <a href="{{ Storage::url($j->archivo) }}" target="_blank" class="text-blue-700 underline">Ver</a>
                      @else
                        <span class="text-gray-400">—</span>
                      @endif
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      @endif
    @endforeach

    <div class="text-right mt-8">
      <a href="{{ url('/teacher') }}" class="bg-gray-200 text-gray-700 px-5 py-2 rounded-xl shadow hover:bg-gray-300 transition font-semibold">
        Volver
      </a>
    </div>
  </div>
</x-layouts.app>
