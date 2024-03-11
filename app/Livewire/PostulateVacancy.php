<?php

namespace App\Livewire;

use App\Models\Vacancy;
use App\Notifications\NewCandidate;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class PostulateVacancy extends Component
{
    use WithFileUploads;

    #[Validate('required|mimes:pdf')] 
    public $cv;

    public $vacancy;

    public function mount( Vacancy $vacancy){
      $this->vacancy = $vacancy;
    }

    public function postulateMe(){
        //validar
        $data = $this->validate();

        //alamcenar CV en el disco duro
        $file = $this->cv->store(path:'public/cv');
        $data['cv'] = explode('/', $file )[2];

        //crear candidato de la vacante, desde la relacion con el modelo candidato
        $this->vacancy->candidates()
          ->create([
             'cv' =>   $data['cv'] ,
             'user_id' => auth()->user()->id // user que esta postulando a la vacante
          ]);

        //? crear Notificacion y enviar el email; Accedo a la data relación(no funcionalidad), data del reclutador( user) y envio notificacion al reclutador
        $this->vacancy->reclutador->notify(new NewCandidate( // laravel sabe a quien se le va notificar
            $this->vacancy->id,
            $this->vacancy->title, 
            auth()->user()->id // personada autenticada que solicita la vacanta, el postulante
        ));

        // mostrar al usuario que s eenvio correctamente
        session()->flash('message','Se envió Correctamente tu información, Suerte.');

        return  redirect()->back();

    }

    public function render()
    {
        return view('livewire.postulate-vacancy');
    }
}
