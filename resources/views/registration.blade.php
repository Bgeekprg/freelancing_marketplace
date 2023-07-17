<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>registration</title>
    
    {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script> --}}
    @include('bcdn')
    <style>
        *
        {
            padding: 0px;
            margin: 0px;
            box-sizing: border-box;
        }
      #freelancer,#client
      {
        font-family:Verdana, Geneva, Tahoma, sans-serif;
        cursor: pointer;
        border:1px solid lightgray;
        background: #fff;
        border-radius: 2px;
                
      }

      #freelancer,#client span{
        font-size: 20px;
      }
     /* input[type="radio"] */
     #cs,#fs
     {
        display: none;
     }
     input[type="text"],input[type="password"],input[type="email"],input[type="number"]
     {
        border:1px solid #28a745;
     }
     select
     {
        border:1px solid #28a745;
        border-radius: 4px;
        outline: none;
     }
     
     /* .container-fluid
     {
        border:2px solid lightgrey;
     } */
     /* #register
     {
        border:1px solid lightgrey;
     } */
     
    </style>
</head>
<body>
    @include('navbar')
    <div class="container-fluid w-auto" >
     
     <form action="registrations" method="POST" enctype="multipart/form-data" class="bg-white shadow-lg">
     @csrf
     <div class="col-12 text-center">
        <img src="logo.jpeg" alt="" height="60" width="60">
        <span class="text-secondary bg-white" style="font-size: 25px;font-weight:bold;">Registration</span>
     </div>
     <div class="row justify-content-center">
     {{-- <span id="ch" class="alert-danger"></span> --}}
    <div class="col-lg-4 col-sm-6 text-center mt-4 mt-sm-3 mx-lg-2 py-lg-3 py-sm-1 bg-light" style="overflow:hidden;border-radius:10px;" id="freelancer">
        <input type="radio" name="rselection" id="fs" value="freelancer" class="form-control"><span class="px-3">Freelancer</span>
    </div>
    <div class="col-lg-4 col-sm-6 text-center mt-4 mt-sm-3 mx-lg-2 py-lg-3 py-sm-1 bg-light" style="overflow:hidden;border-radius:10px;" id="client">    
        <input type="radio" name="rselection" id="cs" value="client" class="form-control"><span class="px-3">Client</span>
    </div class="col-12 text-center">
    <span class="text-danger text-center">
        @error('rselection')
            please select your Role
        @enderror
    </span>
    </div>

        <div class="container row mt-3 ml-lg-2 pl-lg-5 pl-sm-5 ml-lg-5 justify-content-center mw-md-100" id="register">
            <div class="col-lg-4 col-sm-12 my-2 form-group">
             <span>First name</span>
             <input type="text" name="firstname"  class="form-control" placeholder="First name" value="{{old('firstname')}}">
             <span class="text-danger">
                @error('firstname')
                    {{$message}}
                @enderror
            </span>
            </div>
            <div class="col-lg-4 col-sm-12 my-2 form-group">
                <span>Last name</span>
                <input type="text" name="lastname" class="form-control" placeholder="Last name" value="{{old('lastname')}}">
                <span class="text-danger">
                    @error('lastname')
                        {{$message}}
                    @enderror
                </span>
            </div>
            <div class="col-lg-8 col-sm-12 my-2 form-group">
                <span>Username</span>
                 <input type="text" name="username" class="form-control" placeholder="User name" value="{{old('username')}}">
                 <span class="text-danger">
                    @error('username')
                        {{$message}}
                    @enderror
                </span>
            </div>
            <div class="col-lg-8 col-sm-12 my-2">
               <span>Gender</span>

                <select class="border border-success form-control" name="gender">
                    
                    <option value="M">Male</option>
                    <option value="F">Female</option>
                    <option value="O">Other</option>

                </select>
             </div>
            <div class="col-lg-8 col-sm-12 my-2 form-group">
                <span>Email</span>
                <input type="text" name="email"  class="form-control" placeholder="Email" value="{{old('email')}}">
                <span class="text-danger">
                    @error('email')
                        {{$message}}
                    @enderror
                </span>
            </div>
            <div class="col-lg-8 col-sm-12 my-2 form-group">
                <span>Contact</span>
                <input type="number" name="contact"  class="form-control" placeholder="Contact no" maxlength="10" minlength="10" value="{{old('contact')}}">
                <span class="text-danger">
                    @error('contact')
                        {{$message}}
                    @enderror
                </span>
            </div>
            <div class="col-lg-8 col-sm-12 my-2 form-group">
                <span>Password</span>
                <input type="password" name="password"  class="form-control" placeholder="Password">
                <span class="text-danger">
                    @error('password')
                        {{$message}}
                    @enderror
                </span>
            </div>
            <div class="col-lg-8 col-sm-12 my-2 form-group">
                <span>Confirm Passsword</span>
                <input type="password" name="cPassword"  class="form-control" placeholder="Confirm Password">
                <span class="text-danger">
                    @error('cPassword')
                        {{$message}}
                    @enderror
                </span>
            </div>
            
            <div class="col-lg-8 col-sm-12 my-2 form-group">
                <input type="checkbox" name="termCondition"  >
                <a href="" style="text-decoration:none;">Accept term & conditions</a>
            </div>
            <div class="col-lg-8 col-sm-12 my-2">
                <input type="submit"  class="form-control btn text-white" id="bn" style="background: rgb(112, 48, 202)" value="Register">
            </div>
           
           
            
        </div>
        </form>
</div>
</body>
</html>

<script>
    let freelancer=document.getElementById('freelancer');
    let client=document.getElementById('client');
    freelancer.addEventListener('click', function()
    {
    
            document.getElementById('fs').checked="true";
          
            client.style.boxShadow="0px 0px 0px";    
            freelancer.style.boxShadow="2px 1px 3px #00d20000";
            freelancer.style.border="2px solid green";
            client.style.border="1px solid lightgrey";
        
    });
    client.addEventListener('click', function()
    {
    
            document.getElementById('cs').checked="true";
            freelancer.style.boxShadow="0px 0px 0px";
            client.style.boxShadow="2px 1px 3px #00d20000";
            client.style.border="2px solid green";
            freelancer.style.border="1px solid lightgrey";
            
        
    });
    // document.getElementById("bn").addEventListener('click',function(){
    //  if(document.getElementById("fs").checked == "true" && document.getElementById("cs").checked == "false" && document.getElementById('bn').click == "true")
    // {
    //     document.getElementByName("rselection").value="{{old('rselection')}}"
    // }
    //     else{
    //     document.getElementById('ch').innerHTML="please select any one"; 
    // }
    // });
    
    
    

</script>



