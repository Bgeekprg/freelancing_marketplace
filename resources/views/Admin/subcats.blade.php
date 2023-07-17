@extends('Admin.dashboard')
@section('sections')

<div><button class="btn btn-light" id="add"><i class="fa fa-plus" aria-hidden="true"></i></button>Add</div>

<div id="addfrm" class="container" style="display:none">
  <div class="row">
    <div class="col-8">
      <button class="btn shadow float-right mt-2 btn-danger" style="font-size:18px;" id="closefrm"><i class="fa fa-window-close" aria-hidden="true"></i></button>
    </div>
    
  </div>
  
  <form action="/addcat/{{$cid}}" method="POST" enctype="multipart/form-data">
  @csrf
  <div class="row">
    <div class="col-8 my-3">
      <input class="form-control" type="text" name="subcategory_name" placeholder="Category Name">
    </div>
    <div class="col-8 my-3">
      <input class="form-control" type="file" name="cat_logo" id="">
    </div>
    <div class="col-5 my-2">
    <input type="submit" value="Add" class="btn btn-success">
   
    </div>
   
  </div>
</form>

</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/js/bootstrap.min.js" integrity="sha512-1/RvZTcCDEUjY/CypiMz+iqqtaoQfAITmNSJY17Myp4Ms5mdxPS5UV7iOfdZoxcGhzFbOm6sntTKJppjvuhg4g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

@include('bcdn')

@if (Session('msg'))
    <div class="alert alert-success" id="alts">Data Updated Successfully</div>
@endif

<div class="table-responsive">
    <table class="table table-sm"  id="myTable">
      <thead class="bg-primary text-white">
        <tr class="text-center">
        <th>Name</th>
        <th>Image</th>
        <th>Update</th>
        <th>Delete</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($subcategories as $i)
            <tr class="text-center">
                <td>{{$i->subcategory_name}}</td>
                <td><img src="data:image/jpeg;base64,{{chunk_split(base64_encode($i->cat_logo))}}" class="img-fluid shadow" style="border-radius:5px;"  width="120px" height="120px" alt=""></td>
                <td><button id="lnks"  class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#ids{{$i->subcategory_id}}">
                  <i class="fa fa-edit" aria-hidden="true"></i>
              </button></td>
                <td class="text-center"><a href="/subcatdelete/{{$i->subcategory_id}}" style="text-decoration:none;"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
  {{--    model               --}}
  <div class="modal fade" id="ids{{$i->subcategory_id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
           
          <form action="/subcatUpdate/{{$i->subcategory_id}}" method="POST" id="frm" enctype="multipart/form-data">
          @csrf
          <h5 class="modal-title" id="staticBackdropLabel">title</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
            <i class="fa fa-window-close" aria-hidden="true"></i>
          </button>
        </div>
        <div class="modal-body">
          <input type="text" class="form-control my-2" placeholder="Subcategory Name" name="subcategory_name" value="{{$i->subcategory_name}}">
          <img src="data:image/jpeg;base64,{{chunk_split(base64_encode($i->cat_logo))}}" class="img-fluid shadow" style="border-radius:5px;"  width="120px" height="120px" alt="">
          <input type="file" class="form-control my-2" name="cat_logo"> 
        <div>
           
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
  {{-- model end --}}
            </tr>

        @endforeach
      </tbody>
      
    </table>
  </div>
  <div class="row my-3 justify-content-center">
    <div class="col">
        {{$subcategories->links()}}
    </div>
    
  </div>
  

  <script>
   document.getElementById('add').addEventListener('click',function()
   {
    document.getElementById('addfrm').style.display='block';
    
   });
   document.getElementById('closefrm').addEventListener('click',function()
   {
    document.getElementById('addfrm').style.display='none';
    
   });
  </script>
@endsection