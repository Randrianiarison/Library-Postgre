<?php

namespace App\Http\Controllers;

use App\Models\Auteur;
use Illuminate\Http\Request;

class AuteurController extends Controller
{
    public function index() {
        $auteur = Auteur::all();
        return view('auteur.index', compact('auteur'));
    }
    public function store(Request $request)
    {
        Auteur::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'dateN' => $request->dateN,
            'biographie' => $request->biographie,
        ]);
        return redirect()->route('auteurs.index')->with('success', 'Auteur ajouté avec succès!');
    }
}
