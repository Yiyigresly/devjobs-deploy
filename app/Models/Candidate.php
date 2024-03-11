<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    use HasFactory;

    protected $fillable = [
        'cv',
        'user_id',
        'vacancy_id'
    ];

    // una candidatura va  a pertenecer a usuario role desarrollador
    public function user(){
         return $this->belongsTo(User::class);
    }
    // una candidatura va a pertenecer a una única vacante
    public function vacancy(){
         return $this->belongsTo(Vacancy::class);
    }
}
