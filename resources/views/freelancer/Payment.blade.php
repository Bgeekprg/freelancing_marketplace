@extends('freelancer.dashboard')
@section('content')
<a href="/paymentReport" class="btn btn-dark mb-2">Report</a>
<div class="text-center" style="display: inline;">
  <h2>PAYMENTS</h2>
  
</div>
<div class="table-responsive">
    <table class="table table-sm" id="myTable">
        <thead class="bg-dark text-light">
           
            <tr class="text-center">
                <th>Order Id</th>
                <th>Order Title</th>
                <th>Paid at</th>
                <th>Amout</th>
                <th>Receipt</th>
                
            </tr>
        </thead>
        <tbody>
          @foreach ($payment_details as $i)
              <tr style="font-weight:500;">
                <td class="text-center">{{$i->order_id}}</td>
                <td style="font-size:15px;">{{$i->order_title}}</td>
                <td class="text-center">{{date('d/m/y H:i:s',strtotime($i->paid_at))}}</td>
                <td class="text-center">$ {{$i->Amount}}</td>
                <td class="text-center"><a href="{{$i->invoice_url}}">Download</a></td>
              </tr>
          @endforeach
        </tbody>
      
    </table>
  </div>
@endsection