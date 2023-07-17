<div class="table-responsive">
    
    @php
        if(Session('role')=='client'){
         $delivery=DB::select('SELECT order_title,project_file,delivered_at ,orders.status ostatus,delivery_id,orders.order_id,delivery.status dstatus  FROM orders INNER JOIN delivery ON orders.order_id = delivery.order_id WHERE orders.client_id = ?', [Session('id')]);
        }
        elseif(Session('role')=='freelancer')
        {
            $delivery=DB::select('SELECT order_title,project_file,delivered_at ,orders.status ostatus,delivery_id,orders.order_id,delivery.status dstatus  FROM orders INNER JOIN delivery ON orders.order_id = delivery.order_id WHERE orders.freelancer_id = ?', [Session('id')]);
        }
    @endphp
    <table class="table" style="font-size:15px;font-weight:600;" id="myTable" border="1" >
        <thead>
            @php


            @endphp
             <th>Order Id</th>
            <th>Title</th>
            <th>Delivery Id</th>
            
            <th>Time</th>
            <th>status</th>
            
        </thead>
        <tbody>
            @foreach ($delivery as $item)
                
            
            <tr>
                <td class="text-center">{{$item->order_id}}</td>
                <td>{{$item->order_title}}</td>
                
                <td>{{$item->delivery_id}}</td>  
                {{-- <td class="text-center"><a class="btn-sm btn-primary"  href="download/{{strval($item->project_file)}}"><span><i class="fa fa-download" aria-hidden="true"></i></span></a></td> --}}
                {{-- <td><img src="{{asset('/storage/delivery/'.$item->project_file)}}" alt=""></td> --}}
                <td>{{$item->delivered_at}}</td>
               
                @if ($item->dstatus==Null)
                <td class="text-success">no response</td>   
                @elseif($item->dstatus=='A')
                <td class="text-success">Accepted</td>
                @elseif($item->dstatus=='R')
                <td><button class="text-danger">Rejected</button></td>
                @endif
                
            </tr>
            
            @endforeach
        </tbody>
    </table>
</div>