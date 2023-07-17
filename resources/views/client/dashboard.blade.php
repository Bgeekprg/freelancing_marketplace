<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  {{-- <meta name="author" content="Mark Otto, Jacob Thor nton, and Bootstrap contributors"> --}}
  {{-- <meta name="generator" content="Hugo 0.72.0"> --}}
  <title>Dashboard Template · Bootstrap</title>
  {{-- @include('bcdn') --}}
  
  <link rel="canonical" href="https://v5.getbootstrap.com/docs/5.0/examples/dashboard/">
 

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css" integrity="sha512-q3eWabyZPc1XTCmF+8/LuE1ozpg5xxn7iO89yfSOd5/oKvyqLngoNGsx8jq92Y8eXJ/IRxQbEC+FGSYxtk2oiw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css"
    integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js"
    integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/"
    crossorigin="anonymous"></script>

  <style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }

    body {
      font-size: .875rem;
    }

    .feather {
      width: 16px;
      height: 16px;
      vertical-align: text-bottom;
    }

    /* Sidebar*/
      /* table padding */
      .table-sm>:not(caption)>*>* {
    padding: 1.25rem 0.25rem;
    }
    .sidebar {
      position: fixed;
      top: 0;
      bottom: 0;
      left: 0;
      z-index: 100;
      /* Behind the navbar */
      padding: 48px 0 0;
      /* Height of navbar */
      box-shadow: inset -1px 0 0 rgba(0, 0, 0, .1);
    }

    @media (max-width: 767.98px) {
      .sidebar {
        top: 5rem;
      }
    }

    .sidebar-sticky {
      position: relative;
      top: 0;
      height: calc(100vh - 48px);
      padding-top: .5rem;
      overflow-x: hidden;
      overflow-y: auto;
      /* Scrollable contents if viewport is shorter than content. */
    }

    .sidebar .nav-link {
      font-weight: 500;
      color: #333;
    }

    .sidebar .nav-link .feather {
      margin-right: 4px;
      color: #727272;
    }

    .sidebar .nav-link.active {
      color: #007bff;
    }
    .nav-link:hover 
    {
      color: #fff;
      background: rgba(0, 0, 0, 0.826);
    }
    .sidebar .nav-link:hover .feather,
    .sidebar .nav-link.active .feather {
      color: inherit;
    }

    .sidebar-heading {
      font-size: .75rem;
      text-transform: uppercase;
    }

    /*Navbar*/
    .navbar-brand {
      padding-top: .75rem;
      padding-bottom: .75rem;
      font-size: 1rem;
      background-color: rgba(0, 0, 0, .25);
      box-shadow: inset -1px 0 0 rgba(0, 0, 0, .25);
    }

    .navbar .navbar-toggler {
      top: .25rem;
      right: 1rem;
    }

    .navbar .form-control {
      padding: .75rem 1rem;
      border-width: 0;
      border-radius: 0;
    }

    .form-control-dark {
      color: #fff;
      background-color: rgba(255, 255, 255, .1);
      border-color: rgba(255, 255, 255, .1);
    }

    .form-control-dark:focus {
      border-color: transparent;
      box-shadow: 0 0 0 3px rgba(255, 255, 255, .25);
    }
    .dropdown-menu ul
    {
      width: inherit;
      overflow: hidden;
    }
    .sidebar .nav-link
    {
      color:white;
    }
    .card {
        background-color: #fff;
        border-radius: 10px;
        border: none;
        position: relative;
        margin-bottom: 30px;
        box-shadow: 0 0.46875rem 2.1875rem rgba(90,97,105,0.1), 0 0.9375rem 1.40625rem rgba(90,97,105,0.1), 0 0.25rem 0.53125rem rgba(90,97,105,0.12), 0 0.125rem 0.1875rem rgba(90,97,105,0.1);
    }
    

.l-bg-blue-dark {
    background: linear-gradient(to right, #373b44, #4286f4) !important;
    color: #fff;
}

  </style>
</head>

<body>

  <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="#">{{Session('user')}}</a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-toggle="collapse"
      data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search"  onkeyup="myFunction()" id="myInput">
    <ul class="navbar-nav px-3">
      <li class="nav-item text-nowrap">
        <a class="nav-link" href="/logout">Sign out</a>
      </li>
    </ul>
  </nav>

  <div class="container-fluid">
    <div class="row">
      <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-dark sidebar collapse">
        <div class="position-sticky pt-3">
          <ul class="nav flex-column text-white">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="/">
                <span data-feather="home"></span>
                Home <i class="fa fa-home" aria-hidden="true"></i>
              </a>
            </li>
            <li class="nav-item">
              
              {{-- <a class="nav-link" href="/client/{{Session('id')}}"> --}}
              <a href="/editprofileClient/{{Session('id')}}" class="nav-link">
                <span data-feather="file"></span>
                Profile <i class="fa fa-user-circle" aria-hidden="true"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/projectsofclient">
                <span data-feather="file"></span>
                Projects <i class="fa fa-file" aria-hidden="true"></i>
              </a> 
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/addorder">
                <span data-feather="file"></span>
                Add Project <i class="fas fa-file-plus"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/findFreelancers">
                <span data-feather="file"></span>
                Find Freelancers <i class="fa fa-search" aria-hidden="true"></i>
              </a>
            </li>
            
              {{-- <li class="nav-item dropright">
                <a class="nav-link dropright-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Categories
                </a>
                @php
                    $categories=DB::select('select * from categories');
                @endphp
                 
                <div class="dropdown-menu bg-light w-inherit" aria-labelledby="navbarDropdown">
                  <ul class="nav flex-column">
                  @foreach ($categories as $item)
                  <li class="nav-item">
                  <a class="dropdown-item" href="/subcategories">{{$item->category_name}}</a>     
                  </li>
                  @endforeach
                  </ul>
                  
              
                
              </li> --}}
             
            <li>
              <a class="nav-link" href="/delivery_view">
                <span data-feather="file"></span>
                Delivery <i class="fa fa-arrow-down" aria-hidden="true"></i>
                
              </a>
            </li>
                
            <li>
              <a class="nav-link" href="/payment">
                <span data-feather="file"></span>
                Payment <i class="fa fa-credit-card" aria-hidden="true"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/changepassword">
                <span data-feather="file"></span>
                Change Password <i class="fas fa-file-plus"></i>
              </a>
            </li>
          
          
            
           
          </ul>

         
        </div>
      </nav>

      <main class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
        <div
          class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          @php
              $path=Request::path();
          @endphp
          @if ($path == 'dashboard')
          <h1 class="h2">Dashboard</h1>    
          @endif
          <div class="btn-toolbar mb-2 mb-md-0">
           
            <button type="button" id="times" class="btn btn-sm btn-outline-secondary">
              <span data-feather="calendar"></span>
              @php
                  echo date("y/m/d");
                  // echo date("h:i:sa");
                  
              @endphp
            </button>
          </div>
        </div>
        
        <div id="data-container">
          {{-- @if(Session('clientprojects')) 
          <div class="row">
            @foreach (Session('clientprojects') as $item)
            <div class="col-lg-8 col-sm-12 col-md-8 bg-primary text-white my-3">
              Title
              {{$item->order_desc}}
            </div>
            @endforeach
          </div>
          @endif --}}
          
         {{-- {{dd(Session::all())}} --}}
          
          @yield('content')
        </div>

        {{-- <h2>Section title</h2> --}}
        {{-- <div class="table-responsive">
          <table class="table table-striped table-sm">
        
            
          </table>
        </div> --}}
        @php
            $path=Request::path();
            $ordersC=DB::select('SELECT count(*) as cnt FROM orders where client_id=? ', [Session('id')]);
        @endphp
        @if ($path=='dashboard')
        {{-- <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-3 col-md-3 col-sm-8 my-3 mx-3 shadow text-center text-light" style=" height:170px;border-radius:3px;background:rgb(9, 6, 63);">
              <div style="font-size: 20px;" class="py-3">Uploaded Projects</div>
              @if ($ordersC[0]->cnt)
              <div style="font-size: 20px;" class="py-3">{{$ordersC[0]->cnt}}</div>    
              @else
              <div style="font-size: 20px;" class="py-3">0</div>
              @endif
              
            </div>
          </div>
          </div>         --}}
          <div class="col-md-10 ">
            <div class="row justify-content-center ">
          <div class="col-xl-3 col-lg-6">
            <div class="card l-bg-blue-dark">
                <div class="card-statistic-3 p-4">
                    <div class="card-icon card-icon-large"><i class="fa fa-file " aria-hidden="true"></i></div>
                    <div class="mb-4">
                        <h5 class="card-title mb-0">Total Projects</h5>
                    </div>
                    <div class="row align-items-center mb-2 d-flex">
                        <div class="col-8">
                            <h2 class="d-flex align-items-center mb-0">
                                {{-- 3,243 --}}
                                {{$ordersC[0]->cnt}}
                            </h2>
                        </div>
                      
                    </div>
                   
                </div>
            </div>
        </div>
            </div>
          </div>
        @endif
      </main>
    </div>
  </div>


  <script src="/docs/5.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-DBjhmceckmzwrnMMrjI7BvG2FmRuxQVaTfFYHgfnrdfqMhxKt445b7j3KBQLolRl"
    crossorigin="anonymous"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.24.1/feather.min.js"
    integrity="sha384-EbSscX4STvYAC/DxHse8z5gEDaNiKAIGW+EpfzYTfQrgIlHywXXrM9SUIZ0BlyfF"
    crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"
    integrity="sha384-i+dHPTzZw7YVZOx9lbH5l6lP74sLRtMtwN2XjVqjf3uAGAREAF4LMIUDTWEVs4LI"
    crossorigin="anonymous"></script>
  <script src="dashboard.js"></script>
</body>

<script>
  function myFunction() {
    // Declare variables
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("myTable");
    tr = table.getElementsByTagName("tr");
  
    // Loop through all table rows, and hide those who don't match the search query
    for (i = 0; i < tr.length; i++) {
      td = tr[i].getElementsByTagName("td")[0];
      if (td) {
        txtValue = td.textContent || td.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
          tr[i].style.display = "";
        } else {
          tr[i].style.display = "none";
        }
      }
    }
  }
  </script>
 
</html>


