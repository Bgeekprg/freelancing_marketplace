<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use App\Models\Order;
use App\Models\Client;
use DB;


class DeliveryController extends Controller
{
    //
    public function deliverysend (Request $request,$oid)
    {   
        $fileName=time().$oid.'.'.$request->file('project_file')->getClientOriginalExtension();
        $path=$request->file('project_file')->storeAs('public/delivery',$fileName);

        $fus=DB::insert('insert into delivery (order_id, project_file) values (?, ?)', [$oid, $fileName]);
        Order::where('order_id',$oid)->update(['status'=>'P']);
        return redirect('/dashboard');

    }
    public function deliveryview()
    {
        // $delivery=DB::insert('SELECT * FROM orders INNER JOIN delivery ON orders.order_id = delivery.order_id WHERE orders.order_id = ?',[]);
        $delivery=DB::select('SELECT order_title,project_file,delivered_at ,orders.status ostatus,delivery_id,orders.order_id,delivery.status dstatus  FROM orders INNER JOIN delivery ON orders.order_id = delivery.order_id WHERE orders.client_id = ?', [Session('id')]);
        // dd($delivery);
        return view('client.delivery_view',['delivery'=>$delivery]);
    }
    public function download($file)
    {
        $myfile=public_path('\storage\delivery').'\ '.$file;
        $myfile2=str_replace(' ','',$myfile);
        return Response::download($myfile2);
    }
    public function Accept($did)
    {
        DB::update('update delivery set status = "A" where delivery_id = ?', [$did]);
        return redirect()->back();
    }

    public function Reject($did)
    {
        DB::update('update delivery set status = "R" where delivery_id = ?', [$did]);   
        return redirect()->back();
    }
    public function deliveryoffreelancer()
    {
        return view('freelancer.delivery_detail');
    }
}
