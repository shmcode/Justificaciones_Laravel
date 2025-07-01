<x-app-layout>
  <x-slot name="header">
    <h2 class="font-bold text-2xl text-custom-blue leading-tight flex items-center gap-2">
      <svg class="w-6 h-6 text-custom-blue" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
      </svg>
      {{ __('Dashboard') }}
    </h2>
  </x-slot>

  <div class="py-12 min-h-screen">
    <div class="max-w-4xl mx-auto px-4">
      <div class="bg-white overflow-hidden shadow-xl rounded-2xl">
        <div class="p-10 text-gray-900 text-lg font-semibold flex items-center gap-3">
          <svg class="w-6 h-6 text-custom-blue" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
          </svg>
          {{ __("¡Has iniciado sesión!") }}
        </div>
      </div>
    </div>
  </div>
</x-app-layout>