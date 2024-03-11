<div class="p-10">

    <div class="mb-5">
        <h3 class="font-bold my-3 text-2xl capitalize">
            {{ $vacancy-> title }}
        </h3>
        <div class="md:grid md:grid-cols-2 p-4 my-10  dark:bg-gray-900">
            <p class="font-bold uppercase text-sm my-3">Empresa:
                <span class="normal-case font-normal">{{ $vacancy-> company}}</span>
            </p>
            <p class="font-bold uppercase text-sm my-3">Ultimo día para postularse:
                <span class="normal-case font-normal">{{ $vacancy-> last_day -> toFormattedDateString() }}</span>
            </p>
            <p class="font-bold uppercase text-sm my-3">Categoría:
                <span class="normal-case font-normal">{{ $vacancy-> category->category }}</span>
            </p>
            <p class="font-bold uppercase text-sm my-3">Salario:
                <span class="normal-case font-normal">{{ $vacancy-> salary->salary }}</span>
            </p>
        </div>
    </div>

    <div class=" mx-auto md:grid md:grid-cols-6 gap-4">

        <div class="md:col-span-2">
           <img 
             class="w-full sm:w-10/12 md:w-full"
             src="{{ asset('storage/vacancies/'.$vacancy->image) }}" 
             alt="imagen - {{ $vacancy->title }}">
        </div>
        
        <div class="md:col-span-4 mt-4 md:mt-0">
            <h2 class="text-2xl font-bold mb-5"> Descripción</h2>
            <p>{{ $vacancy-> description }}</p>
        </div>
        
    </div>

    {{-- comprobar si es un reclutador o un postulante para hacer algo  --}}
    @guest
        <div class="mt-5 border border-dashed p-5 text-center">
            <p>¿Deseas aplicar o postular esta vacante?
                <a href="{{ route('register') }}" 
                    class="font-bold text-indigo-700">
                    Obten una cuenta, y postula esta vacante
                </a>
            </p>
        </div>
    @endguest

    @auth
        {{-- Solo los que NO son reclutadores,  role = 1 desarrolladores, pueden ver esta seccion, la policy devuelve False Y ENTRA --}}
        @cannot('create', App\Models\Vacancy::class)
            <livewire:postulate-vacancy :vacancy="$vacancy"/>
        @endcannot
    @endauth


</div>
