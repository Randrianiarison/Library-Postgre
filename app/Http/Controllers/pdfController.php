<?php

namespace App\Http\Controllers;

use App\Models\Emprunt;
use App\Models\livre;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class pdfController extends Controller
{
    public function generatePdf()
    {
        $livre = livre::all();
        $data = [
            'title' => 'PDF',
            'date' => date('m/d/y'),
            'livre' =>$livre
        ];
        $pdf = Pdf::loadView('pdf', $data);
        return $pdf->download('livres.pdf');
    }

    public function pdfEmprunt()
    {
        $emprunts = Emprunt::select('emprunts.*', 'livres.titre as titre_livre')
            ->join('livres', 'emprunts.idLivre', '=', 'livres.id')
            ->get();
        $data = [
            'title' => 'PDF',
            'date' => date('m/d/y'),
            'livre' =>$emprunts
        ];
        $pdf = Pdf::loadView('emprunt.pdf', $data);
        return $pdf->download('emprunts.pdf');
    }
}
