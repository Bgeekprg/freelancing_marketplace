@extends('client.dashboard')
@section('content')
<a href="/orderReport" class="btn btn-dark">Report</a>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/js/bootstrap.min.js" integrity="sha512-1/RvZTcCDEUjY/CypiMz+iqqtaoQfAITmNSJY17Myp4Ms5mdxPS5UV7iOfdZoxcGhzFbOm6sntTKJppjvuhg4g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@if(Session('msg'))

<div class="alert alert-success" id="alt" style="font-size: 15px;">{{Session('msg')}}</div>  
 @endif   
<script>
  
      function myConfirm() {
    var confirmation = confirm("Are you sure you want to cancel project ?.");
    if (confirmation) {
      return true;
    } else {
      return false;
    }
  }

    setInterval(() => {
        document.getElementById('alt').style.display='none';
    }, 3000);
</script>
    <div class="text-center mb-3" ><h2>Projects</h2></div>
 
<div class="table-responsive">
    <table class="table" style="font-size:15px;font-weight:600;" id="myTable">
        <thead class="bg-dark text-light">
            <tr class="my-2 text-center">
              <th>Title</th>
              <th>Posted at</th>
              <th>Freelancer</th>
              <th>Budget</th>
              <th class="text-center">Accepted-price</th>
              <th>Status</th>
              <th>Update</th>
              <th>Cancel</th>
              <th>View</th>
              <th>Bids</th>
            </tr>
          </thead>
          <tbody>
            @php
                
            @endphp
            @foreach ($clientprojects as $i)
                <tr class="my-2">
                    <td>{{$i->order_title}}</td>
                    <td>{{date('d/m/y',strtotime($i->created_at))}}, {{date('H:i:s',strtotime($i->created_at))}}</td>
                    {{-- <td></td> --}}
                    @if ($i->freelancer_id)
                    <td class="text-center"><a href="/freelancer/{{$i->freelancer_id}}" style="text-decoration: none;">{{$i->firstname}} {{$i->lastname}}</a></td>
                    @else
                    <td class="text-center" style="font-weight:bold;font-size:20px;">-</td>    
                    @endif
                    
                    <td>$ {{$i->budget}}</td>
                    <td class="text-center">$ {{$i->final_price}}</td>
                    @if ($i->status=='O')
                    <td class="text-primary">Open</td>    
                    @elseif($i->status=='p')
                    <td class="text-danger">Pending</td>    
                    @elseif($i->status=='E')
                    <td class="text-danger">Closed</td> 
                    @elseif($i->status=='EF')
                    <td class="text-danger">Canceled by Freelancer</td> 
                    @elseif($i->status=='EC')
                    <td class="text-danger">Canceled by Client</td> 
                    @elseif($i->status=='C')
                    <td class="text-success">Completed</td>    
                    @elseif($i->status=='G')
                    <td class="text-warning">Given</td>    
                    @elseif($i->status=='P')
                    <td class="text-danger">Payment Pending</td>    
                    @endif
                    @if ($i->status=='C' || $i->status=='EC' || $i->status=='EF' || $i->status=='E')
                    <td ><button  class="btn btn-secondary" disabled><i class="fa fa-edit" aria-hidden="true"></i></button></td>
                    <td ><button  class="btn btn-secondary" disabled>Cancel</button></td>
                    @else
                    {{-- <td ><a href="" class="btn btn-warning">Update</a></td> --}}
                    <td><button id="lnks"  class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#ids{{$i->order_id}}">
                        {{-- Update--}}
                        <i class="fa fa-edit" aria-hidden="true"></i>
                    </button></td>

                      
                    {{-- popup --}}

                    <!-- Button trigger modal -->

  
  <!-- Modal -->
  <div class="modal fade" id="ids{{$i->order_id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
           
            <form action="/updateOrder/{{$i->order_id}}" method="POST" id="frm">
                @csrf
          <h5 class="modal-title" id="staticBackdropLabel">Edit Order</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
            <i class="fa fa-window-close" aria-hidden="true"></i>

          </button>
        </div>
        <div class="modal-body">
        
   
        <div>
            <input type="text" name="order_title" class="form-control my-1" id="" placeholder="chnage Title">
            <textarea name="order_desc" class="form-control my-1" id="" cols="30" rows="10" placeholder="change description"></textarea>
            <input type="number" name="budget" class="form-control my-1" id="" placeholder="Budget">
            {{-- <div><span class="mx-2 my-1"><input type="radio" class="mx-1 form-check-input " value="H" name="order_type" id="">Hourly</span>
                <span class="mx-2 my-1"><input type="radio" class="mx-1 form-check-input " value="F" name="order_type" id="">Fixed</span> </div> --}}
            <input type="text" name="skills" class="form-control my-1" id="" placeholder="Skills">
        </div>
        
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <input type="submit" class="btn btn-primary" value="save">
        </form>
        </div>
      </div>
    </div>
  </div>
                    {{-- popupend --}}

    
      
                    <td ><a href="/cancelorder/{{$i->order_id}}" class="btn btn-danger" onclick="return myConfirm();"> <i class="fa fa-window-close" aria-hidden="true"></i> </a></td>
                    @endif
                    <td ><a href="/viewOrder/{{$i->order_id}}" class="btn btn-primary"><i class="fa fa-eye" aria-hidden="true"></i></a></td>
                    @if ($i->status=='C' || $i->status=='E' || $i->status=='EC'|| $i->status=='EF' )
                    <td ><button class="btn btn-secondary" disabled>Bids</button></td>
                    @else
                    <td ><a href="/viewbid/{{$i->order_id}}" class="btn btn-primary">Bids</a></td>
                    @endif
                </tr>
                
               
            @endforeach

        </tbody>
        
    </table>
  </div>
@endsection



