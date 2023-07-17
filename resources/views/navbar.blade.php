<div id="preloader" style="
   
  background:black url('tenor.gif') no-repeat center cover;
   height: 100vh;
   width: 100%;
   z-index:99992;
   position: fixed;
"></div>
 
  <script>
    var loader=document.getElementById('preloader');
    window.onload=function()
    {
      loader.style.display="none";
    } 
    // window.addEventListener("load",function()
    // { 
    //     loader.style.display='none';
    // });
    // var name=sessionStorage.getItem("user");
    // console.log(name);
   
  </script>
<header style="width:100%;position:sticky;top:0;z-index:9999;" class="mb-3" >
 
  <nav class="navbar navbar-expand-lg navbar-light bg-white text-center shadow w-100"style="position:sticky;top:0;">
    @php
    $categories=DB::select('select * from categories');
    @endphp
    <a class="navbar-brand" href="/"><img src="/logo.jpeg" height="40px" width="40px" style="border-radius:50%;" alt="logo"></a>
    
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a onMouseOver="this.style.borderBottom='2px solid black'" onMouseOut="this.style.border='none'" class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a onMouseOver="this.style.borderBottom='2px solid black'" onMouseOut="this.style.border='none'" class="nav-link" href="/addorder">Post Project</a>
        </li>
        <li class="nav-item">
          <a onMouseOver="this.style.borderBottom='2px solid black'" onMouseOut="this.style.border='none'" class="nav-link" href="/findFreelancers">Find Freelancers</a>
        </li>
        <li class="nav-item">
          <a onMouseOver="this.style.borderBottom='2px solid black'" onMouseOut="this.style.border='none'" class="nav-link" href="/AllOrders">Find Projects</a>
        </li>
        <li class="nav-item dropdown">  
          <a onMouseOver="this.style.borderBottom='2px solid black'" onMouseOut="this.style.border='none'" class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Categories
          </a>
        
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            @foreach ($categories as $item)
            <a class="dropdown-item" href="/subcategories/{{$item->category_id}}">{{$item->category_name}}</a>     
            @endforeach
            {{-- <div class="dropdown-divider"></div>
            <a onMouseOver="this.style.border='1px solid black'" onMouseOut="this.style." class="dropdown-item" href="#">Something else here</a>
          </div> --}}
        </li>
       
      </ul>
      {{-- <form class="form-inline my-2 my-lg-0 d-lg-flex">
        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
      </form> --}}
      

      <div class="mr-4">
        <div class="btn dropdown text-center mr-4">
        @if (Session('user'))
          {{-- <a href="/logout" style="text-decoration: none;">Log out</a> --}}
          
            <button class="btn dropdown btn-light dropdown-toggle" type="button" id="dpbtn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user-circle" aria-hidden="true"></i></button>
            <div class="dropdown-menu" aria-labelledby="dpbtn">
              <a href="/logout" class="dropdown-item">Logout</a>
              @if (url()->current()=='http://127.0.0.1:8000/dashboard')
                
              @else
              <a href="/dashboard" class="dropdown-item">Dashboard</a>  
              @endif
              
            </div>
          
        @else
        {{-- <a href="login" style="text-decoration: none;">Login</a> --}}
        <button class="btn dropdown btn-light dropdown-toggle" type="button" id="dpbtn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user-circle" aria-hidden="true"></i></button>
            <div class="dropdown-menu" aria-labelledby="dpbtn">
              <a href="/login" class="dropdown-item">Login</a>
              <a href="/register" class="dropdown-item">Sign Up</a>
              
            </div>
        @endif
      </div>
      </div>
    </div>
  </nav>
      
 
</header>