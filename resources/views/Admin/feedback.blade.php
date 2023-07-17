@extends('Admin.dashboard')
@section('sections')
<a href="/feedbackReport" class="btn text-light mb-3" style="background: #0d2ffde0;">Report <i class="fa fa-file-pdf" aria-hidden="true"></i></a>
<a href="/excelfeedback" style="background: #0d2ffde0;" class="btn text-light mb-3">Export <i class="fa fa-file-excel" aria-hidden="true"></i></a>
<div class="text-center" style="display: inline;">
    <h2>FEEDBACKS</h2>    
  </div>
      
<div class="container">
        <div class="row">
            
            @foreach($feddback as $f)
            <div class="col-8 my-3 shadow py-3" style="font-size:17px;">
                @php
                $fr=DB::table('freelancers')->where('freelancer_id',$f->freelancer_id)->first();
                $cl=DB::table('clients')->where('client_id',$f->client_id)->first();
                @endphp
                <div class="text-info">
                   <span class="text-danger">Freelancer:</span> <a style="text-decoration: none;" href="freelancer/{{$fr->freelancer_id}}">{{$fr->username}}</a>
                </div>
                <div class="text-info">
                    <span class="text-danger">Client:</span> <a style="text-decoration: none;" href="client/{{$cl->client_id}}">{{$cl->username}}</a>
                 </div>
                <div><span class="text-success">Feedback: </span>{{str_replace('"','',$f->feedback)}}</div>
               
            </div>
            @endforeach
        </div>
    </div>
    <div class="row">
        {{$feddback->links()}}
    </div>
@endsection