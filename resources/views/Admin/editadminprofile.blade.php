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
    <style>
        *
        {
            font-family: Verdana, Geneva, Tahoma, sans-serif;
        }
    </style>
    @include('bcdn')
</head>
<body class="bg-light">
    @include('navbar')
    <div class="container">
        @if (Session('msg'))
        <div class="alert alert-success" id="rsp">{{Session('msg')}}</div>     
        @endif
       <div class="bg-dark text-light"><img src="logo.jpeg" height="60" width="60" alt=""><span style="font-weight:500;font-size:20px;">Admin Profile</span></div>
        <hr>
        <form action="/updateAdmin/{{$admin->admin_id}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row justify-content-center bg-white shadow" style="border-radius: 10px;" >
         
            <div class="col-lg-8 col-md-8 col-sm-12 my-2">
                <span>Username</span>
                <input type="text" name="username" id="" value="{{  $admin->username}}" class="form-control">
            </div>
            <div class="col-lg-8 col-md-8 col-sm-12 my-2">
              <div class="row">
                <div class="col">
                <span>Firstnamee</span>
                <input type="text" name="firstname" id="" value="{{  $admin->firstname}}" class="form-control">
                </div>
                <div class="col">
                <span>Lastname</span>
                <input type="text" name="lastname" id="" value="{{  $admin->lastname}}" class="form-control">
                </div>
             </div>
            </div>
            <div class="col-lg-8 col-md-8 col-sm-12 my-2">
                <span>Email</span>
                <input type="email" name="Email" id="" value="{{  $admin->email}}" class="form-control">
            </div>
            <div class="col-lg-8 col-md-8 col-sm-12 my-2">
                <span>Contact</span>
                <input type="email" name="Email" id="" value="{{  $admin->contact}}" class="form-control">
            </div>
            
            <div class="col-lg-8 col-md-8 col-sm-12 my-2">
                <span>password</span>
                <input type="password" name="password" id="" value="{{ $admin->password}}" class="form-control">
            </div>
           

            <div class="col-lg-8 col-md-8 col-sm-12 my-2">
            <input type="submit" value="Save changes" class="form-control btn text-light" style="background: rgb(112, 48, 202)">
            </div>

            
        
    </form>
    </div>
</body>
</html>







