<?php

namespace App\Livewire;

use App\Models\Vacancy;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;// evitar la recarga de la pagina

class VacanciesHome extends Component
{
    use WithPagination;
    //!componente Padre: Emitir data de un componente a otro, RECIBE LA data del hijo

    public $termino;
    public $category;
    public $salary;

    // escucha el evento search,emite el componente hijo, recibe la data y asigna a sus propias PROPIE, OJO MEJOR DEFINIRLOS PARA EVITAR PROBLEMAS
    #[On('search')] 
    public  function search($termino, $category, $salary){
        $this->termino = trim($termino);
        $this->category = $category;
        $this->salary = $salary;
        //livewire proporciona el $this->resetPage()método que le permite restablecer el número de página desde cualquier lugar de su componente.
        $this->resetPage();
    }

    public function render()
    {
        //buscar por criterios de busqueda.WHEN solo se ejecuta si hay algo
        $vacancies = Vacancy::where(function($query){
           $query->where('title','LIKE','%'.$this->termino.'%')
                 ->orWhere('company','LIKE','%'.$this->termino.'%' );
        })
        ->when($this->category,function($query){
            $query->where('category_id', $this->category );
        })
        ->when($this->salary,function($query){
            $query->where('salary_id', $this->salary );
        })
        ->paginate(7);

        //$vacancies = Vacancy::all();// las va a traer todasss, de TODOS LOS RECLUTADORES, RENDERIZA AL HOME auth o No auth
        return view('livewire.vacancies-home', compact('vacancies'));
    }
}
