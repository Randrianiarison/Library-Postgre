<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class pdfController extends Controller
{
    public function generatePdf()
    {

        $pdf = Pdf::loadView('pdf.invoice', $data);
        return $pdf->download('invoice.pdf');
    }
}
