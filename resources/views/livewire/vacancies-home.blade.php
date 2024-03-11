<div class="text-gray-900 dark:text-gray-300">

    <livewire:filter-vacancies/>
    
    <div class="py-12">
        <div class="max-w-5xl mx-auto">

            <h3 class="font-extrabold text-4xl mb-12">
                     Nuestra Vacantes Disponibles
            </h3>
            
             <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6 divide-y divide-gray-500">
                 @forelse ($vacancies as $vacancy)
                     <div class="sm:flex sm:justify-between sm:items-center py-5">

                            <div class="sm:flex-1 ">
                               <a href="{{ route('vacancies.show', $vacancy)}}"
                                 class="text-3xl font-extrabold hover:underline">
                                 {{ $vacancy->title }}
                               </a>
                               <p class="text-base mb-1 text-gray-400">{{ $vacancy->company }}</p>
                               <p class="text-base mb-1 text-gray-400">{{ $vacancy->salary->salary }}</p>
                               <p class="text-xs font-bold text-gray-400">último día para postularse: 
                                   <span class="font-normal">{{ $vacancy->last_day->format('d-m-Y')}}</span>
                                </p>
                            </div>
                            
                            <div class="mt-5 sm:mt-0">
                                <a href="{{ route('vacancies.show', $vacancy)}}"
                                class="text-sm font-bold bg-indigo-500 dark:bg-indigo-700 hover:bg-indigo-600 p-2 rounded-lg block
                                 text-center"
                                >
                                    Ver Vacante
                                </a>
                            </div>
                     </div>
                 @empty
                     <p class="p-3 text-center text-sm">
                        No Hay vacantes.
                    </p>
                 @endforelse
                </div>
                <div class="mt-10">
                   {{ $vacancies->links() }}
               </div>
        </div>
    </div>
</div>
