<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SebastianBergmann\Exporter\Exporter;
use Illuminate\Http\Response;
use DB;


class ExcelMaker extends Controller
{
    public function exportprojects()
    {
        $project=DB::table('orders')
        ->leftjoin('clients','orders.client_id','=','clients.client_id')
        ->leftjoin('freelancers','orders.freelancer_id','=','freelancers.freelancer_id')
        ->select('orders.*','clients.firstname as cfname','clients.lastname as clname','freelancers.firstname as ffname','freelancers.lastname as flname','freelancers.freelancer_id as freelancer_id')
        ->get()->toArray();
        $data="";
        $data.="<table border=1><tr style='background:black;color:white;'><td>Order Id</td><td>Title</td><td>posted at</td><td>freelancer</td><td>client</td><td>budget</td><td>final price</td><td>status</td></tr>";
        
        foreach($project as $i)
        {   if($i->status=='O')
            $data.="<tr><td>".$i->order_id ."</td><td>".$i->order_title ."</td><td>".$i->created_at ."</td><td>".$i->ffname." ".$i->flname."</td><td>".$i->cfname." ".$i->clname."</td><td>".$i->budget."</td><td>".$i->final_price."</td><td>Open</td></tr>";
            elseif($i->status=='G')
            $data.="<tr><td>".$i->order_id ."</td><td>".$i->order_title ."</td><td>".$i->created_at ."</td><td>".$i->ffname." ".$i->flname."</td><td>".$i->cfname." ".$i->clname."</td><td>".$i->budget."</td><td>".$i->final_price."</td><td>Given</td></tr>";
            elseif($i->status=='P')
            $data.="<tr><td>".$i->order_id ."</td><td>".$i->order_title ."</td><td>".$i->created_at ."</td><td>".$i->ffname." ".$i->flname."</td><td>".$i->cfname." ".$i->clname."</td><td>".$i->budget."</td><td>".$i->final_price."</td><td>Pending</td></tr>";
            elseif($i->status=='C')
            $data.="<tr><td>".$i->order_id ."</td><td>".$i->order_title ."</td><td>".$i->created_at ."</td><td>".$i->ffname." ".$i->flname."</td><td>".$i->cfname." ".$i->clname."</td><td>".$i->budget."</td><td>".$i->final_price."</td><td>Complete</td></tr>";
            elseif($i->status=='E')
            $data.="<tr><td>".$i->order_id ."</td><td>".$i->order_title ."</td><td>".$i->created_at ."</td><td>".$i->ffname." ".$i->flname."</td><td>".$i->cfname." ".$i->clname."</td><td>".$i->budget."</td><td>".$i->final_price."</td><td>Closed</td></tr>";
            elseif($i->status=='EC')
            $data.="<tr><td>".$i->order_id ."</td><td>".$i->order_title ."</td><td>".$i->created_at ."</td><td>".$i->ffname." ".$i->flname."</td><td>".$i->cfname." ".$i->clname."</td><td>".$i->budget."</td><td>".$i->final_price."</td><td>Canceled by client</td></tr>";
            elseif($i->status=='EF')
            $data.="<tr><td>".$i->order_id ."</td><td>".$i->order_title ."</td><td>".$i->created_at ."</td><td>".$i->ffname." ".$i->flname."</td><td>".$i->cfname." ".$i->clname."</td><td>".$i->budget."</td><td>".$i->final_price."</td><td>Canceled by Freelancer</td></tr>";
        }
        $data.="</table>";
      
      
        header('Content-Type:application/xls');
        header('Content-Disposition: attachment;filename=order.xls');
        echo $data;
    }
    public function freelancerexcel()
    {   $freelancer=DB::table('freelancers')->get();
        $data="";
        $data.="<table border=1><tr style='background:black;color:white;'><td>freelancer Id</td><td>first name</td><td>Last name</td><td>username</td><td>Email</td><td>contact</td></tr>";
        foreach($freelancer as $i)
        {
            $data.="<tr><td>".$i->freelancer_id ."</td><td>".$i->firstname ."</td><td>".$i->lastname ."</td><td>".$i->username."</td><td>".$i->email."</td><td>".$i->contact."</td></tr>";
        }
        $data.="</table>";
      
      
        header('Content-Type:application/xls');
        header('Content-Disposition: attachment;filename=freelancer.xls');
        echo $data;
    }
    public function clientexcel()
    {   $client=DB::table('clients')->get();
        $data="";
        $data.="<table border=1><tr style='background:black;color:white;'><td>client Id</td><td>first name</td><td>Last name</td><td>username</td><td>Email</td><td>contact</td></tr>";
        foreach($client as $i)
        {
            $data.="<tr><td>".$i->client_id ."</td><td>".$i->firstname ."</td><td>".$i->lastname ."</td><td>".$i->username."</td><td>".$i->email."</td><td>".$i->contact."</td></tr>";
        }
        $data.="</table>";
      
      
        header('Content-Type:application/xls');
        header('Content-Disposition: attachment;filename=client.xls');
        echo $data;
    }
    public function feedbackexcel()
    {   $feedback=DB::table('feedbacks')->get();
        $data="";
        $data.="<table border=1><tr style='background:black;color:white;'><td>feedback Id</td><td>client_id</td><td>freelancer_id</td><td>feedback</td></tr>";
        foreach($feedback as $i)
        {
            $data.="<tr><td>".$i->feedback_id ."</td><td>".$i->client_id ."</td><td>".$i->freelancer_id."</td><td>".$i->feedback."</td></tr>";
        }
        $data.="</table>";
      
      
        header('Content-Type:application/xls');
        header('Content-Disposition: attachment;filename=feedback.xls');
        echo $data;
    }

    public function paymentexcel()
    {   $orders=DB::select('select * from payment,orders where payment.order_id=orders.order_id');
        $data="";
        $data.="<table border=1><tr style='background:black;color:white;'><td>order Id</td><td>title</td><td>amount</td><td>paid At</td></tr>";
        foreach($orders as $i)
        {
            $data.="<tr><td>".$i->order_id ."</td><td>".$i->order_title ."</td><td>".$i->Amount."</td><td>".$i->paid_at."</td></tr>";
        }
        $data.="</table>";
      
      
        header('Content-Type:application/xls');
        header('Content-Disposition: attachment;filename=payment.xls');
        echo $data;
    }

    
}
