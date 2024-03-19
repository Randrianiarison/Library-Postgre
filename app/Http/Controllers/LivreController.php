<?php

namespace App\Http\Controllers;

use App\Models\livre;
use App\Models\Utilisateur;
use Illuminate\Http\Request;

class LivreController extends Controller
{
    public function index()
    {
        $livres = Livre::all();
        $user = Utilisateur::all();
        return view('livres.index', compact('livres','user'));
    }

    public function store(Request $request)
    {
        $isbn = $this->generateUniqueISBN();

        Livre::create([
            'titre' => $request->titre,
            'auteur' => $request->auteur,
            'genre' => $request->genre,
            'nombre' => $request->nombre,
            'annee_publication' => $request->annee_publication,
            'ISBN' => $isbn,
        ]);

        return redirect()->route('livre.index')->with('success', 'Le livre a été ajouté avec succès.');
    }
    private function generateUniqueISBN()
    {
        do {
            $isbn = '123' . mt_rand(0, 999999999999);
        } while (Livre::where('ISBN', $isbn)->exists());

        return $isbn;
    }



    public function destroy($id)
    {
        $livre = Livre::findOrFail($id);
        $livre->delete();
        return redirect()->route('livre.index')->with('success', 'Le livre a été supprimé avec succès.');
    }

    public function update(Request $request, $id)
    {
        $livre = Livre::findOrFail($id);
        $livre->update([
            'titre' => $request->titre,
            'auteur' => $request->auteur,
            'genre' => $request->genre,
            'nombre' => $request->nombre,
            'annee_publication' => $request->annee_publication,
            'ISBN' => $request->ISBN,
        ]);
        return redirect()->route('livre.index')->with('success', 'Le livre a été modifié avec succès.');
    }


    public function search(Request $request)
    {
        $query = $request->input('q');
        $livres = Livre::query();

        if ($query) {
            $livres->where(function($queryBuilder) use ($query) {
                $queryBuilder->where('titre', 'like', '%'.$query.'%')
                    ->orWhere('auteur', 'like', '%'.$query.'%')
                    ->orWhere('genre', 'like', '%'.$query.'%')
                    ->orWhere('annee_publication', 'like', '%'.$query.'%')
                    ->orWhere('ISBN', 'like', '%'.$query.'%');
            });
        }

        $livres = $livres->get();
        return view('livres.index', compact('livres'));
    }



}
