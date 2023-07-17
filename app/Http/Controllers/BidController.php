<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use DB;
use Mail;
use App\Mail\OrderMail;
use Http\Models\Order;
use Http\Models\Bid;
use App\Mail\BidPlaced;
use App\Mail\BidRejected;
use App\Mail\BidAccepted;
class BidController extends Controller
{   public $orderid;
    public function showbids($orderid)
    {  // $this->orderid=$orderid;
        $bids=DB::select('select * from Bids where order_id = ?', [$orderid]);
      
      
        return view('client.showbid',['bids'=>$bids]);
    }
    public function Accept($bidid,$oid,$fid,$bidprice)
    {
        DB::update('update bids set status = 1 where bid_id = ?', [$bidid]);
        DB::update('update orders set status = ? , freelancer_id=? where order_id = ?', ['G',$fid,$oid]);
        DB::insert('insert into f_projects (freelancer_id, order_id) values (?, ?)', [$fid, $oid]);
        DB::update('update orders set final_price = ? where order_id = ?', [$bidprice,$oid]);
        $data=[
            'title'=>'mail from freelancing',
            'body'=>'your bid is accepted for order id='.$oid,
        ];
        
        Mail::to('bhaveshpr54@gmail.com')->send(new BidAccepted($data));
        DB::insert('insert into chatrooms (order_id,freelancer_id,client_id) values (?, ?, ?)', [$oid, $fid,Session('id')]);
         return redirect()->back()->with('msg','bid is Accepted');
    }

    public function reject($bidid)
    {
        DB::update('update bids set status = 0,mark_as_rejected=1 where bid_id = ?', [$bidid]);
        $data=[
            'title'=>'mail from freelancing',
            'body'=>'your bid is rejected bid id='.$bidid,
        ];
        
        Mail::to('bhaveshpr54@gmail.com')->send(new BidRejected($data));
         return redirect()->back()->with('msgr','bid is rejected by you');
    }

    // public function rejectall($bidid)
    // {
    //     DB::update('update bids set status = 0 where bid_id = ?', [$bidid]);
    //      return redirect()->back()->with('msgr','bid is rejected by you');
    // }
    public function sendmail()
    {
        // $data=[
        //     'title'=>'mail from freelancing',
        //     'body'=>'order id:'. $orderid,
        // ];
        // Mail::to('bhaveshpr53@gmail.com')->send(new OrderMail($data));
        // dd('email send successfully');
    }

    public function showfbid($fid)
    {
        $fbid=DB::table('bids')->where('freelancer_id','=',$fid)->get();
        return view('freelancer.bids',['bids'=>$fbid]);
    }
    public function updatebid($bidid,Request $request)
    {
        foreach ($request->all() as $key=> $value) {
            if($value==Null)
            {
             $request->request->remove($key);
            }
         }
         $request->request->remove('_token');
        //  Bid::where('bid_id',$bidid)->update($request->all());
        DB::table('bids')->where('bid_id',$bidid)->update($request->all());
        return redirect()->back();

    }
}
