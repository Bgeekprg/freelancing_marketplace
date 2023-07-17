@php
    $freelancer=DB::table('freelancers')->get();
@endphp
<div class="table-responsive">
    <table class="table table-sm"  id="myTable" border="1">
      <thead>
        <tr class="p-4 bg-dark text-light" style="background: black;color:white">
          <th>Username</th>
          <th>Firstname</th>
          <th>Lastname</th>
          <th>Email</th>
          <th>Contact</th>
          <th>Status</th>
          
        </tr>
      </thead>
      @foreach ($freelancer as $f)
          <tr>
            <td>{{$f->username}}</td>
            <td> {{$f->firstname}} </td>
            <td> {{$f->lastname}} </td>
            <td> {{$f->email}} </td>
            <td> {{$f->contact}} </td>
            @if ($f->status==1)
            
                <td><span class="btn-sm btn-success text-success">Active</span></td>
            @else
                <td ><span class="btn-sm btn-danger text-danger">Inactive</span></td>
            @endif
             </tr>
      @endforeach
      
    </table>
  </div>