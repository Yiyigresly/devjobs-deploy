<?php

namespace App\Http\Controllers;

use App\Models\Vacancy;
use Illuminate\Http\Request;

class VacancyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Vacancy::class); // solo el reclutador 2 puede ver todos los registros de este modelo
        return view('vacancies.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Vacancy::class); // solo el reclutador 2 puede crear vacantes
       return view('vacancies.create');
    }

    /**
     * Display the specified resource. //!pueden verlo tanto los reclutadores como los postulantes de empleo
     */
    public function show(Vacancy $vacancy)
    {
        return view('vacancies.show', compact('vacancy'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vacancy $vacancy)
    {
       $this->authorize('update', $vacancy);
        
       return view('vacancies.edit', compact('vacancy'));
    }

}
