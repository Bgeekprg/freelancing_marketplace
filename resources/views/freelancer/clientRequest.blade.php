@extends('freelancer.dashboard');
@section('content')
<script>
    function myConfirm() {
  var confirmation = confirm("Are you sure ?");
  if (confirmation) {
    return true;
  } else {
    return false;
  }
}
</script>
<div class="text-center" >
    <h2>CLIENT REQUESTS</h2>
    
</div>
<div class="table-responsive">
    <table class="table table-sm" id="myTable">
        <thead class="bg-dark text-light">
            <th>Title</th>
            <th>skills</th>
            <th>posted at</th>
            <th>view</th>
            <th>Accept</th>
            <th>reject</th>
        </thead>
        @foreach ($data as $i)
            <tr>
                <td>{{$i->order_title}}</td>
                <td>{{$i->skills}}</td>
                <td>{{$i->created_at}}</td>
                <td><a href="/viewOrder/{{$i->order_id}}" class="btn btn-primary">View</a></td>
                @if($i->status=='O')
                <td><a href="/Acceptrequest/{{$i->order_id}}" onclick="return myConfirm();" class="btn btn-success">Accept</a></td>
                <td><a href="/Rejectrequest/{{$i->order_id}}" onclick="return myConfirm();" class="btn btn-danger">Reject</a></td>
                @elseif($i->status=='E')
                <td class="text-white bg-danger text-center" style="border-radius:5px;" colspan="2">Reject</td>
                @elseif($i->status=='G')
                <td class="text-white bg-success text-center" style="border-radius:5px;" colspan="2">Accepted</td>
                @endif
            </tr>
        @endforeach
    </table>
</div>
@endsection