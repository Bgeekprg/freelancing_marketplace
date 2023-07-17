@php
    $client=DB::table('clients')->get();
@endphp
<div class="table-responsive" style="font-family: Verdana, Geneva, Tahoma, sans-serif;text-transform:capitalize;">
    <table class="table table-sm" id="myTable" border="1">
      <thead class="bg-dark text-white text-center" style="background:#343a40;color:#ffff;">
        <tr>
          <th>Username</th>
          <th>Firstname</th>
          <th>Lastname</th>
          <th>Email</th>
          <th>Contact</th>
          <th>Status</th>
        
        </tr>
      </thead>
      @foreach ($client as $f)
          <tr class="text-center" style="text-align:center;">
            <td>{{$f->username}}</td>
            <td> {{$f->firstname}} </td>
            <td> {{$f->lastname}} </td>
            <td> {{$f->email}} </td>
            <td> {{$f->contact}} </td>
            @if ($f->status==1)
            
                <td><span class="btn-sm btn-success">Active</span></td>
            @else
                <td ><span class="btn-sm btn-danger">Inactive</span></td>
            @endif
          


            
  
          </tr>
      @endforeach
      
    </table>
  </div>