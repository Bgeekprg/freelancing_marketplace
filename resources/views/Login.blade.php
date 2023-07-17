<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    {{-- <meta  http-equiv="refresh" content="0;URL='http://127.0.0.1:8000/dashboard'">     --}}
    
    
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script> --}}
    @include('bcdn')

    <script>
       
        setInterval(() => {
            document.getElementById('rsp').style.display="none";
        }, 5000);
        
    </script>
    <title>Login</title>
     <script>
       
        
       window.onpageshow=function(event){
            if(event.persisted)
            {
               window.location.reload();
            }
        };
       
    </script>
    <style>
       
        *
        {
            font-family: Verdana, Geneva, Tahoma, sans-serif;
        }
        #selection
        {
            height: inherit;
        }
        .container
        {
            height: 80vh;
            /* width: 100vh; */
        }
        input[type="text"],input[type="password"]
        {
            border:1px solid #28a745;
        }
        form
        {
            /* width: inherit; */
        }
        #selection div
        {
            border-radius: 3px;
            text-align: center;
            cursor: pointer;
            
        }
        input[type="radio"]
        {
            display: none;
        }
       .container
       {
        height: inherit;
       }
    </style>
</head>
<body class="bg-light">
    @include('navbar')
    @if (Session('inactive'))
        <div class="alert alert-danger text-center" id="rsp">{{Session('inactive')}}</div>     
        @endif
    <div class="pb-5">
    <a href="/loginAdmin" style="text-decoration: none;" class="float-right mr-lg-5  btn btn-link border">Admin</a>
    </div>
    <div class="container mt-5 bg-white pb-3 shadow mw-sm-100">
        <form action="loginauth" method="POST" enctype="multipart/form-data">
        @csrf
        {{-- <div class="row justify-content-center" id="selection">
            @error('login-selection')
                <span class="text-danger col-lg-12 col-sm-8 col-md-3 my-lg-3 text-center">{{$message}}</span>
            @enderror
         <div class="col-lg-3 col-sm-8 col-md-3 my-lg-3 mx-lg-5 mx-md-5 my-1 border border-success" id="lf">
            <input type="radio" name="login-selection" value="freelancer" id="login-freelancer">Freelancer
         </div>
         <div class="col-lg-3 col-sm-8 col-md-3 my-lg-3 mx-lg-5 mx-md-5 my-1 border border-success" id="lc"> 
            <input type="radio" name="login-selection" value="client" id="login-client">Client
         </div>
        </div> --}}
        <div class="row justify-content-center px-md-auto">
            <div class="col-lg-8 col-sm-12 text-center">
            <img src="/logo.jpeg" alt="" width="60" height="60">
            <span style="font-size: 25px;">Login</span>
            </div>
            <hr>
            <div class="col-lg-8 col-sm-12 py-4">
            <span>Email</span>  <input type="text" name="email" id="" value="{{old('email')}}" class="form-control" placeholder="Email">  
             @error('email')
                 <span class="text-danger">{{$message}}</span>
             @enderror   
            </div>
            
            <div class="col-lg-8 col-sm-12 my-3">
            <span>Password</span>  <input type="password" name="password" id="" value="{{old('password')}}" class="form-control" placeholder="Password">  
            @error('password')
                 <span class="text-danger">{{$message}}</span>
             @enderror   
            </div>
            <div class="col-lg-8 col-sm-12 my-3">
                <a href="/forgotpassword" style="text-decoration: none;">forgot password ?</a>
            </div>
            {{-- <div class="col-lg-8 col-sm-12 my-3">
                <input type="checkbox" name="" id="" class=""><span class="ml-2">Remember me  </span>
            </div> --}}
            
            <div class="col-lg-8 col-sm-12">
                <input type="submit" class="form-control btn btn-success" value="Login" style="background: rgb(112, 48, 202)">  
            </div>
              
            
        </div>
    </form>
        <div class="col-lg-8 col-sm-12 pt-2">
            <div class="text-secondary text-center">Dont't have an account? <a href="/register" style="text-decoration: none;">Create One</a></div>
        </div>
    </div>

    <script>
    //    document.getElementById("lf").addEventListener('click',function(){
    //     // document.getElementById("lf").style.boxShadow="2px 2px 2px black";
    //     document.getElementById("lf").style.background="#28a745";
    //     document.getElementById("lf").style.color="#fff";
    //     // document.getElementById("lf").style.width="";
    //     // document.getElementById("lc").style.boxShadow="0px 0px 0px #fff";
    //     document.getElementById("login-freelancer").checked="true";
    //     document.getElementById("lc").style.color="black";
    //     document.getElementById("lc").style.background="#fff";


    //    });
    //    document.getElementById("lc").addEventListener('click',function(){
    //     // document.getElementById("lc").style.boxShadow="2px 2px 2px black";
    //     // document.getElementById("lf").style.boxShadow="0px 0px 0px #fff";
    //     document.getElementById("login-client").checked="true";
    //     document.getElementById("lc").style.background="#28a745";
    //     document.getElementById("lf").style.background="#fff";
    //     document.getElementById("lc").style.color="#fff";
    //     document.getElementById("lf").style.color="black";
    //    });
    </script>
</body>
</html>