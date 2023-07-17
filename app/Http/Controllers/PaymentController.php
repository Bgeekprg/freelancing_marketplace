<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Models\Order;
use Exception;
use Response;
use Stripe\Charge;
use Cookie;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use Stripe\Transfer;
// use Stripe\Customer;
// use Stripe;
class PaymentController extends Controller
{
    public function paymentView()
    {   
        
        $order=DB::select('SELECT order_title,orders.payment_id,orders.order_id,orders.final_price,delivery.delivered_at,delivery.status as dstatus ,delivery.delivery_id FROM `orders` join delivery WHERE orders.order_id=delivery.order_id and orders.client_id=? and delivery.status=?', [Session('id'),'A']);
        // $data=DB::select('SELECT * FROM payment LEFT JOIN orders ON payment.payment_id =orders.payment_id where orders.client_id=? and orders.status=?',[Session('id'),'P']);
        return view('client.payment',['orders'=>$order]);
    }
    public function gateway($oid,$amount,$did)
    { 

        
        return view('paymentGateway',['order_id'=>$oid,'amount'=>$amount,'delivery_id'=>$did]);
        // return view('paymentGateway',compact('intent'));
    }
    public function afterpayment($oid,$amount,$did,Request $request)
    {   
        DB::insert('insert into payment (delivery_id,order_id,payment_type,card_no,expiry_date,cvv) values (?, ?, ?, ?, ?, ?)', [
            $did,
            $oid,
            $request->payment_type,
            $request->card_no,
            $request->expiry_date,
            $request->cvv
        ]);
        $payment=DB::table('payment')->where('order_id',$oid)->select('payment_id')->first();
        Order::where('order_id','=',$oid)->update([
            'payment_id'=>$payment->payment_id,
            'status'=>'C'
        ]);
        return redirect('/dashboard');
        
       
       
    }



    public function stripePost(Request $request,$oid,$amount,$did)
    {     
        // Stripe::setApiKey('sk_test_51MoL3DSEdH4rFdg1zCyvGvvl3B1KVDZTscxtbUiEslQGUXPdbSI5L4r2Wq1prRAraysEhOewCAsCckVVPCErZLKA00S2wakAtb');
        
        $stripe = new \Stripe\StripeClient(
            'sk_test_51MoL3DSEdH4rFdg1zCyvGvvl3B1KVDZTscxtbUiEslQGUXPdbSI5L4r2Wq1prRAraysEhOewCAsCckVVPCErZLKA00S2wakAtb'
        );
     
        
        // Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
        $checkout_session = $stripe->checkout->sessions->create([
              'line_items' => [[
              'price_data' =>[ 
                'currency' => 'usd',
                'product_data' => [
                  'name' => 'Order 1 for freelancers',
                  'description'=>'order_id'.$oid,
                ],
                'unit_amount' => ($amount*100),
              ],
             
              'quantity' => 1,
              
            ]],
            
            'invoice_creation'=>['enabled'=>true],
            'mode' => 'payment',
            'success_url' => 'http://localhost:8000/success?delivery_id='.$did,
            'cancel_url' => 'http://localhost:8000/process-pay',
            
          ]);
         
         
         
          header("HTTP/1.1 303 See Other");
          header("Location: " . $checkout_session->url);
         DB::insert('insert into payment (delivery_id, order_id,transaction_id) values (?, ?, ?)', [$did,$oid,$checkout_session->id]);
          
          
       return redirect($checkout_session->url);
        
    }
    public function success(Request $request)
    {
      
      // Stripe::setApiKey('sk_test_51MoL3DSEdH4rFdg1zCyvGvvl3B1KVDZTscxtbUiEslQGUXPdbSI5L4r2Wq1prRAraysEhOewCAsCckVVPCErZLKA00S2wakAtb');
    
      // $session_data=Session::retrieve(
      //   'cs_test_a10HUM1KEUI4qOZHY1BvyNvwBLwx0RMdVymLY4tqftFxFTCENeyHcdXdUn',
      // );
      // $chargeid=$session_data->payment_intent;
      // $pi= PaymentIntent::retrieve('pi_3MywcNSEdH4rFdg10N7KiO67');
      // $charge=Charge::retrieve($pi->latest_charge);
      // return redirect($charge->receipt_url);

      $stripe = new \Stripe\StripeClient(
        'sk_test_51MoL3DSEdH4rFdg1zCyvGvvl3B1KVDZTscxtbUiEslQGUXPdbSI5L4r2Wq1prRAraysEhOewCAsCckVVPCErZLKA00S2wakAtb'
    );
    Stripe::setApiKey('sk_test_51MoL3DSEdH4rFdg1zCyvGvvl3B1KVDZTscxtbUiEslQGUXPdbSI5L4r2Wq1prRAraysEhOewCAsCckVVPCErZLKA00S2wakAtb');
  
    $dt=DB::table('payment')->where('delivery_id','=',$request->delivery_id)->first(); 
    $session_data=$stripe->checkout->sessions->retrieve(
      $dt->transaction_id,
    );
    $payment_intent=$stripe->paymentIntents->retrieve(
      $session_data->payment_intent,
    );
    // dd($payment_intent);
    $chargeid=$session_data->payment_intent;
    // dd($chargeid);
    $payment_method=$stripe->paymentMethods->retrieve(
      $payment_intent->payment_method,
    );

    $card_details=$payment_method->card;
    
   
    // $pi= PaymentIntent::retrieve($chargeid);
    $charge=Charge::retrieve($payment_intent->latest_charge);
    // return redirect($charge->receipt_url);

    $data=$stripe->invoices->retrieve(
      $session_data->invoice,
    );
    // dd($data-> hosted_invoice_url);
    // $invoice_url=$data->invoice_pdf;
    $expiry_date=$card_details->exp_month.'/'.$card_details->exp_year;
    $card_no=$card_details->last4;


      
    DB::table('payment')->where('delivery_id','=',$request->delivery_id)->update([
      'invoice_url'=> $charge->receipt_url,
      'expiry_date'=>$expiry_date,
      'card_no'=>$card_no,
      'Amount'=>($payment_intent->amount/100),
      'currency'=>$payment_intent->currency,
    ]);
  $payment=DB::table('payment')->where('delivery_id','=',$request->delivery_id)->first();
  // dd($payment);
  Order::where('order_id','=',$payment->order_id)->update([
      'payment_id'=>$payment->payment_id,
      'status'=>'C'
  ]);
    
    return redirect($data->hosted_invoice_url);

    }



    public function freelancerpaymentview()
    {
      $payment_details=DB::select('SELECT * FROM payment , orders where payment.payment_id =orders.payment_id and freelancer_id=?',[Session('id')]);
      return view('freelancer.payment',['payment_details'=>$payment_details]);
    }
}




