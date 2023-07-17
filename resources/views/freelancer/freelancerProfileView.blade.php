<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @include('bcdn')
    <title>Document</title>
    <script>
       window.onpageshow=function(event){
                 if(event.persisted)
                 {
                    window.location.reload();
                 }
             };
    </script>
    <style>
body{
    /* margin-top:20px; */
    font-family:Verdana, Geneva, Tahoma, sans-serif;
    color: #1a202c;
    text-align: left;
    background-color: #e2e8f0;    
}
.main-body {
    padding: 15px;
}
.card {
    box-shadow: 0 1px 3px 0 rgba(0,0,0,.1), 0 1px 2px 0 rgba(0,0,0,.06);
}
#formedit
{
  display: none;
}
.card {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 0 solid rgba(0,0,0,.125);
    border-radius: .25rem;
}

.card-body {
    flex: 1 1 auto;
    min-height: 1px;
    padding: 1rem;
}

.gutters-sm {
    margin-right: -8px;
    margin-left: -8px;
}

.gutters-sm>.col, .gutters-sm>[class*=col-] {
    padding-right: 8px;
    padding-left: 8px;
}
.mb-3, .my-3 {
    margin-bottom: 1rem!important;
}

.bg-gray-300 {
    background-color: #e2e8f0;
}
.h-100 {
    height: 100%!important;
}
.shadow-none {
    box-shadow: none!important;
}
    </style>
</head>
<body>
     @include('navbar')
     @foreach ($fdata as $i)
         
     
     <div class="container">
        <div class="main-body">
        
              <!-- Breadcrumb -->
              {{-- <nav aria-label="breadcrumb" class="main-breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                  <li class="breadcrumb-item"><a href="javascript:void(0)">User</a></li>
                  <li class="breadcrumb-item active" aria-current="page">User Profile</li>
                </ol>
              </nav> --}}
              <!-- /Breadcrumb -->
              
              <div class="row gutters-sm">
                <div class="col-md-4 mb-3">
                  <div class="card">
                    <div class="card-body">
                      <div class="d-flex flex-column align-items-center text-center">
                        {{-- <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Admin" class="rounded-circle" width="150"> --}}
                        <img src="data:image/png;base64,{{chunk_split(base64_encode($i->profile_pic))}}" class=" {{--img-fluid--}}" width="120" height="120px" alt="photo" style="border-radius:50%">
                        <div class="mt-3">
                          <h4>{{$i->username}}</h4>
                          <p class="text-secondary mb-1">{{$i->Profession}}</p>
                          <p class="text-muted font-size-sm">
                            @php
                            $state=DB::select('select * from states where state_id = ?', [$i->state_id]);
                            foreach ($state as $s) {
                                echo $s->state_name;
                            }
                            @endphp
                          </p>
                         
                             
                         @if(Session('role')=='client')
                             
                         
                            @if ($i->Availability == 1)
                            <a href="/proposal/{{$i->freelancer_id}}" class="btn btn-primary">
                            Hire
                          </a>
                            @else
                            <button class="btn btn-secondary" disabled>
                            Not Available
                            </button>
                            @endif

                          @elseif(Session('role')=='freelancer' && Session('id')==$i->freelancer_id)
                          <a href="/editfreelancer/{{$i->freelancer_id}}" class="btn btn-primary">
                            Edit
                          </a>
                          @endif
                          @if (Session('user') && Session('role')=='client')
                          
                          @php
                          $room=DB::table('chatrooms')->where('client_id','=',Session('id'),'and','freelancer_id','=',$i->freelancer_id)->first();    
                          @endphp
                          
                          @if($room)  
                          
                          <a href="/chats/{{$room->order_id}}" class="btn btn-outline-primary">chat</a>    
                          @endif
                          @endif
                          
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="card mt-3">
                    <ul class="list-group list-group-flush">
                     
                      <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap " style="height:50px;">
                        <h6>Per hour Rate:</h6>
                        <h6><span>$ {{$i->price}}</span></h6>
                      </li>
                      <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap " style="height:50px;">
                        <h6>Availability:</h6>
                        <h6>
                          @if ($i->Availability==1)
                          <span class="text-success">Available</span>
                      @else
                          <span class="text-danger">Not Available</span>
                      @endif  
                       </h6>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="col-md-8">
                  <div class="card mb-3">
                    <div class="card-body">
                      <div class="row">
                        <div class="col-sm-3">
                          <h6 class="mb-0">Full Name</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                          {{$i->firstname}} {{$i->lastname}}
                        </div>
                      </div>
                      <hr>
                      <div class="row">
                        <div class="col-sm-3">
                          <h6 class="mb-0">Email</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                          {{$i->email}}
                        </div>
                      </div>
                      <hr>
                      <div class="row">
                        <div class="col-sm-3">
                          <h6 class="mb-0">Phone</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                          {{$i->contact}}
                        </div>
                      </div>
                      <hr>
                      <div class="row" style="height: 325px; overflow:scroll;">
                        <div class="col-sm-3">
                          <h6 class="mb-0">About me</h6>
                        </div>
                        <div class="col-sm-9 text-secondary bg-light">
                          <span style="display:block;unicode-bid:embed;white-space:pre-wrap;font-family:Verdana, Geneva, Tahoma, sans-serif;"> {{$i->description}}</span>
                         
                        </div>
                      </div>
                    
                      
                     
                    </div>
                  </div>
    
                  <div class="row gutters-sm">
                    
                    <div class="col-sm-6 mb-3 col-lg-12">
                      <div class="card h-100">
                        <div class="card-body">
                          <h6 class="d-flex align-items-center mb-3"><i class="material-icons text-info mr-2">Skills</i></h6>
                          @php
                               $data=DB::select('select skill_name from skills,freelancerskills where freelancerskills.skill_id = skills.skill_id and freelancer_id =?', [$i->freelancer_id]);
                          @endphp
                          @foreach ($data as $skill)
                          {{-- <small class="btn-sm btn-success">{{$skill->skill_name}}</small>     --}}
                          <span class="badge bg-success p-2 mt-1">{{$skill->skill_name}}</span>
                          @endforeach
                          
                          
                        </div>
                      </div>
                    </div>
                  
    
    
                </div>
              </div>
    
            </div>
            {{-- @include('feedback') --}}
                        
        

        {{-- feedback --}}
        <div class="container bg-white my-3" style="border-radius:5px;">
          <div style="font-weight:600; " class="my-3">Feedback</div>
          @php
          if(Session('role')=='client'){
            
          $orderfeedback=DB::table('orders')->where('client_id','=',Session('id'),'and','freelancer_id','=',$i->freelancer_id)->first();
          // dd($orderfeedback);
          if($orderfeedback!=null){
          $feedback=DB::table('feedbacks')->where('client_id','=',$orderfeedback->client_id,'and','freelancer_id','=',$orderfeedback->freelancer_id)->first();
          
          }

          $check=DB::table('feedbacks')->where('client_id','=',Session('id'),'and','freelancer_id','=',$i->freelancer_id)->first();
            }

          
          @endphp
          @if(Session('role')=='client' && $check==null && $orderfeedback!=null && $feedback==null)
            @if($orderfeedback->freelancer_id==$i->freelancer_id)
            
            <form action="/feedback/{{$i->freelancer_id}}/{{Session('id')}}" method="POST">
            @csrf
            <textarea name="feedback" id="" cols="5" rows="5" class="form-control mb-2"></textarea>
            <input type="submit" value="Submit" class="form-control btn btn-primary">
            </form>
            @endif
            
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
              <div>{{str_replace('"', '', $idata->feedback)}}</div>
              {{-- @endif --}}
            </div>
            <hr>
            @endforeach
          </div>
        </div>


        {{-- feedbackend --}}
        </div>
        @endforeach
      

        <div class="container">
          @include('footer')  
          
        </div>

        <script>
          document.getElementById('edit').addEventListener('click',function()
          {
            document.getElementById('formedit').style.display='block';
          });
        </script>
        
</body>
</html>
