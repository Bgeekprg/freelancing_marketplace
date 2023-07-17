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
        <div class="text-center bg-secondary text-white w-100 my-2" style="height:40px;font-size:25px;">change Password</div>
        <form action="/passwordchangeforgot/{{$email}}" method="POST">
        @csrf
        <div class="row justify-content-center">
           
            <div class="col-8 my-3">
                <span>Enter New password</span>
                <input type="password" class="form-control" name="password" id="" placeholder="password">
                @error('password')
                <span class="text-danger">{{$message}}</span>
                @enderror   
            </div>
            <div class="col-8 my-3">
                <span>Repeat new password</span>
                <input type="password" class="form-control" name="new_password" id="" placeholder="new password">
                @error('new_password')
                <span class="text-danger">{{$message}}</span>
            @enderror   
            </div>
          
            <div class="col-8 my-3">
                <input type="submit" class="form-control btn btn-success" value="change" id="">
            </div>
         </div>
        </form>
    </div>
</body>
</html>