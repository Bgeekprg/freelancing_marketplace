<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Hugo 0.72.0">
  <title>freelancing</title>
  
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
    svg
    {
      display: none;
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
        .nav-link:hover 
    {
      color: #fff;
      background: rgba(0, 0, 0, 0.826);
    }
    .sidebar  .feather,
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
    /* table padding */
    .table-sm>:not(caption)>*>* {
    padding: 1.25rem 0.25rem;
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


<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/js/bootstrap.min.js" integrity="sha512-1/RvZTcCDEUjY/CypiMz+iqqtaoQfAITmNSJY17Myp4Ms5mdxPS5UV7iOfdZoxcGhzFbOm6sntTKJppjvuhg4g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body>

  <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="/viewadminprofile">{{Session('user')}}</a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-toggle="collapse"
      data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <input class="form-control form-control-dark w-100" type="text" id="myInput" placeholder="Search" aria-label="Search" onkeyup="myFunction()">
    <ul class="navbar-nav px-3">
      <li class="nav-item text-nowrap">
        <a class="nav-link" href="/logout">Sign out</a>
      </li>
    </ul>
  </nav>

  <div class="container-fluid">
    <div class="row">
      <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
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
                Home <i class="fa fa-home" aria-hidden="true"></i>
              </a>
            </li>
            <li class="nav-item">
              @php
                  use App\Http\Controllers\AdminController;
              @endphp
              <a class="nav-link" href="/projects">
                <span data-feather="file"></span>
                Projects <i class="fa fa-file" aria-hidden="true"></i>
              </a>
            </li>
           
            <li class="nav-item">
              <a class="nav-link" href="/freelancerA">
                <span data-feather="users"></span>
                Freelancers 
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/clientA">
                <span data-feather="bar-chart-2"></span>
                Clients
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/feedbackA">
                <span data-feather="layers"></span>
                Feedbacks 
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/categoryA">
                <span data-feather="layers"></span>
                Categories <i class="fa fa-bars" aria-hidden="true"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/adminpayments">
                <span data-feather="layers"></span>
                payments <i class="fa fa-credit-card" aria-hidden="true"></i>
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
         @if ($path== 'dashboard')
         <h1 class="h2">Dashboard</h1>   
         @endif
          
      
        </div>

     @php
         $path = Request::path();
         $ccnt=DB::select('SELECT COUNT(client_id) as client FROM clients where status=1');
         $fcnt=DB::select('SELECT COUNT(freelancer_id) as freelancer FROM freelancers where status=1 or status=0');
         $ocnt=DB::select('SELECT COUNT(*)as ordr FROM orders');
     @endphp
        @if ($path == 'dashboard')
          {{-- <div class="container-fluid">
            <div class="row justify-content-center">
              <div class="col-lg-3 col-md-3 col-sm-8 my-3 mx-3 shadow text-center text-light" style=" height:170px;border-radius:3px;background:rgb(56, 52, 139);">
                <div style="font-size: 20px;" class="py-3">Total Clients</div>
                <div style="font-size:30px" class="py-3">{{$ccnt[0]->client}}</div>
              </div>
              <div class="col-lg-3 col-md-3 col-sm-8 my-3 mx-3 shadow text-center  text-light" style=" height:170px;border-radius:3px;background:green;">
                <div style="font-size: 20px;" class="py-3">Total Freelancers</div>
                <div style="font-size:30px" class="py-3">{{$fcnt[0]->freelancer}}</div>
              </div>
              <div class="col-lg-3 col-md-3 col-sm-8 my-3 mx-3 shadow text-center  text-light" style=" height:170px;border-radius:3px;background:rgb(205, 158, 38);">
                <div style="font-size: 20px;" class="py-3">Total Projects</div>
                <div style="font-size:30px" class="py-3">{{$ocnt[0]->ordr}}</div>
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
                              <h5 class="card-title mb-0">Clients</h5>
                          </div>
                          <div class="row align-items-center mb-2 d-flex">
                              <div class="col-8">
                                  <h2 class="d-flex align-items-center mb-0">
                                      {{-- 3,243 --}}
                                      {{$ccnt[0]->client}}
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
                              <h5 class="card-title mb-0">Freelancers</h5>
                          </div>
                          <div class="row align-items-center mb-2 d-flex">
                              <div class="col-8">
                                  <h2 class="d-flex align-items-center mb-0">
                                      {{-- 15.07k --}}
                                      {{$fcnt[0]->freelancer}}
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
                              <h5 class="card-title mb-0">Projects</h5>
                          </div>
                          <div class="row align-items-center mb-2 d-flex">
                              <div class="col-8">
                                  <h2 class="d-flex align-items-center mb-0">
                                      {{-- 578 --}}
                                      {{-- {{$ordersC[0]->cnt}} --}}
                                      @if ($ocnt[0]->ordr)
                                    {{$ocnt[0]->ordr}}
                                    @else
                                    0
                                    @endif
                                  </h2>
                              </div>
                            
                          </div>
                         
                      </div>
                  </div>
              </div>
              
          </div>
      </div>


        @php
            $users=DB::table('users')->paginate(5);
            
        @endphp
       {{-- <button type="button" class="btn btn-primary my-3" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
        
      </button> --}}
      <button type="button" class="btn btn-primary my-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
        <i class="fa fa-plus" aria-hidden="true"></i> ADD
      </button>
      
      <!-- Modal -->
      <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header bg-dark text-light">
              <h5 class="modal-title" id="exampleModalLabel">Add user</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-window-close" aria-hidden="true"></i></button>
            </div>
            <div class="modal-body">
              <form method="POST" action="/adduser">
                @csrf
                <div class="row">
                  <div class="col-12">
                    <span style="font-weight:bold;" >First name</span>
                    <input type="text" name="firstname" id="" class="form-control">
                    @error('firstname')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                  </div>
                  <div class="col-12">
                    <span style="font-weight:bold;" >Last name</span>
                    <input type="text" name="lastname" id="" class="form-control">
                    @error('lastname')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                  </div>
                  <div class="col-12">
                    <span style="font-weight:bold;" >Username</span>
                    <input type="text" name="username" id="" class="form-control">
                    @error('username')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                  </div>
                  <div class="col-12">
                    <span style="font-weight:bold;" >Email</span>
                    <input type="email" name="email" id="" class="form-control">
                    @error('email')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                  </div>
                  <div class="col-12">
                    <span style="font-weight:bold;" >Contact</span>
                    <input type="number" name="contact" id="" class="form-control">
                    @error('contact')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                  </div>
                  <div class="col-12">
                    <span style="font-weight:bold;" >Password</span>
                    <input type="password" name="password" id="" class="form-control">
                    @error('password')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                  </div>
                  <div class="col-12 my-2">
                    <span style="font-weight:bold;" >Role</span>
                    <select name="role" id="" class="form-control">
                      <option value="F">Freelancer</option>
                      <option value="C">Client</option>

                    </select>
                    @error('role')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                  </div>
                  <div class="col-12 my-2">
                    <span style="font-weight:bold;" >Gender</span>
                    <select name="gender" id="" class="form-control">
                      <option value="M">Male</option>
                      <option value="F">Female</option>

                    </select>
                    @error('gender')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                  </div>
                  <div class="col-12">
                 
                    
                  </div>
                </div>

             
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary">ADD</button>
            </div>
          </form>
          </div>
        </div>
      </div>



      
        {{-- <a href="" class="btn btn-primary text-right my-3"><i class="fa fa-plus" aria-hidden="true"></i> ADD</a> --}}
      <div class="table-responsive">
    <table class="table table-sm" border ="1" id="myTable">
      <thead class="bg-dark text-white text-center">
        <tr>
          <th>User ID</th>
          <th>Name</th>
          <th>Email</th>
          <th>Role</th>
          <th>Joined At</th>
        </tr>
      </thead>
    <tbody style="font-weight:500;font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif">
      @foreach ($users as $i)
          <tr class="text-center">
            <td>{{$i->user_id}}</td>
            @php
                if($i->role=='F')
                {
                  $name=DB::table('freelancers')->where('user_id','=',$i->user_id)->select('firstname','lastname')->first();
                }
                elseif($i->role=='C')
                {
                  $name=DB::table('clients')->where('user_id','=',$i->user_id)->select('firstname','lastname')->first();
                }
            @endphp
            <td>{{$name->firstname}} {{$name->lastname}}</td>
            <td>{{$i->email}}</td>
            @if ($i->role=='F')
            <td>Freelancer</td>
            @else
            <td>Client</td>
            @endif
            
            <td>{{$i->created_at}}</td>
          </tr>
        @endforeach

       
        
    </tbody>
    </table>
      </div>
        

      {{$users->links()}}
        @endif


       @yield('sections')
        
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
        td = tr[i].getElementsByTagName("td")[1];
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
   
</body>

</html>