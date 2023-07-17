<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $data=explode(' ',$request->search);
   
       $query="SELECT freelancers.freelancer_id,username,firstname,lastname,Profession,profile_pic,description,GROUP_CONCAT(skills.skill_name) as skills from freelancers  left JOIN freelancerskills ON freelancers.freelancer_id=freelancerskills.freelancer_id  left JOIN skills ON freelancerskills.skill_id=skills.skill_id WHERE ";
        foreach($data as $d)
        {
            $query.="firstname Like '%".$d."%' or ";
        }
        foreach($data as $d)
        {
            $query.="lastname Like '%".$d."%' or ";
        }
        foreach($data as $d)
        {
            $query.="Profession Like '%".$d."%' or ";
        }
        foreach($data as $d)
        {
            $query.="username Like '%".$d."%' or ";
        }
        foreach($data as $d)
        {
            $query.="skill_name Like '%".$d."%' or ";
        }
        foreach($data as $d)
        {
            $query.="description Like '%".$d."%' or ";
        }
      
            $query.="firstname Like '%".$request->search."%' or lastname Like '%".$request->search."%' or skill_name Like '%".$request->search."%'
             or Profession Like '%".$request->search."%' or description Like '%".$request->search."%' group by freelancers.freelancer_id ,freelancers.username,firstname,lastname,profile_pic,Profession,description";
      
        
        // $search=DB::table('freelancers')
        // ->leftjoin('freelancerskills','freelancerskills.freelancer_id','=','freelancers.freelancer_id')
        // ->leftjoin('skills','freelancerskills.skill_id','=','skills.skill_id');
        // dd($search);

        try {
            $datas=DB::select($query);
        } catch (\Throwable $th) {
            throw $th;
            dd('not found');
        }
        

        return view('searchResult',['datas'=>$datas]);
            
        
       
    }
}

