<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use App\Notifications\OrderNotification;
use App\Models\Client;
use App\Models\Order;
use App\Mail\OrderMail;
use App\Mail\BidPlaced;
use App\Models\Subcategory;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use App\Models\Bid;
use DB;
use Session;
use Auth;
use Mail;
class OrderController extends Controller
{
    public function add()
    {   
        if(Session('role')=='client'){
        return view('client/AddClientOrder');
        }
        else{
            return back();
        }
    }
    public function subcategories($sid)
    {
        // $data= DB::select('select * from subcategories where category_id = ?', [$sid]);
        $sbc=DB::table('subcategories')->where('category_id','=',$sid)->get();
        return response()->json_encode($sbc);
        // foreach($sbc as $s)
        // {
        //     $str.= "<option value='".$s->subcategory_id .".>".$s->subcategory_name ."</option>";
        // }
        // return $str;
        
       
    }
    public function Postadd(Request $request)
    {   
        if(Session::has('user'))
        {
        $subcat=$request->subcategory_name;
        $request->request->remove('subcategory_name');
        $validated=$request->validate(
            [
                'order_title'=>'required',
                'order_desc'=>'required|min:20',
                'budget'=>'required',
            ]
        );
        
        $skill=implode(',',$request->skills);
        $scd=DB::table('subcategories')->where('subcategory_name',$subcat)->get();
        //////
        // $fileName=time().'.'.$request->file('order_info')->getClientOriginalExtension();
        // $path=$request->file('order_info')->storeAs('public/projectinfo',$fileName);
        if($request->order_info !=NULL){
            $fileName=time().'.'.$request->file('order_info')->getClientOriginalExtension();
            $path=$request->file('order_info')->storeAs('public/projectinfo',$fileName);
            
       
        $orderDetail=array('order_title'=>$request->order_title,
                            'order_desc'=>$request->order_desc,
                            'budget'=>$request->budget,
                            'subcategory_id'=>$scd[0]->subcategory_id,
                            // 'order_type'=>$request->order_type,
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
                    'order_type'=>'F',
                    'skills'=>$skill,
                    // 'order_info'=>$fileName,
                    'client_id'=>Session('id')
                );
                }
            $data=[
                'title'=>$request->order_title,
                'body'=>'your order placed Successfully',
                'budget'=>$request->budget,
            ];
            Mail::to('bhaveshpr54@gmail.com')->send(new OrderMail($data));
            Order::create($orderDetail);
         
          

        //     Mail::send('Home',$data, function ($message) {

        //     $message->to('bhaveshpr53@gmail.com');
           
        //     $message->subject('from freelancing');
           
        // });
               return redirect('/');
            
            
            
        
        
                    }
            else
            {
                        echo "<span class='alert alert-success'>success</span>";
             }
   
    }

    public function show(Request $request)
    {  
        // $orders=Order::all()->where('status','O');
        $orders=Order::where('status','=','O')->paginate(5);
              
        return view('allorder',['orders'=>$orders]);
    }

    public function fulldetailorder($oid, Request $request)
    {
        $orderData=DB::select('select * from orders where order_id = ?', [$oid]);
        // $orderData=DB::table('orders')->where('order_id',$oid)->first();
        
        return view('fullOrder',['orderdata'=> $orderData]);
    }
    public function changeorderdata($orderid,Request $request)
    {   
        foreach ($request->all() as $key=> $value) {
           if($value==Null)
           {
            $request->request->remove($key);
           }
        }
        $request->request->remove('_token');
        
        
        Order::where('order_id',$orderid)->update($request->all());
        return redirect()->back()->with('msg','updated successfully');
    }

    public function makeProposal(Request $request,$orderId)
    {   $order=DB::select('select order_type from orders where order_id = ?', [$orderId]);
        if($order[0]->order_type=='F'){
        $request->validate(
            [
                
                'bid_desc'=>'required',
                // 'required_deposit'=>'required',
            ]
        );
        }
        else
        {
            $request->validate(
                [
                    'bid_desc'=>'required',
                    // 'required_deposit'=>'required',
                ]
            );
        }
        $exist=DB::select('select COUNT(bid_id) bidrng from bids where  order_id = ? and freelancer_id=?', [$orderId,Session('id')]);
        if($exist[0]->bidrng > 0)
        {
            return  redirect()->back()->with('existance','you have already made proposal');
        }
        $Freelancer=DB::table('freelancers')->where('freelancer_id','=',Session('id'))->first();
        $data=[
            'title'=>'New Bid Placed',
            'firstname'=>$Freelancer->firstname,
            'lastname'=>$Freelancer->lastname,
            'bid_value'=>$request->full_project_budget,
            'order_id'=>$orderId,
        ];
        Mail::to('bhaveshpr54@gmail.com')->send(new BidPlaced($data));
        
        DB::insert('insert into bids (order_id,freelancer_id,bid_desc,full_project_budget) values (?, ?,?,?)', [
            $orderId,
            Session('id'),
            $request->bid_desc,
            $request->full_project_budget,
            // $request->required_deposit,
           
        ]);
        
        return redirect()->back()->with('msg','your proposal added successfully');
    }
    public function cancelOrder($oid)
    {   
        if(Session('role')=='client'){
        $open_order=DB::table('orders')->where('order_id','=',$oid)->first();
        if($open_order->status=='O')
        {
            DB::table('orders')->where('order_id','=',$oid)->update(['status'=>'E']);   
        }
        elseif($open_order->status!='C' || $open_order->status!='E' ){
        DB::table('orders')->where('order_id','=',$oid)->update(['status'=>'EC']);
        }
        }
        elseif(Session('role')=='freelancer')
        {
            DB::table('orders')->where('order_id','=',$oid)->update(['status'=>'EF']);
        }
        elseif(Session('role')=='Admin'){
            $open_order=DB::table('orders')->where('order_id','=',$oid)->first();
            if($open_order->status=='O')
            {
                DB::table('orders')->where('order_id','=',$oid)->update(['status'=>'E']);   
            }
            
            }
        return redirect()->back();
    }
   
    public function download($file)
    {   try 
        {
        $myfile=public_path('\storage\projectinfo').'\ '.$file;
        $myfile2=str_replace(' ','',$myfile);
        return Response::download($myfile2);
        } 
        catch (\Throwable $th) {
        echo "not found $th";
        }
        

     
    }
}

