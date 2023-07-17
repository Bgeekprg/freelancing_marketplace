<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        
   
</head>
<body>
    
    @php
        $data=DB::select('select * from users');
    @endphp
    <div class="table-responsive">
    <table class="table table-sm" border="1">
        <thead class="text-center">
           
                <th>ID</th>
                <th>EMAIL</th>
                <th>JOINED AT</th>
                <th>ROLE</th>
           
        </thead>
        
        <tbody class="text-center">
            @php
                $cnt=1;
            @endphp
            @foreach ($data as $i)
             @if ($cnt%2==0)
             <tr class="text-center bg-light">
                <td>{{$i->user_id}}</td>
                <td>{{$i->email}}</td>
                <td>{{$i->created_at}}</td>
                @if ($i->role=='C')
                <td>Client</td>
                @else
                <td>Freelancer</td>
                @endif
            </tr>
            @else
            <tr class="text-center bg-dark text-white">
                <td>{{$i->user_id}}</td>
                <td>{{$i->email}}</td>
                <td>{{$i->created_at}}</td>
                @if ($i->role=='C')
                <td>Client</td>
                @else
                <td>Freelancer</td>
                @endif
            </tr>
            @endif
            {{$cnt++;}}
            @endforeach
          
        </tbody>
    </table>
    </div>
</body>
</html>