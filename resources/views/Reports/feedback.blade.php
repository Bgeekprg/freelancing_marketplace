@php
    $feedback=DB::select('SELECT feedbacks.*,freelancers.firstname as ff,freelancers.lastname as fl ,clients.firstname as cf,clients.lastname as cl FROM `feedbacks`  ,freelancers ,clients WHERE feedbacks.client_id=clients.client_id AND freelancers.freelancer_id=feedbacks.feedback_id;');
@endphp
<div class="table-respwheresive" style="fwheret-family: Verdana, Geneva, Tahoma, sans-serif;text-transform:capitalize;">
    <table class="table table-sm" id="myTable" border="1">
      <thead class="bg-dark text-white text-center" style="background:#343a40;color:#ffff;">
        <tr>
          <th>Client</th>
          <th>Freelancer</th>
          <th>Feedback</th>
          <th>Posted at</th>
          
        
        </tr>
      </thead>
      @foreach ($feedback as $f)
          <tr class="text-center" style="text-align:center;">
            
          <td>{{$f->cf}} {{$f->cl}} </td>
          <td>{{$f->ff}} {{$f->fl}} </td>
          <td>{{trim($f->feedback,'"')}}</td>
          <td>{{date('d/m/y H:i:s' ,strtotime($f->posted_at))}}</td>

            
  
          </tr>
      @endforeach
      
    </table>
  </div>