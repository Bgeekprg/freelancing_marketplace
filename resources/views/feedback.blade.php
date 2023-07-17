


<div class="container bg-white my-3" style="border-radius:5px;">
    <div style="font-weight:600; " class="my-3">Feedback</div>
    @php
    if(Session('role')=='client'){
    $orderfeedback=DB::table('orders')->where('client_id','=',Session('id'),'and','freelancer_id','=',$i->freelancer_id)->first();
    if($orderfeedback){
    $feedback=DB::table('feedbacks')->where('client_id','=',$orderfeedback->client_id,'and','freelancer_id','=',$orderfeedback->freelancer_id)->first();
    }
      }
    @endphp
    @if(Session('role')=='client')
   
      
      <form action="/feedback/{{$i->freelancer_id}}/{{$i->client_id}}" method="POST">
      @csrf
      <textarea name="feedback" id="" cols="5" rows="5" class="form-control mb-2"></textarea>
      <input type="submit" value="Submit" class="form-control btn btn-primary">
      </form>

      
    @endif
    <div class="row ">
      @php
          $f=DB::select('select * from feedbacks where freelancer_id = ?', [$i->freelancer_id]);

          
      @endphp
      @foreach ($f as $idata)
      <div class="col">
        <hr>
        @if(Session('id')==$idata->client_id)
        <span class="btn btn-warning" id="edit"><i class="fa fa-edit" aria-hidden="true"></i></span>
        <div id="formedit">
          <form action="/editfeedback/{{$idata->feedback_id}}" method="POST">
            @csrf
            <div>
              <textarea name="feedback" class="form-control" id="" cols="5" rows="5">{{$idata->feedback}}</textarea>
              <input type="submit" class="btn btn-success my-1" value="Submit">
            </div>
          </form>
        </div>
        @endif
        
        <div class="text-info mb-2" style="font-size:13px;text-align:right">{{$idata->posted_at}}</div>
        {{-- @if(Session('id')!=$f->client_id) --}}
        <div>{{$idata->feedback}}</div>
        {{-- @endif --}}
      </div>
      <hr>
      @endforeach
    </div>
  </div>