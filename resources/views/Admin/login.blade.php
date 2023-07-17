<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <title>Login</title>

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
       
       {
        background: darkgray;
       }
    </style>
</head>
<body class="bg-light">
    @include('navbar')
    <div class="py-3"><a href="/adminregister" class="btn btn-info float-right mr-2">Register Admin</a></div>
    <div class="container mt-5 bg-white shadow-lg " style="border-radius:10px;">
        <div class="w-100 pb-4 text-center pt-3">
            <span class="w-100">
                <img src="logo.jpeg" alt="" height="50" width="50">
                <span class="text-secondary text-center" style="font-size: 25px;">Admin</span>
            </span>
        </div style="font-size: 25px;">
        <form action="/adminLogin" method="POST" enctype="multipart/form-data">
        @csrf
     
        <div class="row justify-content-center px-md-auto">
           
            <div class="col-lg-8 col-sm-12 p-2">
            <span>Email</span>  <input  type="text" name="email" id="" value="{{old('email')}}" class="form-control bg-light " placeholder="Email">  
             @error('email')
                 <span class="text-danger">{{$message}}</span>
             @enderror   
            </div>
            
            <div class="col-lg-8 col-sm-12 my-3 p-2">
            <span>Password</span>  <input  type="password" name="password" id="" value="{{old('password')}}" class="form-control bg-light " placeholder="Password">  
            @error('password')
                 <span class="text-danger">{{$message}}</span>
             @enderror   
            </div>
           
            
            <div class="col-lg-8 col-sm-12 py-2 pb-4">
                <input type="submit" class="form-control btn btn-success" value="Login"  style="background: rgb(112, 48, 202)">  
              </div>
              
            
        </div>
    </form>
  
    </div>

  
</body>
</html>