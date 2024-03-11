<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
          {{ __('Candidatos Vacante') }}
      </h2>
  </x-slot>

  <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
              <div class="p-6 text-gray-900 dark:text-gray-100">
                 
                  <h1 class="text-2xl my-8 font-bold text-center">
                    Candidatos Vacante: {{ $vacancy->title }}  
                  </h1>
                  <div class="sm:flex sm:justify-center p-3">
                     
                    <ul class="divide-y divide-gray-500 w-full">
                        @forelse ($vacancy->candidates as $candidate)
                           <li class="p-3 xs:flex xs:items-center">

                              <div class="flex-1">
                                  <p class="text-xl font-medium capitalize">
                                    {{ $candidate -> user-> name }}
                                  </p>
                                  <p class="text-sm text-gray-300">
                                    {{ $candidate -> user-> email }}
                                  </p>
                                  <p class="text-sm font-medium text-gray-300">
                                    Día que se postuló: <span class="font-normal"> {{ $candidate -> user-> created_at ->diffForHumans() }}</span>
                                  </p>
                              </div>
                              <div class="xs:mt-0 mt-4">

                                  <a href="{{ asset('storage/cv/' . $candidate->cv )}}"
                                    rel="noreferrer noopener"
                                    target="_blank"
                                    class=" w-full justify-center
                                     inline-flex xs:items-center shadow-sm px-2.5 py-0.5 border border-gray-300 font-medium rounded-full text-sm transition-all hover:bg-gray-600 hover:font-bold">
                                    Ver CV
                                  </a>
                              </div>

                           </li>
                        @empty
                          <p class="text-center text-sm p-3">No hay Candidatos Aún</p>
                        @endforelse
                    </ul>
                      
                  </div>

              </div>
          </div>
      </div>
  </div>
</x-app-layout>
