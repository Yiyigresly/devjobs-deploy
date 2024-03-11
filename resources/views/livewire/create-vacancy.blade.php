
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
    <form wire:submit="createVacancy"
       class="sm:w-2/3 lg:w-2/5">

        <!-- title -->
        <div class="mt-4">
            <x-input-label for="title" :value="__('Título Vacante')" />
            <x-text-input id="title" 
             class="block mt-1 w-full" 
             type="text" 
             wire:model="title" 
             :value="old('title')" 
             placeholder="Título Vacante"
             />
            @error('title')
              <livewire:show-alert :errorMessage="$message"/>    
            @enderror
        </div>

        {{-- salary --}}
        <div class="mt-4">
            <x-input-label for="salary" :value="__('Salario')" />
            <select 
                class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                wire:model="salary" 
                id="salary" 
                value="{{ old('salary') }}"
            >
                
                <option value="">-- Selecciona --</option>

                 @foreach ($salaries as $salary)
                   <option  {{ old('salary') ===  $salary->id ? 'selected' : '' }}
                     value="{{ $salary->id }}">
                    {{ $salary->salary }}
                   </option>
                 @endforeach
       
            </select>
            @error('salary')
              <livewire:show-alert :errorMessage="$message"/>    
            @enderror
        </div>
        {{-- category --}}
        <div class="mt-4">
            <x-input-label for="category" :value="__('Categoría')" />
            <select 
                class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                wire:model="category" 
                id="category" 
                value="{{ old('category') }}"
            >
                <option value="">-- Selecciona Categoría --</option>
          
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" 
                     {{ old('category') === $category->id ? 'selected' : '' }}>
                        {{ $category->category }}
                    </option>
                @endforeach
       
            </select>
            @error('category')
             <livewire:show-alert :errorMessage="$message"/>    
            @enderror
        </div>

        <!-- company -->
        <div class="mt-4">
            <x-input-label for="company" :value="__('Empresa')" />
            <x-text-input id="company" 
             class="block mt-1 w-full" 
             type="text" 
             wire:model="company" 
             :value="old('company')" 
             placeholder="Nombre de Empresa: ej. Netflix, Uber, Cabify"
             />
             @error('company')
              <livewire:show-alert :errorMessage="$message"/>    
            @enderror
        </div>
        <!-- last day -->
        <div class="mt-4">
            <x-input-label for="last_day" :value="__('Último día')" />
            <x-text-input id="last_day" 
             class="block mt-1 w-full" 
             type="date" 
             wire:model="last_day" 
             :value="old('last_day')" 
             />
             @error('last_day')
               <livewire:show-alert :errorMessage="$message"/>    
             @enderror
        </div>
        <!--Description-->
        <div class="mt-4">
            <x-input-label for="description" :value="__('Descripción')" />
            <textarea name="description" 
              id="description" 
              cols="30" 
              rows="5"
              wire:model="description"
              placeholder="Descripción general del puesto, experiencia"
              class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
            >{{ old('description') }}</textarea>
            @error('description')
              <livewire:show-alert :errorMessage="$message"/>    
            @enderror
        </div>

        <!-- image -->
        <div class="mt-4">
            <x-input-label for="image" :value="__('Imagen')" />
            <x-text-input id="image" 
             wire:model="image"
             class="block mt-1 w-full" 
             type="file" 
             accept="image/*"
             />
            {{-- preview, esto de livewire , ojo a ello --}}
            <div class="my-3 w-60">
               @if ($image)
                   <img src="{{ $image->temporaryUrl() }}">
               @endif
            </div>

            @error('image')
              <livewire:show-alert :errorMessage="$message"/>    
            @enderror
        </div>

        <x-primary-button class="w-full justify-center my-8">
            {{ __('Crear Vacante') }}
        </x-primary-button>
    </form>

