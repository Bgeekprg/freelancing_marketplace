<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Freelancer;
use App\Models\Client;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
// use DB;
use Auth;
use Mail;
use App\Mail\VerifyMail;
use App\Mail\sendOtp;
use Session;


class AuthController extends Controller
{       
    
    public function Login()
    {   if(Session::has('user'))
        {
            return redirect('/dashboard');
        }
        else
        {
            return view('Login');
        }
    }
    public function postLogin(Request $request)
    {  // $request->validate([
    //     'login-selection'=>'required'
    //     ]);
    //        if($request['login-selection'] == "client")
    //     {
    //         $request->validate([
    //             'email'=>'required|email|exists:clients',
    //             'password'=>'required',
    //             'login-selection'=>'required'
    //         ]);
            
    //     $ClientloginDetail=Client::all()->where('email','=',$request->email ,'and','password','=',$request->password)->first();
      
    //     if($ClientloginDetail)
    //         {   
    //             Session::put('id',$ClientloginDetail->client_id);
    //             Session::put('user',$ClientloginDetail->username);
    //             Session::put('role',$request['login-selection']);
                
    //             return redirect('/dashboard');
                
                
    //         }
    //     }

    //     else if($request['login-selection'] == "freelancer")
    //     {
    //         $request->validate([
    //             'email'=>'required|email|exists:freelancers',
    //             'password'=>'required',
    //             'login-selection'=>'required'
    //         ]);
            
    //         $FreelancerloginDetail=DB::select('select * from freelancers where email = ? and password = ?', [$request->email,$request->password]);
    //         if($FreelancerloginDetail)
    //         {   
    //             Session::put('id',$FreelancerloginDetail[0]->freelancer_id);
    //             Session::put('user',$FreelancerloginDetail[0]->username);
    //             Session::put('role',$request['login-selection']);

    //             return redirect('/dashboard');
                
    //         }
    //     }
        
    $request->validate([
                    'email'=>'required|email|exists:users',
                    'password'=>'required|exists:users',
                    
                ]); 
    $userdata=DB::table('users')->where('email','=',$request->email,'and','password','=',$request->password)->first();
    // dd($userdata);
    if($userdata->role=='F')
    {   
        $freelancer=DB::table('freelancers')->where('email','=',$userdata->email)->first();
        if($freelancer->status==1){
        Session::put('id',$freelancer->freelancer_id);
        Session::put('user',$freelancer->username);
        Session::put('role','freelancer');
    
        return redirect('/dashboard');
        }
        return redirect()->back()->with('inactive','Your Account is inactive');
    
    }
    else if($userdata->role=='C')
    {   
        $client=DB::table('clients')->where('email','=',$userdata->email)->first();
        if($client->status==1){
        Session::put('id',$client->client_id);
        Session::put('user',$client->username);
        Session::put('role','client');
    
        return redirect('/dashboard');
        }
        return redirect()->back()->with('inactive','Your Account is inactive');
       
    }
     

    }


    public function dashboard()
    {
    
    
    
            if(Session('role')=='client')
            {   
            
                return view('/client/dashboard');
            
            }
            else if(Session('role')=='freelancer')
            {
            return view('/freelancer/dashboard');
            }
            else if(Session('role')=='Admin')
            {
                return view('Admin.dashboard');
            }
        
    }


    public function postRegister(Request $request)
    {   
        
        $validated=$request->validate([
            'firstname'=>'alpha|required',
            'lastname'=>'alpha|required',
            'username' => 'required|unique:freelancers|max:25',
            'email' => 'unique:freelancers|email',
            'password' => 'required|min:6|required_with:cPassword|same:cPassword',
            'contact' => 'required|max:10|min:10',
            'cPassword'=> 'min:6', 
            'rselection'=>'required'

        ]);
        if($request->rselection == "freelancer"){
        
        Freelancer::create($request->all());
        DB::insert('insert into users (email,password,role) values (?, ?,?)', [$request->email,$request->password,'F']);
        $uid=DB::table('users')->where('email','=',$request->email)->first();
        
        
        DB::table('freelancers')->where('email','=',$request->email)->update(['user_id'=>$uid->user_id]);

        $data=[
            'title'=>'mail from freelancing',
            'body'=>$request->username ,
        ];
        
        Mail::to('bhaveshpr54@gmail.com')->send(new VerifyMail($data));
        
        return redirect('/')->with('success','Your Account created successfully,
        please login and complete your profile !');  
    }
    else{
        
        Client::create($request->all());
        DB::insert('insert into users (email,password,role) values (?, ?,?)', [$request->email,$request->password,'C']);
        $uid=DB::table('users')->where('email','=',$request->email)->first();
        
        
        DB::table('clients')->where('email','=',$request->email)->update(['user_id'=>$uid->user_id]);

        $data=[
            'title'=>'mail from freelancing',
            'body'=>$request->username ,
        ];
       
        Mail::to($request->email)->send(new VerifyMail($data));
        
       
        return redirect('/')->with('success','Your Account created successfully,
        please login and complete your profile !');  

    }
        
       

         
    }


    public function changepass()
    {
        return view('changePass');
    }
    public function changepassword($fid,Request $request)
    {
        if(Session('role')=='freelancer')
        {   
            $request->validate([
                'password'=>'required|min:8',
                'new_password'=>'required|min:8',
            ]);
            $data=Freelancer::where('freelancer_id','=',$fid ,'and','password','=',$request->password)->first();
            if($data)
            {
                Freelancer::where('freelancer_id','=',$fid )->update(['password'=>$request->new_password]);
                DB::table('users')->where('password','=',$request->password)->update(['password'=>$request->new_password]);
                return redirect('dashboard');
            }
            else{

            }
        }
        elseif(Session('role')=='client')
        {   
            $request->validate([
                'password'=>'required|min:8',
                'new_password'=>'required|min:8',
            ]);
            $data=Client::where('client_id','=',$fid ,'and','password','=',$request->password)->first();

            if($data)
            {
                Client::where('client_id','=',$fid )->update(['password'=>$request->new_password]);
                DB::table('users')->where('password','=',$request->password)->update(['password'=>$request->new_password]);
                return redirect('dashboard');
            }
            else{

            }
        }
      
    }
    public function forgotpassword()
    {   
        return view('emailverify');
    }
    public function changepassforgot(Request $request)
    {
        // $otp=rand(1000,9999);
        // $data=[
        //     'title'=>'mail from freelancing',
        //     'body'=>'otp:'.$otp ,
        // ];
        // Mail::to('bhaveshpr54@gmail.com')->send(new sendOtp($data));
        // return view('verifyotp',['otp'=>$otp]);
        $request->validate([
            'email'=>'required|exists:users|email'
        ]);
            return view('changepassforgot',['email'=>$request->email]);

    }
    // public function verifyotp($otp)
    // {
    //     // $request->validate([
    //     //     'otp'=>$otp,
    //     // ]);
    //     if($request->otp==$otp)
    //     {
    //         return view('changeafterotp');
    //     }
        
    // }
    public function forgotpasswordchanged($email,Request $request)
    {   
        $userData=DB::table('users')->where('email','=',$email)->first();
        if($userData->role=='C'){
        Client::where('email',$email)->update(['password'=>$request->password]);
        DB::table('users')->where('email','=',$email)->update(['password'=>$request->password]);
        }
        else{
        Freelancer::where('email',$email)->update(['password'=>$request->password]);   
        DB::table('users')->where('email','=',$email)->update(['password'=>$request->password]);
        }
         return redirect('/');
    }
}
