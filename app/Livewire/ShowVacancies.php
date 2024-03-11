<?php

namespace App\Livewire;

use App\Models\Vacancy;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Livewire\Component;

class ShowVacancies extends Component

{
    #[On('delete-vacancy')] 
    public function deleteVacancy( Vacancy $vacancy){
     
        // dd($vacancy);
       $vacancy -> delete();

       if(Storage::disk('local')->exists('public/vacancies/'.$vacancy->image)){
             
         unlink(storage_path('app').'/public/vacancies/'.$vacancy->image);
       //  Storage::disk('local')->delete('/public/vacancies/'.$vacancy->image);
      }
    }
    
    public function render()
    {
        $vacancies = Vacancy::where('user_id', auth()->user()->id)->paginate(6);

        return view('livewire.show-vacancies',[
            'vacancies' => $vacancies
        ]);
    }
}
