<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rules\Can;

class Vacancy extends Model
{
    use HasFactory;

    // protected $table = 'vacancies';

    protected $fillable = [
      'title',
      'salary_id',
      'category_id',
      'company',
      'last_day',
      'description',
      'image',
      'user_id'
    ];

    protected $casts = [
      'last_day' => 'datetime',
  ];

  // relacion con category
   public function category(){

      return $this->belongsTo(Category::class);
   }
   public function salary(){

      return $this->belongsTo(Salary::class);
   }

   //? 1 vacante puede tener muchos candidatos
   public function candidates(){
      return $this-> hasMany(Candidate::class)->orderBy('created_at','desc');
   }

   //?Recuerda el user tb es reclutador; relacion 1->1, un usuario reclutador le pertenece una vacante, ya que la crea
   public function reclutador(){// es un user, me salgo del convenio de nombrado, asi que especifico id del user
      return $this->belongsTo(User::class,'user_id');
   }
}
