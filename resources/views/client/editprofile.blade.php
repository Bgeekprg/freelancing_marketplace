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
    <div class="container">
        @if (Session('msg'))
        <div class="alert alert-success" id="rsp">{{Session('msg')}}</div>     
        @endif
       

        <form action="/updateclient/{{$client->client_id}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row justify-content-center bg-white shadow" style="border-radius: 10px;" >
            <div class="col-lg-8 col-md-8 col-sm-12 my-2" >
                <img src="data:image/jpeg;base64,{{chunk_split(base64_encode( $client->profile_image))}}" class="img-fluid shadow" style="border-radius:5px;"  width="120px" height="120px" alt="">
                {{-- <img src="data:image/jpeg;base64,{{base64_encode(  $client->profile_pic)}}" alt="photo"> --}}
                <input type="file" name="profile_image" class="form-control">
                <hr>
            </div>
            <div class="col-lg-8 col-md-8 col-sm-12 my-2">
                <span>Username</span>
                <input type="text" name="username" id="" value="{{  $client->username}}" class="form-control">
            </div>
            <div class="col-lg-8 col-md-8 col-sm-12 my-2">
              <div class="row">
                <div class="col">
                <span>Firstnamee</span>
                <input type="text" name="firstname" id="" value="{{  $client->firstname}}" class="form-control">
                </div>
                <div class="col">
                <span>Lastname</span>
                <input type="text" name="lastname" id="" value="{{  $client->lastname}}" class="form-control">
                </div>
             </div>
            </div>
            <div class="col-lg-8 col-md-8 col-sm-12 my-2">
                <span>Email</span>
                <input type="email" name="Email" id="" value="{{  $client->email}}" class="form-control">
            </div>
            <div class="col-lg-8 col-md-8 col-sm-12 my-2">
                <span>Contact</span>
                <input type="number" name="contact" id="" value="{{$client->contact}}" class="form-control">
            </div>
            {{-- <div class="col-lg-8 col-md-8 col-sm-12 my-2">
                <span>Gender</span>: 
                @if ($client->gender=='M')
                <span>Male</span>
                @else
                <span>Female</span>
                @endif
                <select name="gender" id="">
                    <option value="M">Male</option>
                    <option value="F">Female</option>
                </select>
            </div>
            <div class="col-lg-8 col-md-8 col-sm-12 my-2">
            country
            </div>
            <div class="col-lg-8 col-md-8 col-sm-12 my-2">
            state
            </div> --}}
            <div class="col-lg-8 col-md-8 col-sm-12 my-2">
                <span class="pr-3">Gender</span>: 
                @if ($client ->gender=='M')
                <span class="badge bg-primary p-2">Male <span class="badge bg-warning text-dark gs"   style="cursor: pointer"><i class="fa fa-edit" aria-hidden="true"></i></span></span>
                @else
                <span class="badge bg-primary p-2">Female <span class="badge bg-warning text-dark gs"   style="cursor: pointer"><i class="fa fa-edit" aria-hidden="true"></i></span></span>
                @endif
                <select class="form-control" name="gender" id="gender">
                    <option value="M">Male</option>
                    <option value="F">Female</option>
                </select>
            </div>
            @php
                    if($client->state_id){
                    $state=DB::table('states')->where('state_id','=',$client->state_id)->first();

                    $country=DB::table('countries')->where('country_id','=',$state->country_id)->first();
                    $showallstate=DB::table('states')->where('country_id','=',$country->country_id)->get();
                    }
            @endphp
            <div class="col-lg-8 col-md-8 col-sm-12 my-2">
            <span class="pr-4">country</span>:<span class="badge bg-primary p-2">
                @if ($client->state_id)
                {{$country->country_name}}
                @endif    
            <span class="badge bg-warning text-dark" id="cchange" style="cursor: pointer"><i class="fa fa-edit" aria-hidden="true"></i></span></span>
            <select class="form-control" name="" id="country" onchange="getstate(this.value);">
                
            </select>
            </div>
            <div class="col-lg-8 col-md-8 col-sm-12 my-2">
                
            <span class="pr-4">state</span>: <span class="badge bg-primary p-2">
                @if ($client->state_id){{$state->state_name}}@endif  <span class="badge bg-warning text-dark" id="schange"  style="cursor: pointer"><i class="fa fa-edit" aria-hidden="true"></i></span></span>
            <select class="form-control" name="state_id" id="state">
                @if ($client->state_id)
                @foreach ($showallstate as $i)
                    @if ($i->state_id == $client->state_id)
                    <option value="{{$i->state_id}}" selected>{{$i->state_name}}</option>    
                    @else
                    <option value="{{$i->state_id}}">{{$i->state_name}}</option>
                    @endif
                    
                @endforeach
                @endif
            </select>
          
            </div>

            <div class="col-lg-8 col-md-8 col-sm-12 my-2">
            <input type="submit" value="Save" class="form-control btn text-light" style="background: rgb(112, 48, 202)">
            </div>

            
        
    </form>
    </div>
</body>
</html>
<script>
      function getstate(data)
    {    var x=new  XMLHttpRequest();
        var state=document.getElementById('state');
        state.innerHTML=" ";
    x.open('GET','http://127.0.0.1:8000/states/'+data,true);
    x.onload=function()
    {
        

        var response=JSON.parse(x.responseText);
        console.log(JSON.parse(x.responseText));
        for(var i=0;i<response.length;i++)
        {
            state.innerHTML+="<option value="+response[i]['state_id']+">"+response[i]['state_name']+"</option>";
        }
    }
    x.send();   
    }
    
    window.onpageshow=function(){
        document.getElementById('country').style.visibility='hidden';
        document.getElementById('state').style.visibility='hidden';
        document.querySelector('#gender').style.visibility='hidden';
    var x=new  XMLHttpRequest();
    x.open('GET','http://127.0.0.1:8000/countries',true);
    x.onload=function()
    {    @if ($client->state_id)
        var pc={{$country->country_id}}
        @else
        var pc=1;
        @endif
        
        var country=document.getElementById('country');
        var data=JSON.parse(x.responseText);
        console.log(JSON.parse(x.responseText));
        for(var i=0;i<data.length;i++)
        {   
            if(pc==data[i]['country_id'])
            {
                country.innerHTML+="<option value="+data[i]['country_id']+" selected>"+data[i]['country_name']+"</option>";
            }
            else{
            country.innerHTML+="<option value="+data[i]['country_id']+">"+data[i]['country_name']+"</option>";
            }
        }
        
    
    }
    
    x.send();
    
    
    }
   
    document.querySelector('#cchange').addEventListener('click',
    function()
    {   if( document.querySelector('#country').style.visibility=='visible'){
        document.querySelector('#country').style.visibility='hidden';
        }
        else{
        document.querySelector('#country').style.visibility='visible';
        }      
    });

    document.querySelector('#schange').addEventListener('click',
    function()
    {   if( document.querySelector('#state').style.visibility=='visible'){
        document.querySelector('#state').style.visibility='hidden';
        }
        else{
        document.querySelector('#state').style.visibility='visible';
        }      
    });

    document.querySelector('.gs').addEventListener('click',
    function()
    {   if( document.querySelector('#gender').style.visibility=='visible'){
        document.querySelector('#gender').style.visibility='hidden';
        }
        else{
        document.querySelector('#gender').style.visibility='visible';
        }      
    });
   
</script>






