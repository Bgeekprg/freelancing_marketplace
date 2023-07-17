@extends('Admin.dashboard')
@section('sections')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/js/bootstrap.min.js" integrity="sha512-1/RvZTcCDEUjY/CypiMz+iqqtaoQfAITmNSJY17Myp4Ms5mdxPS5UV7iOfdZoxcGhzFbOm6sntTKJppjvuhg4g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@include('bcdn')

@if (Session('msg'))
    <div class="alert alert-success" id="alts">Data Updated Successfully</div>
@endif
<script>

function myConfirm() {
    var confirmation = confirm("Are you sure you want to Inactivate this Freelancer ?");
    if (confirmation) {
      return true;
    } else {
      return false;
    }
  }
    setInterval(() => {
        document.getElementById('alts').style.display="none";
    }, 3000);
</script>
<a href="/freelancerReport" class="btn text-light mb-3" style="background: #0d2ffde0;">Report <i class="fa fa-file-pdf" aria-hidden="true"></i></a>
<a href="/excelfreelancer" style="background: #0d2ffde0;" class="btn text-light mb-3">Export <i class="fa fa-file-excel" aria-hidden="true"></i></a>
<div class="text-center" style="display: inline;">
  <h2>FREELANCERS</h2>
  
</div>
<div class="table-responsive">
    <table class="table table-sm"  id="myTable">
      <thead class="bg-dark text-white text-center">
        <tr class="p-4 bg-dark text-light">
          <th class="p-3">Username</th>
          <th class="p-3">Firstname</th>
          <th class="p-3">Lastname</th>
          <th class="p-3">Email</th>
          <th class="p-3">Contact</th>
          <th class="p-3">Status</th>
          <th class="p-3">View</th>
          <th class="p-3">Edit</th>
          <th class="p-3">Delete</th>
        </tr>
      </thead>
      @foreach ($freelancer as $f)
          <tr class="text-center">
            <td class="py-2">{{$f->username}}</td>
            <td class="py-2"> {{$f->firstname}} </td>
            <td class="py-2"> {{$f->lastname}} </td>
            <td class="py-2"> {{$f->email}} </td>
            <td class="py-2"> {{$f->contact}} </td>
            @if ($f->status==1)
            
                <td class="py-2"><span class="btn-sm btn-success">Active</span></td>
            @else
                <td ><span class="btn-sm btn-danger">Inactive</span></td>
            @endif
            <td class="py-2"><a class="btn btn-sm btn-primary" href="/freelancer/{{$f->freelancer_id}}"><i class="fa fa-eye" aria-hidden="true"></i></a></td>
            <td class="py-2"><button id="lnks" style="font-size: 12px;" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#ids{{$f->freelancer_id}}">
            <i class="fa fa-edit" aria-hidden="true"></i>
            </button></td>
            <td class="py-2">
              @if($f->status==1)
              <a class="btn btn-sm btn-danger" href="/delete/{{$f->freelancer_id}}" onclick="return myConfirm()"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
              @else
              <a href="/activate/{{$f->freelancer_id}}" class="btn btn-sm btn-success"><i class="fa fa-toggle-on" aria-hidden="true"></i></a> 
              @endif

            
  <!-- Modal -->
  <div class="modal fade" id="ids{{$f->freelancer_id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
           
            <form action="/updatef/{{$f->freelancer_id}}" method="POST" id="frm">
                @csrf
          <h5 class="modal-title" id="staticBackdropLabel"><h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
            <i class="fa fa-window-close" aria-hidden="true"></i>

          </button>
        </div>
        <div class="modal-body">
        
   
        <div class="row">
           <div class="col-lg-12 col-md-12 col-sm-12 mb-2">
            <span>Username</span>
            <input type="text" class="form-control" name="username" id="" value="{{$f->username}}">
           </div>
           <div class="col-6 my-2">
            <span>Firstname</span>
            <input type="text" class="form-control" name="firstname" id="" value="{{$f->firstname}}">
           </div>
           <div class="col-6 my-2">
            <span>Lastname</span>
            <input type="text" class="form-control" name="lastname" id="" value="{{$f->lastname}}">
           </div>
           <div class="col-6 my-2">
            <span>Email</span>
            <input type="email" class="form-control" name="email" id="" value="{{$f->email}}">
           </div>
           <div class="col-6 my-2">
            <span>Contact</span>
            <input type="number" class="form-control" name="contact" id="" value="{{$f->contact}}">
           </div>
           
           
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
          </tr>
      @endforeach
      
    </table>
  </div>
  <div class="row my-3 justify-content-center">
    <div class="col">
        {{$freelancer->links()}}
    </div>
    
  </div>
  
@endsection