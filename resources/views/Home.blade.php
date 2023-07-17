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
    
    /* .social-link {
    width: 30px;
    height: 30px;
    border: 1px solid #ddd;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #666;
    border-radius: 50%;
    transition: all 0.3s;
    font-size: 0.9rem;
} */

/* .social-link:hover, .social-link:focus {
    background: #ddd;
    text-decoration: none;
    color: #555;
} 
    */


    </style>
   <script>
    setInterval(() => {
        document.getElementById('rsp').style.display="none";
    }, 6000);
</script>
</head>
<body class="bg-light">
  
  @include('navbar')
  
  {{-- search bar --}}
  <div class="container-fluid ">
    <form action="/search" method="GET" enctype="multipart/form-data">
      @csrf
  <div class="row justify-content-center bg-light">
    <div class="col-lg-8 col-md-8 col-sm-6">
      <input type="search" name="search"  class="form-control shadow"id="">
    </div>
   
    <div class="col-2">
     <button class="btn btn-primary shadow">Search</button>
    </div>
  </div>
</form>
   </div>

  
@if (Session('success'))
<div class="alert alert-success text-center" id="rsp">{{Session('success')}}</div>     
@endif

<div class="container my-3">
  <h2 class="text-center">HOW IT WORKS</h2>
  <hr>
    <div class="row text-center">

        <!-- Team item -->
        <div class="col-xl-3 col-sm-6 mb-5">
            <div class="bg-white rounded shadow-lg shadow-sm px-4" style="padding-bottom: 60px; padding-top:42px;"><img src="hiwIcn_01.png" alt="" width="100" class="img-fluid rounded-circle mb-3 img-thumbnail shadow-sm">
                <h5 class="mb-0">POST PROJECT</h5>
                <hr>
               <span> Post a Project to tell us about your project. We’ll quickly match you with awesome freelancers.</span>
            </div>
        </div><!-- End -->

        <!-- Team item -->
        <div class="col-xl-3 col-sm-6 mb-5">
            <div class="bg-white rounded shadow-lg shadow-sm py-5 px-4"><img src="hiwIcn_02.webp" alt="" width="100" class="img-fluid rounded-circle mb-3 img-thumbnail shadow-sm">
                <h5 class="mb-0">FIND & HIRE</h5>
                <hr>
                <span>Browse proposals, profiles of freelancers & their reviews. Compare, Interview & finalise the candidate.

                </span>
            </div>
        </div><!-- End -->

        <!-- Team item -->
        <div class="col-xl-3 col-sm-6 mb-5">
            <div class="bg-white rounded shadow-lg shadow-sm py-5 px-4"><img src="hiwIcn_04.png" alt="" width="100" class="img-fluid rounded-circle mb-3 img-thumbnail shadow-sm">
                <h5 class="mb-0">WORK & APPROVE</h5>
                <hr>
                <span>Award Project to the finalised freelancer on our Website & enjoy 100% money back guarantee using Safe Deposit.</span>
            </div>
        </div><!-- End -->

        <!-- Team item -->
        <div class="col-xl-3 col-sm-6 mb-5">
            <div class="bg-white rounded shadow-lg shadow-sm py-5 px-4"><img src="hiwIcn_03.png" alt="" width="100" class="img-fluid rounded-circle mb-3 img-thumbnail shadow-sm">
                <h5 class="mb-0">AWARD & PAY</h5>
                  <hr>
                  <span>Use our Website to chat, share files & collaborate with your freelancer. Release the payment once satisfied.</span>               

            </div>
        </div><!-- End -->
        <hr>
    </div>
</div>



  {{-- search bar ends --}}
   @php
  
    
    $subcategories=DB::select('select * from subcategories order by rand() limit 9');
   @endphp
  
    
      <div class="container-fluid w-100">

        <div class="row bg-light justify-content-center">
          @foreach ($subcategories as $i)
          
          <div class="col-lg-3 col-sm-11 col-md-5 bg-white mx-lg-5 my-3 mx-md-3 text-center shadow">
          <div class="mt-2">
            {{-- <img src="{{asset('/storage/delivery/16777708002.jpg')}}" class="img-fluid" alt="abc" > --}}
            <img src="data:image/jpeg;base64,{{chunk_split(base64_encode($i->cat_logo))}}" height="200px" width="250px"  alt="">    
          </div>
          <div>
            <p>{{$i->subcategory_name}}</p>
          </div>
          <div>
            
          </div>
          <div>
           <a href="/viewfreelancersbycategory/{{$i->subcategory_id}}" class="btn btn-primary my-2">View</a>
          </div>
          </div>
          @endforeach
          </div>
        </div>
        
   
  @include('footer')

</body>
</html>




