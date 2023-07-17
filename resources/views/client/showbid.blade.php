@extends('client.dashboard')
@section('content')
    @if (Session('msg'))
    <div class="alert alert-success" id="ntf">
        {{Session('msg')}}
    </div>    
    @endif
    @if (Session('msgr'))
    <div class="alert alert-success" id="ntf">
        {{Session('msgr')}}
    </div>    
    @endif
    <script>
         function myConfirm() {
  var confirmation = confirm("Are you sure ?");
  if (confirmation) {
    return true;
  } else {
    return false;
  }
}

        setInterval(() => {
            document.getElementById('ntf').style.display="none";
        }, 3000);
        
    </script>
        <div class="container">

            {{-- <a href="/rejectallbid/{{$bids[0]->order_id}}" class="btn btn-danger">Reject All</a> --}}
            <div class="row">
                @foreach ($bids as $bd)
                    <div class="col-lg-9 my-3 col-md-8 col-md-12 shadow bg-white" style="font-size:15px;font-weight:500;border-radius:5px;">
                    @php
                        $fr=DB::select('select * from freelancers where freelancer_id = ?', [$bd->freelancer_id])
                    @endphp
                    <div class="my-2">
                        <a href="/freelancer/{{$fr[0]->freelancer_id}}" style="text-decoration:none;">
                        <img src="data:image/png;base64,{{chunk_split(base64_encode($fr[0]->profile_pic))}}" class="rounded-circle img-fluid border border-primary" style="width: 40px;height:40px;"  alt="">
                        <span class="text-secondary">{{$fr[0]->username}}</span>
                        </a>
                        <span class="bg-white text-secondary mx-5 mx-sm-0" style="font-size:15px;font-weight:500;">
                        {{$bd->created_at}} 
                        </span>
                    </div>
                   
                    <div class="bg-white">
                        <span>Proposal Detail</span>
                        <textarea name="" class="form-control" id="" cols="20" rows="10" readonly style="height:80px;">{{$bd->bid_desc}}</textarea>
                    </div>
                    <div class="bg-white" style="font-size:15px;font-weight:500;">
                        <span>Budget</span>
                        <input type="text" value="{{$bd->full_project_budget}} " class="form-control" readonly>
                        
                    </div>
                    {{-- <div class="bg-white" style="font-size:15px;font-weight:500;">
                        <span>Advance deposit</span>
                        <input type="text" value="{{$bd->required_deposit}}" class="form-control" readonly>
                        <span style="font-size: 12px; float:right;" class="text-success">Non Refundable</span>
                    </div> --}}
                    @if ($bd->status==1)
                        <button class="btn btn-success w-50">Accepted</button>
                    @elseif($bd->mark_as_rejected==1)
                    <button class="btn btn-danger w-50">Rejected</button>
                    @else
                    <div class="my-2">
                        <button class="btn btn-success mr-2"><a href="/acceptbid/{{$bd->bid_id}}/{{$bd->order_id}}/{{$bd->freelancer_id}}/{{$bd->full_project_budget}}" style="text-decoration: none;color:white;" onclick="return myConfirm();">Accept</a mx-2</button>
                        <button class="btn btn-danger mx-2"><a href="/rejectbid/{{$bd->bid_id}}" style="text-decoration: none;color:white;"  onclick="return myConfirm();">Reject</a></button>
                    </div>
                    @endif
                   
                   
                </div>
                @endforeach
               

            </div>
            @if ($bids==null)
                <h1 class="text-secondary text-center">There are no bids placed</h1>
            @endif
        </div>
        

@endsection