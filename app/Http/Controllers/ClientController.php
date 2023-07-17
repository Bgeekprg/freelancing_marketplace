<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Client;

class ClientController extends Controller
{
    public function directHire(Request $request,$fid)
    {   
        return view('client.directHire',['fid'=>$fid]);
    }
    public function confirmdh(Request $request,$fid)
    {   
        $validated=$request->validate(
            [
                'order_title'=>'required',
                'order_desc'=>'required|min:20',
                'budget'=>'required',
            ]
        );
        $subcat=$request->subcategory_name;
        $request->request->remove('subcategory_name');
        $skill=implode(',',$request->skills);
        // dd($request->all());

        $scd=DB::table('subcategories')->where('subcategory_name',$subcat)->get();
        if($request->order_info !=NULL){
        $fileName=time().'.'.$request->file('order_info')->getClientOriginalExtension();
        $path=$request->file('order_info')->storeAs('public/projectinfo',$fileName);
        }
        // $orderDetail=array('order_title'=>$request->order_title,
        //                     'order_desc'=>$request->order_desc,
        //                     'budget'=>$request->budget,
        //                     'subcategory_id'=>$scd[0]->subcategory_id,
        //                     'order_type'=>$request->order_type,
        //                     'skills'=>$skill,
        //                     'order_info'=>$fileName,
        //                     'client_id'=>Session('id'),
        //                     'freelancer_id'=>$fid,
        //                 );
        
                        if($request->order_info !=NULL){
                            $fileName=time().'.'.$request->file('order_info')->getClientOriginalExtension();
                            $path=$request->file('order_info')->storeAs('public/projectinfo',$fileName);
                            
                       
                        $orderDetail=array('order_title'=>$request->order_title,
                                            'order_desc'=>$request->order_desc,
                                            'budget'=>$request->budget,
                                            'subcategory_id'=>$scd[0]->subcategory_id,
                                            // 'order_type'=>$request->order_type,
                                            'freelancer_id'=>$fid,
                                            'order_type'=>'F',
                                            'skills'=>$skill,
                                            'order_info'=>$fileName,
                                            'client_id'=>Session('id')
                                        );
                                    }
                                else
                                {
                                    $orderDetail=array('order_title'=>$request->order_title,
                                    'order_desc'=>$request->order_desc,
                                    'budget'=>$request->budget,
                                    'subcategory_id'=>$scd[0]->subcategory_id,
                                    // 'order_type'=>$request->order_type,
                                    'skills'=>$skill,
                                    'freelancer_id'=>$fid,
                                    'order_type'=>'F',
                                    // 'order_info'=>$fileName,
                                    'client_id'=>Session('id')
                                );
                                }

        Order::create($orderDetail);
        
        $odata=DB::table('orders')->where([
            'order_title'=>$request->order_title,
            'order_desc'=>$request->order_desc,
            'budget'=>$request->budget,
            'subcategory_id'=>$scd[0]->subcategory_id,
          
            'skills'=>$skill,
            'freelancer_id'=>$fid,
            'order_type'=>'F',
            
            'client_id'=>Session('id')])->select('order_id','freelancer_id','client_id')->first();
            DB::table('chatrooms')->insert([
                'order_id'=>$odata->order_id,
                'freelancer_id'=>$odata->freelancer_id,
                'client_id'=>$odata->client_id,
            ]);
           return redirect('/projectsofclient');
    }
    public function showprojects()
    {
        // $clientprojects=DB::select('select * from orders where client_id = ?', [Session('id')]);
        $clientprojects=DB::select('select orders.*,firstname,lastname from orders left join freelancers on freelancers.freelancer_id=orders.freelancer_id where client_id = ?', [Session('id')]);
        return view('client.clientprojectsd',['clientprojects'=> $clientprojects]);
        // return redirect()->back()->with('clientprojects',$clientprojects);   

     
    }
    public function profileview($cid)
    {
        $client=Client::where('client_id',$cid)->first();
        return view('client.viewprofile',['client'=>$client]);
    }

    public function editprofile($cid)
    {   
        $client=DB::table('clients')->where('client_id','=',$cid)->first();
        return view('client.editprofile',['client'=>$client]);
    }

    public function updateprofile($cid,Request $request)
    {
        foreach ($request->all() as $key=> $value) {
            if($value==Null)
            {
             $request->request->remove($key);
            }
         }
         $request->request->remove('_token');
         Client::where('client_id',$cid)->update($request->all());
         if($request->profile_image)
         {
         $image=(file_get_contents($_FILES['profile_image']['tmp_name']));
         Client::where('client_id',$cid)->update(['profile_image'=>$image]);
         }
         return redirect()->back()->with(['msg'=>'saved successfully']);
    }
  
}
