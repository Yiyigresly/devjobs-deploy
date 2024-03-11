<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Vacancy;
use Illuminate\Auth\Access\Response;

class VacancyPolicy
{
   
    /**
     * Determine whether the user can view the model. Determine si el usuario puede ver el modelo concreto
     */
    public function view(User $user, Vacancy $vacancy): bool
    {
        return false ;//$user->id === $vacancy->user_id;
    }
    /**
     * Determine si el usuario puede ver cualquier modelo., en este caso puede ver cualquier modelo de vacante( registros todos )
     */
    public function viewAny(User $user){

        return $user->role === 2; // usuario es reclutador=2, puede ver todos los modelos o registros de vacantes

    }
    public function create(User $user){

        return $user->role === 2; // usuario es reclutador=2, puede ver crear vacante , lo contrario postulando No puede

    }


    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Vacancy $vacancy): bool
    {
        return  $user->id === $vacancy->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Vacancy $vacancy): bool
    {
        return  $user->id === $vacancy->user_id;
    }

}
