<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Salary;
use App\Models\Vacancy;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class EditVacancy extends Component
{
  
    public $id;

    #[Validate('required|string')] 
    public $title;

    #[Validate('required')] 
    public $salary;

    #[Validate('required')] 
    public $category;

    #[Validate('required')] 
    public $company;

    #[Validate('required')] 
    public $last_day;

    #[Validate('required')] 
    public $description;

    // imagen opcional modificarla, no validamos
    public $image;

    // propiedad para apoyarnos si es que deciden actualizar imagen 'image|max:1024'
    #[Validate('nullable|image|max:1024')] 
    public $current_image;

    // validar archivos, necesario tenerlo
    use WithFileUploads;
    
    public function mount(Vacancy $vacancy){

        // para editar la vacante,no funciona en la version 2 livewire( $id palabra reservada), en la version 3 si funciona aqui
        $this->id = $vacancy->id; 

        $this->title = $vacancy->title;
        $this->salary = $vacancy->salary_id;
        $this->category = $vacancy->category_id;
        $this->company = $vacancy->company;
        $this->last_day = Carbon::parse( $vacancy->last_day )-> format('Y-m-d');
        $this->description = $vacancy->description;
        $this->image = $vacancy->image;

    }

    public function editVacancy(){
       
        $data = $this-> validate();

        // Encontrar la vacante a editar
        $vacancy = Vacancy::find( $this->id );

        //  comprobar si hay una nueva imagen
        if($this->current_image){

           $image = $this->current_image->store(path:'public/vacancies'); //almacenar  directory storage/app/public/vacancies
           $data['image'] = explode('/', $image)[2];

           if(Storage::disk('local')->exists('public/vacancies/'.$vacancy->image)){
             
             unlink(storage_path('app').'/public/vacancies/'.$vacancy->image);
            //  Storage::disk('local')->delete('/public/vacancies/'.$vacancy->image);
           }
        }

        //asignar los valores
        $vacancy->title = $data['title'];
        $vacancy->category_id = $data['category'];
        $vacancy->salary_id = $data['salary'];
        $vacancy->company = $data['company'];
        $vacancy->last_day = $data['last_day'];
        $vacancy->description = $data['description'];
        $vacancy->image =  $data['image'] ?? $vacancy->image;

        // guardar la vacante editada
        $vacancy->save();

        // redireccionar
        session()->flash('message',' La vacante se Actualizó correctamente!!');
        return redirect()->route('vacancies.index');
    }
    public function render()
    {
        $categories = Category::all();
        $salaries = Salary::all();
        return view('livewire.edit-vacancy', compact('categories','salaries'));
    }
}
