<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @include('bcdn');
</head>
<body>
    <h3>{{$data['title']}}</h3>
    <h3>Welcome {{$data['body']}}</h3>
     <br>
     <hr>
     <p>you registered successfully . please login and complete your profile</p>
    <a href="http://127.0.0.1:8000/login" class="btn btn-dark">login</a>
</body>
</html>