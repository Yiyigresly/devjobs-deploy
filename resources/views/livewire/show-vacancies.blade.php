<div>
    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        
        
        @forelse ($vacancies as $vacancy)
            <div class="p-6 text-gray-100 border-b border-gray-100 dark:border-gray-700 md:flex md:justify-between md:items-center">
                
                <div class="space-y-3">
                    <a href="{{ route('vacancies.show', $vacancy)}}" 
                       class="text-xl font-bold capitalize hover:underline">
                        {{ $vacancy -> title}}
                    </a>
                    <p class="text-sm font-bold">
                        {{ $vacancy-> company }}
                    </p>
                    <p class="text-sm">
                        Último día: {{ $vacancy->last_day->format('d/m/Y')}}
                    </p>
                </div>
        
                <div class="flex flex-col items-stretch xs:flex-row gap-3 xs:items-center mt-5 md:mt-0 ">
                    
                    <a href="{{ route('candidates.index', $vacancy) }}"
                    class="py-2 px-4 rounded-lg text-center text-xs font-bold bg-gray-200 hover:bg-gray-300 text-gray-700"
                    >
                      {{ $vacancy->candidates->count() }}
                      @choice('Candidato|Candidatos',$vacancy->candidates->count())
                    </a>
                    <a href="{{ route( 'vacancies.edit', $vacancy ) }}"
                    class="py-2 px-4 rounded-lg text-center text-gray-100 text-xs font-bold bg-blue-800 hover:bg-blue-900"
                    >
                        Editar
                    </a>
                    <button 
                      class="py-2 px-4 rounded-lg  text-center text-gray-100 text-xs font-bold bg-red-700 hover:bg-red-800"
                      wire:click="$dispatch('show-confirmation-modal', { vacancy: {{ $vacancy }} })"
                    >
                        Borrar
                    </button>

                </div>

            </div>
        @empty
            <p class="p-3 text-center text-sm text-gray-100">No hay vacantes que Mostrar</p>
        @endforelse

    </div>

    <div class="mt-10">
        {{ $vacancies->links() }}
    </div>
</div>
@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>

    @script
        <script>

            $wire.on('show-confirmation-modal',  vacancy => {
                 console.log(vacancy);
                Swal.fire({
                    title: `¿Eliminar Vacante <span style="color:#b33939">${ vacancy.vacancy.title }</span>?`,
                    text: "Proceso Irreversible!",
                    color:"#ecf0f1",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Sí, Eliminar!",
                    cancelButtonText:'Cancelar'
                }).then((result) => {

                    if (result.isConfirmed) {

                       // enviar data, parametro id a la clase show-vacancies, solo unicamente a la clase unido a este blade
                       $wire.dispatchSelf('delete-vacancy', vacancy);

                        Swal.fire({
                            title: "Eliminado!",
                            color:"#ecf0f1",
                            text: "Vacante Ha sido Eliminada Correctamente",
                            icon: "success"
                        });
                    }
                });
            });
        
        </script>
    @endscript
@endpush


