<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
          {{ __('Notificaciones') }}
      </h2>
  </x-slot>

  <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

          <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
              
                <h1 class="text-2xl my-8 font-bold text-center">Mis Notificaciones </h1>
                <div class="divide-y divide-gray-500">
                    @forelse ($notifications as $notification)
                        <div class="p-5 md:flex md:items-center md:justify-between">
                            <div>
                                <p>Tienes un Nuevo Candidato en:
                                <span class="font-bold">{{ $notification -> data['vacancy_title']}}</span>
                                </p>
                                <p>
                                    <span class="font-bold">{{ $notification -> created_at ->diffForHumans() }}</span>
                                </p>
                            </div>

                            <div class="mt-5 md:mt-0">
                                <a href="{{ route('candidates.index', $notification ->data['vacancy_id'] ) }}" 
                                class="text-sm font-bold bg-indigo-500  dark:bg-indigo-700 hover:bg-indigo-600 p-2 rounded-lg block text-center">
                                Ver Candidatos
                                </a>
                            </div>
                        </div>
                    @empty
                        <p class="text-center ">No tienes Notificaciones Nuevas</p>
                    @endforelse
               </div>
            </div>
        </div>
        
          
      </div>
  </div>
</x-app-layout>
