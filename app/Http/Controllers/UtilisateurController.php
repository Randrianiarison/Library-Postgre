<?php

namespace App\Http\Controllers;

use App\Models\Utilisateur;
use Illuminate\Http\Request;

class UtilisateurController extends Controller
{
    public function index() {
        $etudiant = Utilisateur::all();
        return view('etudiant.index', compact('etudiant'));
    }

    public function store(Request $request)
    {

        $utilisateur = new Utilisateur;
        $utilisateur->nom = $request->input('nom');
        $utilisateur->prenom = $request->input('prenom');
        $utilisateur->email = $request->input('email');
        $utilisateur->departement = $request->input('departement');
        $utilisateur->matricule = $request->input('matricule');
        $utilisateur->save();

        return redirect()->route('etudiants.index')->with('success', 'Utilisateur ajouté avec succès!');
    }

    public function destroy($id)
    {
        $utilisateur = Utilisateur::findOrFail($id);
        $utilisateur->delete();
        return redirect()->route('etudiants.index')->with('success', 'Utilisateur supprimé avec succès!');
    }

    public function update(Request $request, $id)
    {
        $user = Utilisateur::findOrFail($id);
        $user->nom = $request->input('nom');
        $user->prenom = $request->input('prenom');
        $user->email = $request->input('email');
        $user->departement = $request->input('departement');
        $user->matricule = $request->input('matricule');
        $user->save();

        return redirect()->route('etudiants.index')->with('success', 'Utilisateur modifié avec succès!');
    }

}
