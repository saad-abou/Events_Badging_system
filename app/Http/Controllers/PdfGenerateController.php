<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use PDF;

class PdfGenerateController extends Controller
{
    public function PDFgenerate(Request $request)
    {
        $data = ['user' => Auth::user()->name.' '.Auth::user()->prenom,
                'seance' => $request->seance
                ];
        $pdf = PDF::loadView('myPDF', $data);
  
        return $pdf->download(Auth::user()->name.'_'.Auth::user()->prenom.'.pdf');
    }
}