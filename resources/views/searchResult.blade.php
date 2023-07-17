<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @include('bcdn')
    <style>
      svg{
        display: none;
      }
    </style>
</head>
<body class="bg-light">
    @include('navbar')
    <div class="container mt-5">
    <div class="row justify-content-center">
      {{-- <div>{{$data[0]->firstname}}</div> --}}
    @foreach ($datas as $fd)
    
        
    
    <div class="col-lg-4 col-sm-8 col-md-4" >{{--style="width:300px">--}}
    
      <div class="card mb-4 shadow" style="height:400px;">
        <div class="card-body text-center">
          
          <img src="data:image/jpg;base64,{{chunk_split(base64_encode($fd->profile_pic))}}"  loading="eager"  alt="avatar"
            class="rounded-circle img-fluid" style="width:120px; height:120px; ">      
           
           
          
          
          

          <h5 class="my-3 ">{{$fd->username}}</h5>  
        
          <h6 class="my-2 text-muted">{{$fd->firstname}} {{$fd->lastname}}</h6>
          <p class="text-muted mb-1">
          @if ($fd->Profession==Null)
          Not provided
          @else
          {{$fd->Profession}}
          @endif  
          </p>
          <p class="text-muted mb-1">
            {{-- @php
            $state=DB::select('select * from states where state_id = ?', [$fd->state_id]);
            foreach ($state as $s) {
              if($s->state_name==Null)
              {
                echo "Not provided";
              }
              else{
                echo $s->state_name;}
            }
            @endphp --}}
          </p>  
         <div class="mb-2">
          
         </div>
          <div class="d-flex justify-content-center mb-2">
            <a href="freelancer/{{$fd->freelancer_id}}" class="btn btn-primary mr-2">view</a>
            <button type="button" class="btn btn-outline-primary ms-1">Message</button>
          </div>
        </div>
    </div>
  </div>
  
        @endforeach
    </div>    
    {{-- <div class="row justify-content-center">
      {{$freelancersdata->links()}}
    </div> --}}
</div>
@include('footer')
</body>
</html>