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
    if(Session('role')=='Admin')
    {
        $project=DB::table('orders')
        ->leftjoin('clients','orders.client_id','=','clients.client_id')
        ->leftjoin('freelancers','orders.freelancer_id','=','freelancers.freelancer_id')
        ->select('orders.*','clients.firstname as cfname','clients.lastname as clname','freelancers.firstname as ffname','freelancers.lastname as flname','freelancers.freelancer_id as freelancer_id')
        ->get();
    }
    else if(Session('role')=='client')
    {
        $clientprojects=DB::select('select orders.*,firstname,lastname from orders left join freelancers on freelancers.freelancer_id=orders.freelancer_id where client_id = ?', [Session('id')]);
    }        
    @endphp
    @if (Session('role')=='Admin')
    <div class="table-responsive">
        <table class="table table-sm border" border="1">
            <thead class="bg-dark text-white text-center">
                <tr class="bg-dark text-light">
                  <th>Order ID</th>
                  <th>Order_title</th>
                  <th>Client</th>
                  <th>Freelancer</th>
                  <th>Date</th>
                  <th>Status</th>
                  
                </tr>
              </thead>
            <tbody style="font-weight:500;font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif">
              @foreach ($project as $i)
                  <tr>
                    <td class="text-center">{{$i->order_id}}</td>
                    <td>{{$i->order_title}}</td>
                    <td class="text-center"><a href="/client/{{$i->client_id}}" style="text-decoration: none;">{{$i->cfname}} {{$i->clname}}</a></td>
                    @if ($i->ffname==Null && $i->flname == Null)
                    <td class="text-warning text-center">Not Given</td>
                    @else
                    <td class="text-center"><a href="freelancer/{{$i->freelancer_id}}" style="text-decoration: none" class="text-dark">{{$i->ffname}} {{$i->flname}}</a></td>
                    @endif
                    <td class="text-center">{{$i->updated_at}}</td>
                    @if ($i->status=="O")
                    <td class="text-center text-primary">Open</td>
                    @elseif($i->status=="G")
                    <td class="text-center text-success">Given</td>
                    @elseif($i->status=="P")
                    <td class="text-center text-danger">Pending</td>
                    @elseif($i->status=="C")
                    <td class="text-center text-success">Completed</td>
                    @elseif($i->status=="E")
                    <td class="text-center text-danger">Canceled</td>
                    @elseif($i->status=="EF")
                    <td class="text-center text-danger">Canceled by freelancer</td>
                    @elseif($i->status=="EC")
                    <td class="text-center text-danger">Canceled by Client</td>
                    @endif
                  </tr>
              @endforeach
            </tbody>
        
        </table>
        </div>     
    
        @elseif(Session('role')=='client')
        <div class="table-responsive">
            <table class="table" style="font-size:15px;font-weight:600;" id="myTable" border="1">
                <thead>
                    <tr class="my-2">
                      <th>Title</th>
                      <th>Posted at</th>
                      <th>Freelancer</th>
                      <th>Budget</th>
                      <th class="text-center">Accepted-price</th>
                      <th>Status</th>
                     
                    </tr>
                  </thead>
                  <tbody>
                    @php
                        
                    @endphp
                    @foreach ($clientprojects as $i)
                        <tr class="my-2">
                            <td>{{$i->order_title}}</td>
                            <td>{{date('d/m/y',strtotime($i->created_at))}}, {{date('H:i:s',strtotime($i->created_at))}}</td>
                            {{-- <td></td> --}}
                            <td><a href="/freelancer/{{$i->freelancer_id}}" style="text-decoration: none;">{{$i->firstname}} {{$i->lastname}}</a></td>
                            <td>{{$i->budget}}</td>
                            <td class="text-center">{{$i->final_price}}</td>
                            @if ($i->status=='O')
                            <td class="text-primary">Open</td>    
                            @elseif($i->status=='p')
                            <td class="text-danger">Pending</td>    
                            @elseif($i->status=='E')
                            <td class="text-danger">Closed</td> 
                            @elseif($i->status=='EF')
                            <td class="text-danger">Canceled by Freelancer</td> 
                            @elseif($i->status=='EC')
                            <td class="text-danger">Canceled by Client</td> 
                            @elseif($i->status=='C')
                            <td class="text-success">Completed</td>    
                            @elseif($i->status=='G')
                            <td class="text-warning">Given</td>    
                            @elseif($i->status=='P')
                            <td class="text-danger">Payment Pending</td>    
                            @endif
                           
                        </tr>
                        
                       
                    @endforeach
        
                </tbody>
                
            </table>
          </div>
        
          {{-- client end --}}


          @elseif(Session('role')=='freelancer')
          <div class="table-responsive">
            <table class="table table-sm " id="myTable" border="1">
                <thead>
                    @php
                      
                        $Order=DB::select('SELECT * from clients , orders WHERE clients.client_id=orders.client_id and freelancer_id=? and orders.status !=?', [Session('id'),'O']);
                        
        
                    @endphp
                    <tr class="text-center">
                        <th>Title</th>
                        <th>Client Name</th>
                        <th>Price</th>
                        <th>Order Type</th>
                       
                        <th>Status</th>
                       
                    </tr>
                </thead>
                <tbody>
                   @foreach ($Order as $o)
                       <tr style="font-weight:600;">
                        <td>{{$o->order_title}}</td>
                        <td class="text-center"><a href="/client/{{$o->client_id}}" style="text-decoration: none;">{{$o->firstname}}  {{$o->lastname}}</a></td>
                        
                        <td class="text-center">$ {{$o->final_price}}</td>    
                        
                        @if ($o->order_type=='H')
                            <td class="text-center">Hourly</td>
                        @else
                            <td class="text-center">Fixed</td>
                        @endif
                       
        
                        
                        @if ($o->status=='C')
                        <td class="text-center text-success">Complete</td>
                        @elseif($o->status=='G')
                        <td class="text-center text-info">Pending</td>     
                        @elseif($o->status=='P')     
                        <td class="text-center text-danger">Payment Pending</td>
                        @elseif($o->status=='EF')     
                        <td class="text-center text-danger">Canceled by freelancer</td>
                        @elseif($o->status=='EC')     
                        <td class="text-center text-danger">Canceled by Client</td>
                        
                        @endif
                       
                       
                       
                       
                   @endforeach
                </tbody>
              
            </table>
          </div>
        
    @endif
   
</body>
</html>