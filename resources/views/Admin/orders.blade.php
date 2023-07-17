@extends('Admin.dashboard')

@section('sections')
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
<a href="/orderReport" style="background: #0d2ffde0;" class="btn text-light mb-3">Report <i class="fa fa-file-pdf" aria-hidden="true"></i></a>
<a href="/excelproject" style="background: #0d2ffde0;" class="btn text-light mb-3">Export <i class="fa fa-file-excel" aria-hidden="true"></i></a>
<div class="text-center" style="display: inline;">
  <h2>PROJECTS</h2>
  
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/js/bootstrap.min.js" integrity="sha512-1/RvZTcCDEUjY/CypiMz+iqqtaoQfAITmNSJY17Myp4Ms5mdxPS5UV7iOfdZoxcGhzFbOm6sntTKJppjvuhg4g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<div class="table-responsive">
    <table class="table table-sm" border ="1" id="myTable">
      <thead class="bg-dark text-white text-center">
        <tr>
          <th>Order ID</th>
          <th>Order_title</th>
          <th>Client</th>
          <th>Freelancer</th>
          <th>Date</th>
          <th>Status</th>
          <th>View</th>
          <th>Update</th>
          <th>Delete</th>
        </tr>
      </thead>
    <tbody style="font-weight:500;font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif">
      @foreach ($project as $i)
          <tr>
            <td class="text-center">{{$i->order_id}}</td>
            <td>{{$i->order_title}}</td>
            <td class="text-center"><a href="/client/{{$i->client_id}}" style="text-decoration: none;">{{$i->cfname}} {{$i->clname}}</a></td>
            @if ($i->ffname==Null && $i->flname == Null)
            <td class="text-warning text-center">Not Given</td>
            @else
            <td class="text-center" style="color:#3200a7e0;"><a href="freelancer/{{$i->freelancer_id}}" style="text-decoration: none;color:#3200a7e0;" class="text-dark">{{$i->ffname}} {{$i->flname}}</a></td>
            @endif
            <td class="text-center">{{$i->updated_at}}</td>
            @if ($i->status=="O")
            <td class="text-center text-primary">Open</td>
            @elseif($i->status=="G")
            <td class="text-center text-success">Given</td>
            @elseif($i->status=="P")
            <td class="text-center text-danger">Pending</td>
            @elseif($i->status=="C")
            <td class="text-center text-success">Completed</td>
            @elseif($i->status=="E")
            <td class="text-center text-danger">Closed</td>
            @elseif($i->status=="EF")
            <td class="text-center text-danger">Canceled by freelancer</td>
            @elseif($i->status=="EC")
            <td class="text-center text-danger">Canceled by Client</td>
            @endif
            <td class="text-center"><a href="/viewOrder/{{$i->order_id}}"><i class="fa fa-eye" aria-hidden="true"></i></a></td>
            @if($i->status=='EC' || $i->status=='EF' || $i->status=='C' || $i->status=='E')
            <td><button class="btn-secondary btn" disabled><i class="fa fa-edit" aria-hidden="true"></i></button></td>
            @else
             <td><button id="lnks"  class="btn" data-bs-toggle="modal" data-bs-target="#ids{{$i->order_id}}">
                        <i class="fa fa-edit" aria-hidden="true"></i>
                    </button></td>

                    <div class="modal fade" id="ids{{$i->order_id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                             
                              <form action="/updateOrder/{{$i->order_id}}" method="POST" id="frm">
                                  @csrf
                            <h5 class="modal-title" id="staticBackdropLabel">Edit Order details</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                              <i class="fa fa-window-close" aria-hidden="true"></i>
                  
                            </button>
                          </div>
                          <div class="modal-body">
                          
                     
                          <div>
                              <input type="text" name="order_title" class="form-control my-1" id="" placeholder="chnage Title">
                              <textarea name="order_desc" class="form-control my-1" id="" cols="30" rows="10" placeholder="chnage description"></textarea>
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
                  @endif
                  @if($i->status=='EC' || $i->status=='EF' || $i->status=='C' || $i->status=='E')
                    <td class="text-center"><button class="btn btn-secondary" disabled><i class="fa fa-trash" aria-hidden="true"></i></button></td>
                  @else
            <td class="text-center"><a href="/cancelorder/{{$i->order_id}}" class="btn btn-primary" onclick="return myConfirm();"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
            @endif
          </tr>
      @endforeach
    </tbody>
    </table>
  </div>
  <div class="row justify-content-center">
    {{$project->links()}}
  </div>
@endsection