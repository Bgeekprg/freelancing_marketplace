<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=div, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        *{
            font-family: Verdana, Geneva, Tahoma, sans-serif;
        }
    </style>
    @include('bcdn')
</head>
<body class="bg-light">
    @include('navbar')
    <div class="container mt-5 border shadow">
        <div class="text-center bg-secondary text-white w-100 my-2" style="height:40px;font-size:25px;">Forgot Password</div>
        <form action="/verifyotp/{{$otp}}" method="POST">
        @csrf
        <div class="row justify-content-center">
           
            <div class="col-8 my-3">
                <span>Enter Registered Email id</span>
                <input type="number" class="form-control" name="otp" id="" placeholder="otp">
              
              
            </div>
            
          
            <div class="col-8 my-3">
                <input type="submit" class="form-control btn btn-success" value="send OTP" id="">
            </div>
         </div>
        </form>
    </div>
</body>
</html>