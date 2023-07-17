<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class CountryStateController extends Controller
{
    public function getcountries()
    {
        $country=DB::table('countries')->get();
        return response()->json($country, 200);
    }
    public function getstates($countryid)
    {
        $state=DB::table('states')->where('country_id','=',$countryid)->get();
        return response()->json($state, 200);
    }
}
