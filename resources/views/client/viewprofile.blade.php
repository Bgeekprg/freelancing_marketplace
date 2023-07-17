<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script>
        setInterval(() => {
            document.getElementById('rsp').style.display="none";
        }, 3000);
    </script>
    @include('bcdn')
</head>
<body class="bg-light">
    @include('navbar')
    <div class="container my-4">
      
       

      
        <div class="row justify-content-center bg-white shadow" style="border-radius: 10px;" >
            <div class="col-lg-8 col-md-8 col-sm-12 my-2" >
                <img src="data:image/jpeg;base64,{{chunk_split(base64_encode($client->profile_image))}}" class="img-fluid shadow" style="border-radius:5px;"  width="120px" height="120px" alt="">
               
                <hr>
            </div>
            <div class="col-lg-8 col-md-8 col-sm-12 my-2">
                <span>Username</span>
                <input @readonly(true) type="text" name="username" id="" value="{{  $client->username}}" class="form-control">
            </div>
            <div class="col-lg-8 col-md-8 col-sm-12 my-2">
              <div class="row">
                <div class="col">
                <span>Firstnamee</span>
                <input @readonly(true) type="text" name="firstname" id="" value="{{  $client->firstname}}" class="form-control">
                </div>
                <div class="col">
                <span>Lastname</span>
                <input @readonly(true) type="text" name="lastname" id="" value="{{  $client->lastname}}" class="form-control">
                </div>
             </div>
            </div>
            <div class="col-lg-8 col-md-8 col-sm-12 my-2">
                <span>Email</span>
                <input @readonly(true) type="email" name="Email" id="" value="{{  $client->email}}" class="form-control">
            </div>
            <div class="col-lg-8 col-md-8 col-sm-12 my-2">
                <span>Contact</span>
                <input @readonly(true) type="number" name="contact" id="" value="{{  $client->contact}}" class="form-control">
            </div>
            <div class="col-lg-8 col-md-8 col-sm-12 my-2">
                <span>Gender</span>: 
                @if ($client->gender=='M')
                <span class="badge bg-primary p-2 ml-3">Male</span>
                @else
                <span class="badge bg-primary p-2 ml-3">Female</span>
                @endif
               
            </div>
            @php
                 $state=DB::table('states')->where('state_id','=',$client->state_id)->first();

                    $country=DB::table('countries')->where('country_id','=',$state->country_id)->first();
            @endphp
            <div class="col-lg-8 col-md-8 col-sm-12 my-2">
            Country-
            <span class="badge bg-primary p-2 ml-1">{{$country->country_name}}</span>
            </div>
            <div class="col-lg-8 col-md-8 col-sm-12 mt-2 mb-5">
            State-
            <span class="badge bg-primary p-2 ml-4">{{$state->state_name}}</span>
            </div>
            
        
    
    </div>
</body>
</html>







