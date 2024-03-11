<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\Vacancy;
use Illuminate\Http\Request;

class CandidateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Vacancy $vacancy)
    {
        // OPCIONAL* :aqui podria hacer un filtro , solo el reclutaador que ha creado la vacante pueda ver sus candidatos(depende lo que se quiera)
        if (auth()->user()->id !== $vacancy->user_id) {
            # code...
            abort(403);
        }
        return view('candidates.index', compact('vacancy'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Candidate $candidate)
    {
        //
    }
}
