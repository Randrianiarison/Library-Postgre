<?php

namespace App\Http\Controllers;

use App\Models\Emprunt;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class EmpruntController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'matricule' => 'required|string',
            'livre_id' => 'required|integer',
            'date_retour' => 'required|date'
        ]);
        Emprunt::create([
            'idEtudiant' => $request->matricule,
            'idLivre' => $request->livre_id,
            'dateEmp' => Carbon::now(),
            'dateRetour' => $request->date_retour
        ]);
        return redirect()->route('livre.index')->with('success', 'L\'emprunt a été enregistré avec succès.');
    }

    public function index()
    {
        $emprunts = Emprunt::select('emprunts.*', 'livres.titre as titre_livre')
            ->join('livres', 'emprunts.idLivre', '=', 'livres.id')
            ->get();
        return view('emprunt.index', compact('emprunts'));
    }

    public function rendreL($id)
    {
        $emprunt = Emprunt::findOrFail($id);
        $emprunt->delete();
        return redirect()->route('emprunt.index')->with('success', 'Le livre a été rendu avec succès.');
    }

}
