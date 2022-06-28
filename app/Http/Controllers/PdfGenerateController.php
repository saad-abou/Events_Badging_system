<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;
use PDF;

class PdfGenerateController extends Controller
{
    public function CertificatGenerate(Request $request)
    {
        $data = ['user' => Auth::user()->name.' '.Auth::user()->prenom,];
        $pdf = PDF::loadView('myPdfCertif', $data);
        $pdfname =Auth::user()->name.'_'.Auth::user()->prenom.time().'.pdf';
        Storage::put('public/pdf/'.$pdfname, $pdf->output());
        return $pdfname;
    }
}