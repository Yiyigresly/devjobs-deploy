<div class="bg-white dark:bg-gray-900 shadow-sm  py-10 px-6">
    <h2 class="text-2xl md:text-4xl text-center font-extrabold my-5">Buscar y Filtrar Vacantes</h2>

    <div class="max-w-5xl mx-auto">
        <form wire:submit.prevent="readFormData">
            <div class="md:grid md:grid-cols-3 gap-5">
                <div class="mb-5">
                    <label 
                        class="block mb-1 text-sm uppercase font-bold "
                        for="termino">Término de Búsqueda
                    </label>
                    <input 
                        id="termino"
                        type="text"
                        wire:model="termino"
                        placeholder="Buscar por Término: ej. Laravel"
                        class="rounded-md shadow-sm border-gray-300  text-gray-700 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full"
                    />
                </div>

                <div class="mb-5">
                    <label class="block mb-1 text-sm uppercase font-bold">Categoría</label>
                    <select class="border-gray-300 text-gray-700 p-2 w-full"
                     wire:model="category">
                        <option value="">--Seleccione--</option>
            
                        @foreach ($categories as $category )
                            <option value="{{ $category->id }}">{{ $category->category }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-5">
                    <label class="block mb-1 text-sm  uppercase font-bold">Salario Mensual</label>
                    <select class="border-gray-300 text-gray-700 p-2 w-full"
                     wire:model="salary">
                        <option value="">-- Seleccione --</option>
                        @foreach ($salaries as $salary)
                            <option value="{{ $salary->id }}">{{$salary->salary}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="flex justify-end">
                <input 
                    type="submit"
                    class="bg-indigo-500 hover:bg-indigo-600 transition-colors text-white text-sm font-bold px-10 py-2 rounded cursor-pointer uppercase w-full md:w-auto"
                    value="Buscar"
                />
            </div>
        </form>
    </div>
</div>