<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Hugo 0.72.0">
  <title>Dashboard Template · Bootstrap</title>


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
      /* table padding */
      .table-sm>:not(caption)>*>* {
    padding: 1.25rem 0.25rem;
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
    .sidebar .nav-link
    {
      color:white;
    }
 
    /* cards */
        .card {
        background-color: #fff;
        border-radius: 10px;
        border: none;
        position: relative;
        margin-bottom: 30px;
        box-shadow: 0 0.46875rem 2.1875rem rgba(90,97,105,0.1), 0 0.9375rem 1.40625rem rgba(90,97,105,0.1), 0 0.25rem 0.53125rem rgba(90,97,105,0.12), 0 0.125rem 0.1875rem rgba(90,97,105,0.1);
    }
    .l-bg-cherry {
        background: linear-gradient(to right, #493240, #f09) !important;
        color: #fff;
    }

.l-bg-blue-dark {
    background: linear-gradient(to right, #373b44, #4286f4) !important;
    color: #fff;
}

.l-bg-green-dark {
    background: linear-gradient(to right, #0a504a, #38ef7d) !important;
    color: #fff;
}

.l-bg-orange-dark {
    background: linear-gradient(to right, #a86008, #ffba56) !important;
    color: #fff;
}

.card .card-statistic-3 .card-icon-large .fas, .card .card-statistic-3 .card-icon-large .far, .card .card-statistic-3 .card-icon-large .fab, .card .card-statistic-3 .card-icon-large .fal {
    font-size: 110px;
}

.card .card-statistic-3 .card-icon {
    text-align: center;
    line-height: 50px;
    margin-left: 15px;
    color: #000;
    position: absolute;
    right: -5px;
    top: 20px;
    opacity: 0.1;
}

.l-bg-cyan {
    background: linear-gradient(135deg, #289cf5, #84c0ec) !important;
    color: #fff;
}

.l-bg-green {
    background: linear-gradient(135deg, #23bdb8 0%, #43e794 100%) !important;
    color: #fff;
}

.l-bg-orange {
    background: linear-gradient(to right, #f9900e, #ffba56) !important;
    color: #fff;
}

.l-bg-cyan {
    background: linear-gradient(135deg, #289cf5, #84c0ec) !important;
    color: #fff;
}

  </style>
</head>

<body>

  <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="#">{{Session("user")}}</a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-toggle="collapse"
      data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search" onkeyup="myFunction()" id="myInput">
    
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
          <ul class="nav flex-column">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="/dashboard">
                <span data-feather="home"></span>
                Dashboard
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/">
                <span data-feather="file"></span>
                Home <span><i class="fa fa-home" aria-hidden="true"></i></span>
              </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/freelancer/{{Session('id')}}">
                  <span data-feather="file"></span>
                  Profile <span><i class="fa fa-user-circle" aria-hidden="true"></i></span>
                </a>
              </li>
           
            <li class="nav-item">
              <a class="nav-link" href="/fprojects/{{Session('id')}}">
                <span data-feather="file"></span>
                Projects <i class="fa fa-file" aria-hidden="true"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/AllOrders">
                <span data-feather="file"></span>
                Add Projects <i class="fa fa-plus ml-1" aria-hidden="true"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/Bids/{{Session('id')}}">
                <span data-feather="file"></span>
                Bids
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/clientRequests/{{Session('id')}}">
                <span data-feather="file"></span>
                Client Requests 
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/changepassword">
                <span data-feather="file"></span>
                Change Password
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/deliveryoffreelancer">
                <span data-feather="file"></span>
                Delivery 
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/freelancerpaymentview">
                <span data-feather="file"></span>
                Payment <i class="fa fa-credit-card" aria-hidden="true"></i>
              </a>
            </li>
          
            
           
          </ul>

          {{-- <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
            <span>Saved reports</span>
            <a class="link-secondary" href="#" aria-label="Add a new report">
              <span data-feather="plus-circle"></span>
            </a>
          </h6>
          <ul class="nav flex-column mb-2">
            <li class="nav-item">
              <a class="nav-link" href="#">
                <span data-feather="file-text"></span>
                Current month
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <span data-feather="file-text"></span>
                Last quarter
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <span data-feather="file-text"></span>
                Social engagement
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <span data-feather="file-text"></span>
                Year-end sale
              </a>
            </li>
          </ul> --}}
        </div>
      </nav>

      <main class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
        <div
          class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          {{-- <h1 class="h2">Dashboard</h1> --}}
          <div class="btn-toolbar mb-2 mb-md-0 text-center">
           
            <button type="button" id="times" class="btn btn-sm btn-outline-secondary">
              
              @php
                  echo date("y/m/d");
                  // echo date("h:i:sa");
              @endphp
            </button>
            
          </div>
        </div>
        @php
            $path=Request::path();
            $orders=DB::table('orders')->where('freelancer_id','=',Session('id'))->count();
            $ordersP=DB::select('SELECT count(*) as cnt FROM orders where freelancer_id=? and status=?', [Session('id'),'P']);
            $ordersC=DB::select('SELECT count(*) as cnt FROM orders where freelancer_id=? and status=?', [Session('id'),'c']);
            
            $totatearn=DB::select('SELECT sum(final_price) as total FROM `payment` inner JOIN orders ON payment.order_id=orders.order_id  where freelancer_id=?',[Session('id')]);
        @endphp
        @if ($path=='dashboard')
        {{-- <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-3 col-md-3 col-sm-8 my-3 mx-3 shadow text-center text-light" style=" height:170px;border-radius:3px;background:rgb(9, 6, 63);">
            <div style="font-size: 20px;" class="py-3">Total earned</div>
            @if ($totatearn[0]->total)
            <div style="font-size: 20px;" class="py-3">$ {{$totatearn[0]->total}}</div>    
            @else
            <div style="font-size: 20px;" class="py-3">$</div>
            @endif
            
          </div>
        </div>
        </div>        
      <hr>




        <div class="container-fluid">
          <div class="row justify-content-center">
            <div class="col-lg-3 col-md-3 col-sm-8 my-3 mx-3 shadow text-center text-light" style=" height:170px;border-radius:3px;background:rgb(56, 52, 139);">
              <div style="font-size: 20px;" class="py-3">Total Projects</div>
              <div style="font-size:30px" class="py-3">{{$orders}}</div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-8 my-3 mx-3 shadow text-center  text-light" style=" height:170px;border-radius:3px;background:green;">
              <div style="font-size: 20px;" class="py-3">Pending Projects</div>
              <div style="font-size:30px" class="py-3">{{$ordersP[0]->cnt}}</div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-8 my-3 mx-3 shadow text-center  text-light" style=" height:170px;border-radius:3px;background:rgb(205, 158, 38);">
              <div style="font-size: 20px;" class="py-3">Completed Projects</div>
              <div style="font-size:30px" class="py-3">{{$ordersC[0]->cnt}}</div>
            </div>
          </div>
        </div> --}}


        <div class="col-md-10 ">
          <div class="row ">
              <div class="col-xl-3 col-lg-6">
                  <div class="card l-bg-cherry">
                      <div class="card-statistic-3 p-4">
                          <div class="card-icon card-icon-large"><i class="fas fa-shopping-cart"></i></div>
                          <div class="mb-4">
                              <h5 class="card-title mb-0">Total Orders</h5>
                          </div>
                          <div class="row align-items-center mb-2 d-flex">
                              <div class="col-8">
                                  <h2 class="d-flex align-items-center mb-0">
                                      {{-- 3,243 --}}
                                      {{$orders}}
                                  </h2>
                              </div>
                            
                          </div>
                         
                      </div>
                  </div>
              </div>
              <div class="col-xl-3 col-lg-6">
                  <div class="card l-bg-blue-dark">
                      <div class="card-statistic-3 p-4">
                          <div class="card-icon card-icon-large"><i class="fas fa-users"></i></div>
                          <div class="mb-4">
                              <h5 class="card-title mb-0">Pending Projects</h5>
                          </div>
                          <div class="row align-items-center mb-2 d-flex">
                              <div class="col-8">
                                  <h2 class="d-flex align-items-center mb-0">
                                      {{-- 15.07k --}}
                                      {{$ordersP[0]->cnt}}
                                  </h2>
                              </div>
                              
                          </div>
                         
                      </div>
                  </div>
              </div>
              <div class="col-xl-3 col-lg-6">
                  <div class="card l-bg-green-dark">
                      <div class="card-statistic-3 p-4">
                          <div class="card-icon card-icon-large"><i class="fas fa-ticket-alt"></i></div>
                          <div class="mb-4">
                              <h5 class="card-title mb-0">Completed</h5>
                          </div>
                          <div class="row align-items-center mb-2 d-flex">
                              <div class="col-8">
                                  <h2 class="d-flex align-items-center mb-0">
                                      {{-- 578 --}}
                                      {{$ordersC[0]->cnt}}
                                  </h2>
                              </div>
                            
                          </div>
                         
                      </div>
                  </div>
              </div>
              <div class="col-xl-3 col-lg-6">
                  <div class="card l-bg-orange-dark">
                      <div class="card-statistic-3 p-4">
                          <div class="card-icon card-icon-large"><i class="fas fa-dollar-sign"></i></div>
                          <div class="mb-4">
                              <h5 class="card-title mb-0">Total Earning</h5>
                          </div>
                          <div class="row align-items-center mb-2 d-flex">
                              <div class="col-8">
                                  <h2 class="d-flex align-items-center mb-0">
                                    @if ($totatearn[0]->total)
                                    $ {{$totatearn[0]->total}}
                                    @else
                                    $ 0
                                    @endif
                                  </h2>
                              </div>
                              
                          </div>
                       
                      </div>
                  </div>
              </div>
          </div>
      </div>
      
        @endif
        @yield('content')

    
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