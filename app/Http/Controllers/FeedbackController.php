<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class FeedbackController extends Controller
{
    //
    public function show()
    {
     $feddback=DB::table('feedbacks')->paginate(10);   
     return view('Admin.feedback',['feddback'=>$feddback]);
    }
}
