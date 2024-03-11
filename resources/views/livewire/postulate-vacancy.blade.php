<div class="dark:bg-gray-900 p-5 mt-10 flex flex-col justify-center items-center">
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
   <h3 class="text-center text-2xl font-bold my-4 ">
      Postulante a esta Vacante
   </h3>

   @if (session()->has('message'))
     <p class="uppercase border border-green-700 bg-green-700 text-white font-bold p-2 my-5 text-sm rounded-md">
         {{ session('message') }}
     </p>
   @else
     
        <form class="w-96 mt-5"
         wire:submit.prevent="postulateMe">
            <div class="mb-4">
                <x-input-label for="cv" :value="__('Curriculum o Hoja de vida(PDF)')" class="uppercase"/>
                <x-text-input id="cv" class="block mt-2 w-full"
                    type="file"
                    wire:model="cv"
                    accept=".pdf"
                />
            </div>

            @error('cv')

             <livewire:showAlert :errorMessage="$message"/>
                
            @enderror

            <x-primary-button class="my-5">
                Postularme
            </x-primary-button>
        </form>
     
   @endif

</div>
