<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Salary;
use App\Models\Vacancy;
use Livewire\Component;
use Livewire\Attributes\Validate;
use Illuminate\Validation\Rule;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class CreateVacancy extends Component

{
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

    #[Validate('required|image|max:1024')] // imagen y máximo 1 MG = 1024 kb 
    public $image;

    // validar archivos, necesario tenerlo
    use WithFileUploads;

    public function createVacancy(){

        //validations
        $data = $this->validate();

        //save the image  //almacenar  directory vacancies
        $path = $this->image->store(path:'public/vacancies'); // public/vacancies/GZStucYPeVRIdw8L3MWKD4fL1BjAKEHOP0cLCuo.jpg
        $data['image'] = explode('/',$path)[2]; //  ['public', 'vacancies', 'GZStucYPeVRIdw8L3MWKD4fL1BjAKEHOP0cLCuo.jpg'];
      
        //create the vacant
        Vacancy::create([

            'title'  => $data['title'],
            'salary_id' => $data['salary'],
            'category_id' => $data['category'],
            'company' => $data['company'],
            'last_day' => $data['last_day'],
            'description' => $data['description'],
            'image' =>  $data['image'],
            'user_id' => auth()->user()->id
            
        ]);

        //create a message
        session()->flash('message', 'Vacante se publicó Correctamente!!!');

        // redirect to the user

        return redirect()->route('vacancies.index');

    }

    public function render()
    {
        //request database
        $salaries = Salary::all();
        $categories = Category::all();

        return view('livewire.create-vacancy',[
           'salaries' =>$salaries,
           'categories' =>$categories
        ]);
    }
}
