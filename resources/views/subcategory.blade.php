<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <link rel="canonical" href="https://v5.getbootstrap.com/docs/5.0/examples/album/"> --}}
    <title>Document</title>
    @include('bcdn')
    <style>
    *
    {
        font-family:Verdana, Geneva, Tahoma, sans-serif;
    }
    div span a{
      display: none;
    }



    </style>
    
</head>
<body>
  
    @include('navbar')
  

      <div class="container-fluid w-100">

        <div class="row bg-light">
          @foreach ($subcate as $i)
          
          <div class="col-lg-3 col-sm-11 col-md-5 bg-white mx-lg-5 my-lg-3 text-center shadow py-2">
          <div>
            <img src="data:image/png;base64,{{chunk_split(base64_encode($i->cat_logo))}}" alt="" class="" width="200px" height="200px">
          </div>
          <div>
            <p>{{$i->subcategory_name}}</p>
          </div>
          <div>
            
          </div>
          <div>
           <a href="/viewfreelancersbycategory/{{$i->subcategory_id}}" class="btn btn-primary">View</a>
          </div>
          </div>
          @endforeach
          </div>
        </div>
      
   
  
</body>
</html>




