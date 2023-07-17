
<div class="table-responsive">
    @php
        if(Session('role')=='client' ){
        $orders=DB::select('SELECT * FROM payment LEFT JOIN orders ON payment.payment_id =orders.payment_id where orders.client_id=?',[Session('id')]);
        }
        elseif(Session('role')=='freelancer')
        {
            $orders=DB::select('SELECT * FROM payment LEFT JOIN orders ON payment.payment_id =orders.payment_id where orders.freelancer_id=?',[Session('id')]);
        }
        elseif( Session('role')=='Admin')
        {
            $orders=DB::select('select * from payment,orders where payment.order_id=orders.order_id');
        }
    @endphp
    <table class="table" style="font-size:15px;font-weight:600;" id="myTable" border="1" >
        <thead style="background: black;color:#ffff;">
            <tr class="text-center">
                <th>Order Id</th>
                <th>Order Title</th>
                <th>Amount</th>
                <th>Delivery status</th>
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
                    <td>{{$i->final_price}}</td>
                    <td class="text-success">Accepted</td>
                    @if ($i->payment_id)
                        <td>Paid</td>
                    @else
                    {{-- <td><a href="/pay/{{$i->order_id}}/{{$i->final_price}}/{{$i->delivery_id}}" class="btn btn-primary">PAY</a></td> --}}
                    <td><a  href="/process-payment/{{$i->order_id}}/{{$i->final_price}}/{{$i->delivery_id}}" class="btn btn-primary">PAY</a></td>
                    @endif
                    
                    {{-- <td><a href="/pay" class="btn btn-primary">Pay</a></td> --}}
                    @php
                      $data= DB::table('payment')->where('order_id',$i->order_id)->select('paid_at')->first();
                    @endphp
                     @if ($i->payment_id)
                     <td>{{$data->paid_at}}</td>
                     @else
                     <td>Not paid</td>
                     @endif

                     <td><a href="{{$i->invoice_url}}">Download</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>