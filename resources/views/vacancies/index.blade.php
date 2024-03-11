<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
          {{ __('Mis Vacantes') }}
      </h2>
  </x-slot>

  <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

          @if (session()->has('message'))
             <div class="uppercase dark:border-green-600 dark:bg-green-600 my-3 p-2 font-bold
               rounded-lg dark:text-gray-200 text-sm text-center">
                {{ session('message') }}
             </div>
          @endif

          <livewire:show-vacancies/>
          
      </div>
  </div>
</x-app-layout>
