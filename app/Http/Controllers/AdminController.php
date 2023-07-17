<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Freelancer;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Client;
use App\Models\Feedback;
use App\Models\Order;
use App\Models\Admin;
use DB;
use Session;

class AdminController extends Controller
{
    public function show(Request $request)
    {     $path=$request->path();
        if($path == 'freelancerA'){
        $freelancer=Freelancer::paginate(10);
        return view('Admin.freelancers',['freelancer'=>$freelancer]);
        }
        elseif($path == 'clientA')
        {
        
        $client=Client::paginate(10);
        return view('Admin.clients',['client'=>$client]);
        }
        elseif($path == 'feedbackA')
        {
            // $feedback=Client::paginate(10);
            // return view('Admin.feedback',['client'=>$client]);
        }
        elseif($path == 'categoryA')
        {
            $categories=Category::paginate(10);
            return view('Admin.cat',['categories'=>$categories]);
        }
       return json_encode(['Name'=>'Bhavesh']);
    }
    public function subcateA($cid)
    {
        $subcategories=Subcategory::where('category_id',$cid)->paginate(5);
        return view('Admin.subcats',['subcategories'=>$subcategories,'cid'=>$cid]);
    }
    public function deletef($id)
    {
        Freelancer::where('freelancer_id',$id)->update(['status'=>0]);    
        return redirect()->back();
    }
    public function updatec($id,Request $request)
    {
        foreach ($request->all() as $key=> $value) {
            if($value==Null)
            {
             $request->request->remove($key);
            }
         }
         $request->request->remove('_token');
         
         
         Client::where('client_id',$id)->update($request->all());
         return redirect()->back()->with('msg','updated successfully');
    }
    public function updatef($fid,Request $request)
    {
        foreach ($request->all() as $key=> $value) {
            if($value==Null)
            {
             $request->request->remove($key);
            }
         }
         $request->request->remove('_token');
         
         
         $data=Freelancer::where('freelancer_id',$fid)->update($request->all());
        //  dd($data);
         return redirect()->back()->with('msg','updated successfully');
    }
    public function login(Request $request)
    {   $request->validate([
            'email'=>'required|exists:admins|email',
            'password'=>'required|exists:admins'
        ]);
        $admin=Admin::where(['email'=>$request->email,'password'=>$request->password])->get();
        // dd($admin);
        $request->session()->put('role','Admin');
        $request->session()->put('id',$admin[0]->admin_id);
        $request->session()->put('user',$admin[0]->username);
        
        // return view('Admin.dashboard');
        
        return redirect('/dashboard');
    }
    public function Projects()
    {
        
        $project=DB::table('orders')
        ->leftjoin('clients','orders.client_id','=','clients.client_id')
        ->leftjoin('freelancers','orders.freelancer_id','=','freelancers.freelancer_id')
        ->select('orders.*','clients.firstname as cfname','clients.lastname as clname','freelancers.firstname as ffname','freelancers.lastname as flname','freelancers.freelancer_id as freelancer_id')
        ->paginate(15);
        // dd($project);
        return view('Admin.orders',['project'=>$project]);
    }

    public function deletec($id)
    {
        Client::where('client_id',$id)->update(['status'=>0]);    
        return redirect()->back();   
    }

    public function adduser(Request $request)
    {
            $request->validate(
                [
                    'firstname'=>'alpha|required',
                    'lastname'=>'alpha|required',
                    'username' => 'required|unique:freelancers|unique:clients|max:25',
                    'email' => 'unique:freelancers|email',
                    'password' => 'required|min:6',
                    'contact' => 'required|max:10|min:10',
                    'gender'=>'required',
                    'role'=>'required',
                    
                ]
            );
        
        DB::insert('insert into users (email,password,role) values (?, ?, ?)', [
                $request->email,
                $request->password,
                $request->role,
            ]);
            $uid=DB::table('users')->where('email','=',$request->email)->first();
            if($request->role=='F')
            {
                DB::insert('insert into freelancers (email,password,username,firstname,lastname,contact,gender,user_id) values (?, ?,?,?,?,?,?,?)', [
                    $request->email,
                    $request->password,
                    $request->username,
                    $request->firstname,
                    $request->lastname,
                    $request->contact,
                    $request->gender,
                    $uid->user_id,
                ]);
            }
            elseif($request->role=='C')
            {
                DB::insert('insert into clients (email,password,username,firstname,lastname,contact,gender,user_id) values (?, ?,?,?,?,?,?,?)', [
                    $request->email,
                    $request->password,
                    $request->username,
                    $request->firstname,
                    $request->lastname,
                    $request->contact,
                    $request->gender,
                    $uid->user_id,
                ]);
            }
            return back();
    }
    public function editprofile(Request $request,$adminid)
    {
        
        foreach ($request->all() as $key=> $value) {
            if($value==Null)
            {
             $request->request->remove($key);
            }
         }
         $request->request->remove('_token');
         DB::table('admins')->where('admin_id','=',$adminid)->update($request->all());
         Session::put('user',$request->username);
         return back();
    }
    public function viewprofile()
    {   
        $admin=DB::table('admins')->where('admin_id','=',Session('id'))->first();
        return view('Admin.editadminprofile',['admin'=>$admin]);
    }

    public function registeradmin(Request $request)
    {
        $request->validate([
            'firstname'=>'alpha|required',
            'lastname'=>'alpha|required',
            'username' => 'required|unique:admins|max:25',
            'email' => 'unique:admins|email',
            'password' => 'required|min:6|required_with:cPassword|same:cPassword',
            'contact' => 'required|max:10|min:10',
            'cPassword'=> 'min:6', 
        ]);

        $request->request->remove('_token');
        $request->request->remove('cPassword');
        DB::table('admins')->insert($request->all());
        return redirect('/loginAdmin');
    }
}
