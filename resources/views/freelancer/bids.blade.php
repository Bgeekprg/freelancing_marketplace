@extends('freelancer.dashboard')
@section('content')
    
<div class="text-center" style="display: inline;">
    <h2>BIDS</h2>
    <hr>
</div>
<div class="container">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/js/bootstrap.min.js" integrity="sha512-1/RvZTcCDEUjY/CypiMz+iqqtaoQfAITmNSJY17Myp4Ms5mdxPS5UV7iOfdZoxcGhzFbOm6sntTKJppjvuhg4g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    {{-- <a href="/rejectallbid/{{$bids[0]->order_id}}" class="btn btn-danger">Reject All</a> --}}
    <div class="row">
        @foreach ($bids as $bd)
            <div class="col-lg-9 my-3 col-md-8 col-md-12 shadow bg-white" style="font-size:15px;font-weight:500;border-radius:5px;">
            @php
                $fr=DB::select('select * from freelancers where freelancer_id = ?', [$bd->freelancer_id])
            @endphp
            <div class="my-2">
                {{-- <a href="/freelancer/{{$fr[0]->freelancer_id}}" style="text-decoration:none;"> --}}
                <a href="/viewOrder/{{$bd->order_id}}" class="btn btn-info" style="text-decoration: none;">View Order</a>
                {{-- <img src="data:image/png;base64,{{chunk_split(base64_encode($fr[0]->profile_pic))}}" class="rounded-circle img-fluid border border-primary" style="width: 40px;height:40px;"  alt=""> --}}
                {{-- <span class="text-secondary">{{$fr[0]->username}}</span> --}}
                </a>
                <span class="bg-white text-secondary mx-5 mx-sm-0" style="font-size:15px;font-weight:500;">
                {{$bd->created_at}} 
                </span>
                @if ($bd->status==1 )
               
                 @elseif($bd->mark_as_rejected==1)
                 @else
                <button id="lnks"  class="btn btn-warning float-right" data-bs-toggle="modal" data-bs-target="#ids{{$bd->bid_id}}">
                    
                <i class="fa fa-edit" aria-hidden="true"></i>
                </button>

                @endif
           
              

                <div class="modal fade" id="ids{{$bd->bid_id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                           
                            <form action="/updatebid/{{$bd->bid_id}}" method="POST" id="frm">
                                @csrf
                          {{-- <h5 class="modal-title" id="staticBackdropLabel">{{$bd->bid_id}}</h5> --}}
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fa fa-window-close" aria-hidden="true"></i>
                
                          </button>
                        </div>
                        <div class="modal-body">
                        
                   
                        <div>
                          
                            <textarea name="bid_desc" class="form-control my-1" id="" cols="5" rows="5" placeholder="chnage description">{{$bd->bid_desc}}</textarea>
                            <input type="number" name="full_project_budget" class="form-control my-1" id="" value="{{$bd->full_project_budget}}" placeholder="Budget">
                           
                            {{-- <input type="text" name="required_deposit" class="form-control my-1" id="" placeholder="required deposit" value="{{$bd->required_deposit}}"> --}}
                        </div>
                        
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                          <input type="submit" class="btn btn-primary" value="save">
                        </form>
                        </div>
                      </div>
                    </div>
                  </div>
               
            </div>
           
            <div class="bg-white">
                <span>Proposal Detail</span>
                <textarea name="" class="form-control" id="" cols="20" rows="10" readonly style="height:80px;">{{$bd->bid_desc}}</textarea>
            </div>
            <div class="bg-white" style="font-size:15px;font-weight:500;">
                <span>Budget</span>
                <input type="text" value="{{$bd->full_project_budget}} " class="form-control" readonly>
                
            </div>
            {{-- <div class="bg-white" style="font-size:15px;font-weight:500;"> --}}
                {{-- <span>Advance deposit</span> --}}
                {{-- <input type="text" value="{{$bd->required_deposit}}" class="form-control" readonly> --}}
                
            {{-- </div> --}}
            @php
                $order=DB::table('orders')->where('order_id','=',$bd->order_id)->first();
            @endphp
            @if($order->status!='O' && $bd->status!=1)
            <div class="my-2">
                <button class="btn btn-danger w-50">Order no longer Available</button>
            </div>
            @else
            @if ($bd->status==1 )
                <button class="btn btn-success w-50">Accepted</button>
            @elseif($bd->mark_as_rejected==1)
            <div class="my-2">
                <button class="btn btn-danger w-50">Rejected</button>
            </div>
            
            @else
            <button class="btn btn-primary w-50">Pending</button>
            @endif
            @endif
           
           
        </div>
        @endforeach
       

    </div>
</div>
@include('cacheclean')
@endsection