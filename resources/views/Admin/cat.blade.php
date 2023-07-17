@extends('Admin.dashboard')
@section('sections')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/js/bootstrap.min.js" integrity="sha512-1/RvZTcCDEUjY/CypiMz+iqqtaoQfAITmNSJY17Myp4Ms5mdxPS5UV7iOfdZoxcGhzFbOm6sntTKJppjvuhg4g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
  function myConfirm() {
    var confirmation = confirm("Are you sure ? If you delete this category all subcategories related to it will deleted");
    if (confirmation) {
      return true;
    } else {
      return false;
    }
  }
</script>
@include('bcdn')

@if (Session('msg'))
    <div class="alert alert-success" id="alts">Data Updated Successfully</div>
@endif
<div class="text-center" style="display: inline;">
  <h2>CATEGORIES</h2>
  
</div>

<div><button class="btn btn-light" id="add"><i class="fa fa-plus" aria-hidden="true"></i></button>Add</div>

<div id="addfrm" class="container" style="display:none">
  <div class="row">
    <div class="col-8">
      <button class="btn shadow float-right mt-2 btn-danger" id="closefrm">X</button>
    </div>
    
  </div>
  
  <form action="/addmaincat" method="POST" enctype="multipart/form-data">
  @csrf
  <div class="row">
    <div class="col-8 my-3">
      <input class="form-control" type="text" name="category_name" placeholder="Category Name">
    </div>
 
    <div class="col-5 my-2">
    <input type="submit" value="Add" class="btn btn-success">
   
    </div>
   
  </div>
</form>

</div>

<div class="table-responsive">
    <table class="table table-sm">
      <thead class="bg-primary text-white">
        <tr class="text-center">
        <th>category Name</th>
        <th>View Subcategories</th>
        <th>Update</th>
        <th>Delete</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($categories as $i)
            <tr>
                <td>{{$i->category_name}}</td>
                <td class="text-center"><a href="/subcateA/{{$i->category_id}}" style="text-decoration: none;"><i class="fa fa-eye" aria-hidden="true"></i></a></td>
                <td class="text-center"><button type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#exampleModal">
                 <i class="fa fa-edit" aria-hidden="true"></i>
                </button></td>
                  <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit category</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-window-close" aria-hidden="true"></i></button>
      </div>
      <form action="/editcatadmin/{{$i->category_id}}" method="POST">
        @csrf
      <div class="modal-body">
        <span>Category Name</span>
        <input type="text" name="category_name" class="form-control" value="{{$i->category_name}}">
      </div>
      <div class="modal-footer">
       
        <button type="submit"  class="btn btn-primary">Save changes</button>
      </form>
      </div>
    </div>
  </div>
</div>


                <td class="text-center"><a href="/deletecat/{{$i->category_id}}" onclick="return myConfirm();"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
            </tr>

        @endforeach
      </tbody>
      
    </table>
  </div>
  <div class="row my-3 justify-content-center">
    <div class="col">
        {{$categories->links()}}
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