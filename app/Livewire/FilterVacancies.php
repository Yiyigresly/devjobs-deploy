<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Salary;
use Livewire\Component;

class FilterVacancies extends Component
{    //! componente HIJO: Emitir data de un componente a otro, Se va a comunicar con el Padre(Vacancies Home)

    public $termino;
    public $category;
    public $salary;

    public function readFormData(){
       // usamos el dispatch para que se comunique con el padre
       $this->dispatch('search', $this->termino, $this->category, $this->salary );
    }

    public function render()
    {
        $salaries = Salary::all();
        $categories = Category::all();

        return view('livewire.filter-vacancies', compact('categories','salaries'));
    }
}
