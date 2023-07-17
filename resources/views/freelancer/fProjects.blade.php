@extends('freelancer.dashboard')
@section('content')
<script>
      function myConfirm() {
    var confirmation = confirm("Are you sure? if you cancel the ordere you will loss your order.");
    if (confirmation) {
      return true;
    } else {
      return false;
    }
  }
</script>
<a href="/orderReport" class="btn text-light mb-3" style="background: #0d2ffde0;">Report <i class="fa fa-file" aria-hidden="true"></i></a>
<div class="text-center" style="display: inline;">
<h2>PROJECTS</h2>
</div>
<div class="table-responsive">
    
    <table class="table table-sm" id="myTable">
        <thead>
            @php
                // $Order=DB::select('select * from orders where freelancer_id = ? and status != ?', [Session('id'),'O']);
                $Order=DB::select('SELECT * from clients , orders WHERE clients.client_id=orders.client_id and freelancer_id=? and orders.status !=?', [Session('id'),'O']);
                

            @endphp
            <tr class="text-center bg-dark text-light">
                <th>Title</th>
                <th>Client Name</th>
                <th>Price</th>
                <th>Order Type</th>
                <th>View</th>
                <th>Status</th>
                <th>Cancel</th>
            </tr>
        </thead>
        <tbody>
           @foreach ($Order as $o)
               <tr style="font-weight:600;">
                <td>{{$o->order_title}}</td>
                <td class="text-center"><a href="/client/{{$o->client_id}}" style="text-decoration: none;">{{$o->firstname}}  {{$o->lastname}}</a></td>
            
                <td class="text-center">$ {{$o->final_price}}</td>    
                
                @if ($o->order_type=='H')
                    <td class="text-center">Hourly</td>
                @else
                    <td class="text-center">Fixed</td>
                @endif
                <td class="text-center">
                    <a href="/viewOrder/{{$o->order_id}}" class="btn btn-primary"><i class="fa fa-eye" aria-hidden="true"></i></a>
                </td>

                
                @if ($o->status=='C')
                <td class="text-center text-success">Complete</td>
                @elseif($o->status=='G')
                <td class="text-center text-info">Pending</td>     
                @elseif($o->status=='P')     
                <td class="text-center text-danger">Payment Pending</td>
                @elseif($o->status=='EF')     
                <td class="text-center text-danger">Canceled by freelancer</td>
                @elseif($o->status=='EC')     
                <td class="text-center text-danger">Canceled by Client</td>
                
                @endif
                @if($o->status=='EF' || $o->status=='EC')     
                <td class="text-center text-danger">
                    <button class="btn btn-secondary" disabled>Canceled</button>
                    </td>
                @elseif($o->status=='P' || $o->status=='C')
                <td class="text-center">
                    <a href="" class="btn btn-secondary" disabled>Cancel</a>
                </td>
                @else
                <td class="text-center">
                    <a href="/cancelorder/{{$o->order_id}}" class="btn btn-danger" onclick="return myConfirm()">Cancel</a>
                </td>
                @endif
               </tr>
               
               
               
           @endforeach
        </tbody>
      
    </table>
  </div>

@endsection