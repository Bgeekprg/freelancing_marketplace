<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use PDF;
use DB;
// use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\User;
class PDFmaker extends Controller
{
    function generate()
    {
        // $pdf=App::make('dompdf.wrapper');
        // $pdf->loadHTML('<h1>hello</h1>');
        // $data = User::all();
        
        // $data=DB::select('select * from users');
        
        $pdf = Pdf::loadView('Reports.user');//compact('data'));
        return $pdf->stream();
        // return $pdf->download('invoice.pdf');
    }
    function orderReport()
    {
        $pdf=pdf::loadView('Reports.orderreport');
        return $pdf->stream();
    }
    function freelancerReport()
    {
        $pdf=pdf::loadView('Reports.freelancer');
        return $pdf->stream();
    }
    function clientReport()
    {
        $pdf=pdf::loadView('Reports.client');
        return $pdf->stream();
    }
    function feedbackReport()
    {
        $pdf=pdf::loadView('Reports.feedback');
        return $pdf->stream();
    }
    function paymentReport()
    {
        $pdf=pdf::loadView('Reports.paymentreport');
        return $pdf->stream();
    }
    function deliveryReport()
    {
        $pdf=pdf::loadView('Reports.delivery');
        return $pdf->stream();

    }
}
