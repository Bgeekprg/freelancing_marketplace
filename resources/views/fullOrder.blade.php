<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <title>fullorder</title>
    @include('bcdn')
    <style>
        *{
        font-family:Verdana, Geneva, Tahoma, sans-serif;
        }
        #bidfrm,#client
        {
            display: none;
        }
        .labels
        {
            font-size: 14px;
        }
        ::placeholder
        {
            font-size: 13px;
        }

    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script>
            
         function check()
        {
        @if(Session('role')=='freelancer')
        $(document).ready(function(){
        $("#show").click(function(){
        $("#bidfrm").slideUp();
        });
        $(".btn1").click(function(){
        $("#bidfrm").slideUp();
        });
        $("#show").click(function(){
        $("#bidfrm").slideDown();
        });
      
        });   

        @else
            @if(Session('user')=="")
            document.getElementById('client').style.display='block';
                document.getElementById('client').innerHTML="please Login First";
                setInterval(() => {
                document.getElementById('client').style.display='none';
                }, 3000);
            @else
                document.getElementById('client').style.display='block';
                document.getElementById('client').innerHTML="you are a client not freelancer";
                setInterval(() => {
                document.getElementById('client').style.display='none';
                }, 3000);
            @endif
        @endif
        }
       function f(){
       var h=document.getElementById('detail').value.length;
       document.getElementById('charcnt').innerHTML=h + '/100 characters allowed'; 
        }
       
        setInterval(() => {
            document.getElementById('alrt').style.display='none';
        }, 5000);
      </script>
</head>
<body class="bg-light" id="bd">

        
        @include('navbar')
        <div class="container">
            @if (Session('existance'))
                <div class="alert alert-danger" id="alrt">
                    {{Session('existance')}}
                {{-- <button type="button" class="close" data-dismiss="alert">X</button> --}}
                </div>
            @endif
        <div class="row">
        
            <div class="col-lg-8 col-sm-12 col-md-8">
            <h5>{{$orderdata[0]->order_title}}</h5>
            </div>
            <div class="col-lg-12 col-sm-12 col-md-8">
                @if ($orderdata[0]->status == 'O' && Session('role')=='freelancer')
                <button  class="btn btn-primary" id="show" onclick="check()">Make Proposal</button>    
              
                @elseif(($orderdata[0]->status =='G' || $orderdata[0]->status =='P') &&  $orderdata[0]->freelancer_id==Session('id') )
                   
                     <form action="/uploadProject/{{$orderdata[0]->order_id}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <span>
                    Deliver Project: <input type="file" name="project_file" id="" class="form-control" multiple>
                    </span>  
                    
                    <input type="submit" value="Send" class="btn btn-success form-control mt-2" style="width: 80px;">
                </form>
                    
                @else
                {{-- <button  class="btn btn-secondary" id="show" disabled>Make Proposal</button>     --}}

                @endif

              
               
                <div class="alert alert-danger shadow text-center"  id="client"></div>
                @if($orderdata[0]->status!='O')
                
                <a href="/chats/{{$orderdata[0]->order_id}}" class="btn btn-primary float-right">Chat <i class='fas fa-comment-alt'></i> </a>
                @endif
            </div>
      </div>
      
      <div class="row" id="bidfrm">
        <form action="/makeProposal/{{$orderdata[0]->order_id}}" method="POST">
        @csrf
        <div class="col-lg-8 col-md-8 col-sm-11 my-2">
        <span class="labels">Project Detail</span>
        <textarea name="bid_desc" class="form-control" id="detail" onkeyup="f()" cols="10" rows="10" placeholder="Proposal Detail" required></textarea>
        <span id="charcnt" class="text-info" style="font-size:10px;"></span>
        </div>
        @if ($orderdata[0]->order_type =='H')
        <div class="col-lg-8 col-md-8 col-sm-11 my-2">
            <span class="labels">Hourly Rate</span>
            <input type="number" class="form-control" name="hrs_rate" id="" placeholder="Your per hour Rate to work on project" required>
        </div>
        <div class="col-lg-8 col-md-8 col-sm-11 my-2">
            <span class="labels">Expected Hours</span>
            <input type="number" class="form-control" name="expected_hrs" id="" placeholder="Hours you will need to finish the project">
        </div>
        @endif
            
        <div class="col-lg-8 col-md-8 col-sm-11 my-2">
            <span class="labels">Full project Rate</span>
            <input type="number" class="form-control" name="full_project_budget" id="" placeholder="Budget in which you will finish full Project">
        </div>
        {{-- <div class="col-lg-8 col-md-8 col-sm-11 my-2">
            <span class="labels">Deposit Required</span>
            <input type="number" class="form-control" name="required_deposit" id="" placeholder="Advance Deposit Amout" required>
        </div> --}}
        
        <div class="col-lg-8 col-md-8 col-sm-11 my-2 text-center">
            <span class="btn btn-primary btn1">Cancel</span>
            <input type="submit" class="btn btn-primary"  name="bid" id="" value="send Proposal">
        </div>
    </form>
      </div>
    </div>
        
        </div>
        
        <div class="container mt-4 w-100" id="content">
            <div class="mb-lg-2 mb-sm-1 text-secondary">
                Posted at | {{date("d-m-y",strtotime($orderdata[0]->created_at))}}
            </div>
            <div class="row justify-content-center w-sm-100">

                <div class="bg-white col-lg-3 col-md-3 col mb-2 mx-sm-2 mt-5 mb-5 shadow text-center" style="height:100px;">
                    <div class="my-2 my-sm-3">
                    $ {{$orderdata[0]->budget}} @if ($orderdata[0]->order_type=='F')
                    
                    @else
                    /Hourly
                    @endif
                </div>
                    <div class="text-secondary" style="font-size: 13px">
                        Budget
                    </div>
                </div>

                <div class="bg-white col-lg-3 col-md-3 col mb-2 mx-sm-2 mt-5 mb-5 shadow text-center" style="height:100px;">
                   <div class="my-2 my-sm-3">
                    @php
                        $cnt=DB::select('select count(order_id) proposals from bids where order_id = ?', [$orderdata[0]->order_id]);
                    @endphp
                    
                    {{$cnt[0]->proposals}}
                   </div>
                    <div class="text-secondary" style="font-size: 13px" >
                        Proposals
                    </div>
                    
                </div>

                <div class="bg-white col-lg-3 col-md-3 col mb-2 mx-sm-2 mt-5 mb-5 shadow text-center" style="height:100px;">
                    
                        @if ($orderdata[0]->status == 'O')
                        <div class="text-success my-2 my-sm-3">
                        <span>Active</span>
                        </div>
                        @elseif($orderdata[0]->status == 'E')
                        <div class="text-danger my-2 my-sm-3">
                        <span>Closed</span>
                        </div>
                        @elseif($orderdata[0]->status == 'EC')
                        <div class="text-danger my-2 my-sm-3">
                        <span>Canceled by Client</span>
                        </div>
                        @elseif($orderdata[0]->status == 'EF')
                        <div class="text-danger my-2 my-sm-3">
                        <span>Canceled by Freelancer</span>
                        </div>
                        @elseif($orderdata[0]->status == 'G')
                        <div class="text-warning my-2 my-sm-3">
                        <span>Given</span>
                        </div>
                        @elseif($orderdata[0]->status == 'C')
                        <div class="text- my-success my-sm-3">
                        <span>Completed</span>
                        </div>
                        @elseif($orderdata[0]->status == 'P')
                        <div class="text-danger my-2 my-sm-3">
                        <span>Payment Pending</span>
                        </div>


                        @endif

                  
                    <div class="text-secondary" style="font-size: 13px" >
                    Status
                    </div>
                </div>

            </div>
            <hr>
            <div class="row justify-content-center">          
            
            <div class="col-12 my-2 mb-3">
                <div><b>Skills Required</b></div>
                
                @php
                $skills = explode(',',$orderdata[0]->skills);
                @endphp
                @foreach ($skills as $item)
                <span class="btn-sm mx-2 my-2 btn" style="background: rgba(198, 193, 193, 0.78)
                ; color:black;">
                        {{$item}}
                </span>
                    @endforeach
            </div>
        <hr>
            <div class="col-12 bg-white">
                <div><b>Project Details</b></div>
                <div style="font-size: 15px;">{{$orderdata[0]->order_desc}}</div>
            </div>
<hr>
            <div class="col-12 bg-white">
                <div><b>Project information</b></div>
                <div><a class="btn-sm btn-primary"  href="/download/orderinfo/{{strval($orderdata[0]->order_info)}}"><span><i class="fa fa-download" aria-hidden="true"></i></span></a></div>
                
            </div>
           

            
         
            
            

            </div>
        </div>
        

        <div class="container" id="bidfrm" style="display:none;">
            <form action="">
                <div class="row">
                    <div class="col">
                        <input type="number" placeholder="enter bid value" class="form-control">
                    </div>
                    <div class="col">
                        
                    </div>
                </div>
            </form>
        </div>

        {{-- client profile --}}
        
        @php
            
            $clientData=DB::select('select count(order_id) odr from orders  where client_id='.$orderdata[0]->client_id);
            $client=DB::select('select * from clients where client_id = ?', [$orderdata[0]->client_id]);
            if($client[0]->state_id)
            {   
                $state=DB::table('states')->where('state_id','=',$client[0]->state_id)->first();
                $country=DB::table('countries')->where('country_id','=',$state->country_id)->first();
            }
            
          
        @endphp
        <div class="container mt-5 bg-white" style="border-radius: 10px;">
            <div class="row"> 
                <div class="col-12" style="font-weight:600;">
                   About the Client 
                    <hr>
                </div>
                <div class="col-12">
                    <div class="table-responsive">
                    <table class="table table-sm">
                        <tbody>
                            <tr>
                                <td>Client Id</td>
                                <td>{{$client[0]->client_id}}</td>
                            </tr>
                            <tr>
                                <td>Name</td>
                                <td>{{$client[0]->firstname}} {{$client[0]->lastname}}</td>
                            </tr>
                            <tr>
                                <td>Total Projects posted</td>
                                <td> {{$clientData[0]->odr}}</td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>{{$client[0]->email}}</td>
                            </tr>
                           
                            <tr>
                                <td>Country</td>
                                @if($client[0]->state_id)
                                <td>{{$country->country_name}}</td>
                                @else
                                <td>Not provided</td>
                                @endif
                                
                            </tr>
                            <tr>
                                <td>member since</td>
                                <td>{{$client[0]->joined_at}}</td>
                            </tr>
                            
                        </tbody>
                    </table>
                </div>
                </div>
               
            </div>
        </div>

        @if ($orderdata[0]->status == 'O')
       
       
        <div class="container my-3">
            <div class="mb-3" style="font-size: 20px;">Proposals</div>
            @php
             $freelancers=DB::select('SELECT bids.created_at as tm,full_project_budget,profile_pic,firstname,lastname,username,freelancers.freelancer_id as fid,email from bids,freelancers WHERE freelancers.freelancer_id=bids.freelancer_id and order_id=?', [$orderdata[0]->order_id]);

            @endphp
            <div class="row bg-white">
                @foreach ($freelancers as $fr)
                <div class="col-12"><span class="text-secondary" style="font-size: 12px;">{{$fr->tm}}</span></div>
                <div class="col-12">
                    <img src="data:image/png;base64,{{chunk_split(base64_encode($fr->profile_pic))}}" class="rounded-circle img-fluid border border-primary" style="width: 40px;height:40px;"  alt="">
                    <span><a href="/freelancer/{{$fr->fid}}" style="text-decoration: none
                    ">{{$fr->username}}</a></span>
                </div>
                <div class="col-12">
                    <span class="text-secondary">{{$fr->firstname}}</span>
                    <span class="text-secondary">{{$fr->lastname}} </span>
                </div>
                <hr>
                <div class="col-12">
                 Budget <span class="text-link">$ {{$fr->full_project_budget}}</span>
                </div>
      
                @endforeach

            </div>
        </div>
        @else

        @endif
        
</body>
</html>

<script>
    document.getElementById('bidBtn').addEventListener('click',function()
    {
      document.getElementById('content').style.zIndex=-1;
      document.getElementById('content').style.display='none';
      document.getElementById('bidfrm').style.display='block';
      document.getElementById('bidfrm').style.zIndex=55;
    })
</script>