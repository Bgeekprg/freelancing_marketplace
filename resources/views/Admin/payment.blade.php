@extends('Admin.dashboard')
@section('sections')
<a href="/paymentReport" class="btn btn-dark my-2">Report <i class="fa fa-file-pdf" aria-hidden="true"></i></a>
<a href="/excelpayment"   class="btn btn-success my-2">Export <i class="fa fa-file-excel" aria-hidden="true"></i></a>
<div class="text-center" style="display: inline;">
    <h2>PAYMENTS</h2>
    
  </div>
  
 {{-- <a href="" class="btn btn-dark">Excel</a> --}}
 @php
     $orders=DB::select('select * from payment,orders where payment.order_id=orders.order_id');
 @endphp

<div class="table-responsive">
    <table class="table" style="font-size:15px;font-weight:600;" id="myTable" >
        <thead class="bg-dark text-light">
            <tr class="text-center">
                <th>Order Id</th>
                <th>Order Title</th>
                <th>Amount</th>
                <th>Card no</th>
                <th>Payment Status</th>
                <th>paid_at</th>
                <th>Receipt</th>
            </tr>
        </thead>
        <tbody>
            
            @foreach ($orders as $i)
                <tr class="text-center">
                    <td class="text-center">{{$i->order_id}}</td>
                    <td class="text-left">{{$i->order_title}}</td>
                    <td>$ {{$i->final_price}}</td>
                    <td>xxxxx{{$i->card_no}}</td>
                    {{-- <td class="text-success">Accepted</td> --}}
                    @if ($i->payment_id)
                        <td>Paid</td>
                    @else
                    {{-- <td><a href="/pay/{{$i->order_id}}/{{$i->final_price}}/{{$i->delivery_id}}" class="btn btn-primary">PAY</a></td> --}}
                    <td><a  href="/process-payment/{{$i->order_id}}/{{$i->final_price}}/{{$i->delivery_id}}" class="btn btn-primary">PAY</a></td>
                    @endif
                    
                    {{-- <td><a href="/pay" class="btn btn-primary">Pay</a></td> --}}
                    @php
                      $data= DB::table('payment')->where('order_id',$i->order_id)->first();
                    @endphp
                     @if ($i->payment_id)
                     <td>{{$data->paid_at}}</td>
                     <td><a href="{{$data->invoice_url}}">Download</a></td>
                     @else
                     <td>Not paid</td>
                     <td></td>
                     @endif

                  
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection