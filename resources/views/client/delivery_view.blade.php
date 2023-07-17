@extends('client.dashboard')
@section('content')
<script>
          function myConfirm() {
    var confirmation = confirm("Are you sure ?.");
    if (confirmation) {
      return true;
    } else {
      return false;
    }
  }
</script>

<a href="/deliveryReport" class="btn btn-dark">Report</a>
<div class="text-center" style="display: inline;">
  <h2>PROJECT DELIVERIES</h2>
  
</div>
    <div class="table-responsive">
        <table class="table" style="font-size:15px;font-weight:600;" id="myTable" >
            <thead class="text-center text-light bg-dark">
                <th>Order Id</th>
                <th>Title</th>
                
                <th>Delivery Id</th>
                <th class="w-sm-5">Delivery</th>
                <th>Time</th>
                <th>status</th>
                <th>Accept</th>
                <th>Reject</th>
            </thead>
            <tbody>
                @foreach ($delivery as $item)
                    
                
                <tr class="text-center">
                    <td class="text-center">{{$item->order_id}}</td>
                    <td>{{$item->order_title}}</td>
                    
                    <td class="text-center">{{$item->delivery_id}}</td>
                    <td class="text-center"><a class="btn-sm btn-primary"  href="download/{{strval($item->project_file)}}"><span><i class="fa fa-download" aria-hidden="true"></i></span></a></td>
                    {{-- <td><img src="{{asset('/storage/delivery/'.$item->project_file)}}" alt=""></td> --}}
                    <td>{{$item->delivered_at}}</td>
                    @if($item->ostatus=='P')
                    <td class="text-danger">Payment Pending</td>
                    @elseif($item->ostatus=='C')
                    <td class="text-success">Completed</td>
                    @endif
                    @if ($item->dstatus==Null)
                    <td><a href="acceptdelivery/{{$item->delivery_id}}" class="btn btn-success" onclick="return myConfirm();">Accept</a></td>
                    <td><a href="rejectdelivery/{{$item->delivery_id}}" class="btn btn-danger" onclick="return myConfirm();">Reject</a></td>    
                    @elseif($item->dstatus=='A')
                    <td class="text-success">Accepted</td>
                    <td><button class="btn btn-secondary" disabled>Reject</button></td>
                    @elseif($item->dstatus=='R')
                    <td class="btn btn-secondary" disabled>Accept</td>
                    <td><button class="text-danger">Rejected</button></td>
                    @endif
                    
                </tr>
                
                @endforeach
            </tbody>
        </table>
    </div>
@endsection