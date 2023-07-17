<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        *{
        font-family:Verdana, Geneva, Tahoma, sans-serif;
        }
        svg{
            display: none;
        }
    </style>
    <title>Document</title>
    @include('bcdn')
</head>
<body class="bg-light">
    @include('navbar')

    <div class="container w-100">
        <div class="row justify-content-center">
            @if ($orders[0])
                
            
            @foreach ($orders as $i)
                
            <div class="col-lg-8 col-md-10 col-sm-10 bg-white my-3 shadow" style="border-radius:7px;">
                <div class="mt-1">{{$i->order_title}}</div>
                <hr class="my-1">
                @if ($i->order_type=='F')
                <div class="mt-1 mb-2" style="font-weight:600;">Fixed Price</div>    
                @else
                <div class="mt-1 mb-2" style="font-weight:600;">Hourly Price</div>    
                @endif
                <div class="my-2">
                    {{$i->order_desc}}
                </div>
                <div class="my-2">
                    <span style="font-weight:600;">Required skills</span>
                    @php
                        $rskill=explode(',',$i->skills);
                    @endphp
                    @foreach ($rskill as $item)
                    <span class="bg-secondary    btn-sm " style="color: white">{{$item}}</span>                        
                    @endforeach

                </div>
                <div class="my-2">
                    <a href="/viewOrder/{{{$i->order_id}}}" class="btn btn-primary">View & apply</a>
                </div>
            </div>
            
            @endforeach
            @else
            <h1 class="text-secondary text-center">No Orders placed</h1>
            @endif
            
        </div>
    </div>
    <div class="container my-3">
    <div class="row justify-content-center">
        <div class="col-3">
        {{$orders->links()}}
        </div>
    </div>
</div>

    @include('footer')
</body>
</html>