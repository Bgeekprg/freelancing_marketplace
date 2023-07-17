<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Freelancer;
use App\Models\freelancerskill;
use App\Models\skill;
use App\Models\Order;
use DB;

class FreelancerController extends Controller
{
    public function fpview($id)
     {  
        $fdata= DB::select('select * from freelancers where freelancer_id = ?', [$id]);
        return view('freelancer/freelancerProfileView',['fdata' => $fdata]);
    }

    public function showfreelancers()
    {
        $freelancersdata= Freelancer::paginate(10);
        return view('freelancer/freelancerDetail',['freelancersdata'=>$freelancersdata]);
    }
    public function fprojects($fid)
    {
        return view('freelancer.fProjects');
    }

    public function editprofile($fid)
    {
        
        $frs=Freelancer::where('freelancer_id',$fid)->first();  
        $skill=DB::table('skills')->join('freelancerskills','freelancerskills.skill_id','=','skills.skill_id')
        ->join('freelancers','freelancers.freelancer_id','=','freelancerskills.freelancer_id')
        ->select(DB::raw('group_concat(skill_name) as skillname'))
        // ->select('skill_name')
        ->where('freelancerskills.freelancer_id','=',$fid)
        ->groupBy('skills.skill_name')
        ->get();
        
        
        return view('freelancer.editprofile',['frs'=>$frs,'skills'=>$skill]);
    }
    public function updateprofile($fid,Request $request)
    {
        foreach ($request->all() as $key=> $value) {
            if($value==Null)
            {
             $request->request->remove($key);
            }
         }
        
         if(!$request->Availability)
         {
          DB::table('freelancers')->where('freelancer_id','=',$fid)->update(['Availability'=>0]);
         }
         else
         {
            DB::table('freelancers')->where('freelancer_id','=',$fid)->update(['Availability'=>1]);
         }
           $request->request->remove('_token');
         $request->request->remove('Availability');
         $request->request->remove('category');
         $subcat=$request->subcategory_name;
         $request->request->remove('subcategory_name');
         if($request->skill_name){
         $skill=explode(',',$request->skill_name);
         foreach($skill as $i)
         {  
            skill::firstOrCreate(['skill_name'=>$i]);
         }
         foreach($skill as $i)
         {
         $skills=skill::where('skill_name','=' ,$i)->first();
         freelancerskill::create(['freelancer_id'=>Session('id'),'skill_id'=>$skills->skill_id]);
         }
        }
        $request->request->remove('skill_name');
        Freelancer::where('freelancer_id',$fid)->update($request->all());
        if($request->profile_pic)
        {
        $image=(file_get_contents($_FILES['profile_pic']['tmp_name']));
        Freelancer::where('freelancer_id',$fid)->update(['profile_pic'=>$image]);
        }
        if($subcat){
        $scd=DB::table('subcategories')->where('subcategory_name',$subcat)->first();
        Freelancer::where('freelancer_id',$fid)->update(['subcategory_id'=>$scd->subcategory_id]); 
        }
        
         return redirect()->back()->with('msg','saved successfully');
    }

    public function clientrequest($fid)
    {   $data=Order::where(['freelancer_id'=>$fid,'status'=>'O'])->get();
        
        return view('freelancer.clientRequest',['data'=>$data]);
    }
    public function Acceptrequest($oid)
    {   $data=DB::select('select * from orders where order_id = ?', [$oid]);
        Order::where('order_id',$oid)->update(['status'=>'G','final_price'=>$data[0]->budget]);
        
        DB::insert('insert into f_projects (order_id, freelancer_id) values (?, ?)', [$oid, Session('id')]);
        return redirect()->back();
    }
    public function Rejectrequest($oid)
    {
        Order::where('order_id',$oid)->update(['status'=>'E']);
        return redirect()->back();
    }

    public function feedback($fid,$cid,Request $request)
    {
        DB::insert('insert into feedbacks (feedback,freelancer_id,client_id) values (?, ?, ?)', ['"'.$request->feedback.'"',$fid,$cid]);
        return redirect()->back();
    }
    public function editfeedback($feid,Request $request)
    {
    DB::update('update feedbacks set feedback = ? where feedback_id = ?', ['"'.$request->feedback.'"',$feid]);
    return redirect()->back();
    }

    public function removeskills($skillid,$fid)
    {
        DB::table('freelancerskills')->where('skill_id','=',$skillid,'and','freelancer_id','=',$fid)->delete();
        return redirect()->back();
    }

    public function showfreelancerbycat($scatid)
    {
        $fs=Freelancer::where('subcategory_id',$scatid)->paginate(5);
        return  view('freelancer.freelancerDetail',['freelancersdata'=>$fs]);
    }
}   
