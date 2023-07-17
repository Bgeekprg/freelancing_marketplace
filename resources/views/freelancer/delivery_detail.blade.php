@extends('freelancer.dashboard')
@section('content')
<div class="text-center" style="display: inline;">
    <h2>PROJECT DELIVERY</h2>
    
</div>
<a href="/deliveryReport" class="btn btn-dark mb-2">Report</a>
    <div class="table-responsive">
        <table class="table" style="font-size:15px;font-weight:600;" id="myTable" >
            <thead class="bg-dark text-light text-center">
                @php
                $delivery=DB::select('select delivery.*,orders.order_id,orders.order_title from delivery , orders where delivery.order_id=orders.order_id and freelancer_id = ?', [Session('id')]);

                @endphp
                <th>Delivery Id</th>
                <th>Order Id</th>
                <th>Title</th>
                <th class="w-sm-5">Delivery</th>
                <th>Time</th>
                <th>status</th>
                
            </thead>
            <tbody>
                @foreach ($delivery as $item)
                    
                
                <tr class="text-center">
                    <td>{{$item->delivery_id}}</td>
                    <td>{{$item->order_id}}</td>
                    <td>{{$item->order_title}}</td>
                    
                    
                    <td class="text-center"><a class="btn-sm btn-primary"  href="download/{{strval($item->project_file)}}"><span><i class="fa fa-download" aria-hidden="true"></i></span></a></td>
                    {{-- <td><img src="{{asset('/storage/delivery/'.$item->project_file)}}" alt=""></td> --}}
                    <td>{{$item->delivered_at}}</td>
                   
                    @if ($item->status==Null)
                   <td class="text-warning">No Response</td>
                    @elseif($item->status=='A')
                    <td class="text-success">Accepted</td>
                    @elseif($item->status=='R')
                    <td class="btn btn-danger">Accept</td>
                    
                    @endif
                    
                </tr>
                
                @endforeach
            </tbody>
        </table>
    </div>
@endsection