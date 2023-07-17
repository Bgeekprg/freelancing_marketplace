<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script> --}}
    @include('bcdn')
</head>
<body class="bg-light">
    @include('navbar')
    <div class="container bg-white shadow my-3 pb-2" style="width: 600px;height:550px;">
        <div class="container-fluid text-center bg-primary text-white py-2">CHAT</div>
        <div style="height:80%;overflow-y:scroll;" id="chatbox">
                      
        
        </div>
        <hr>
    <div class="container" style="height:20%;width:100%">
       
        <div class="row">
            <div class="col-10">
                {{-- <input type="text" name="" id="messagebox" class="form-control"> --}}
                <textarea name="" id="messagebox" class="form-control" cols="10" rows="1" id="messagebox"></textarea>
               
            </div>
            <div class="col-2">
                <button class="btn btn-primary" onclick="fun()" id="btn">Send</button>
            </div>
        </div>
    </div>
    </div>
    @php
        $arr=[];
        $arr[Session('user')]='bhavesh';
        $arr['jay']='jay';
        // print_r($arr);
    @endphp
   
    {{count($arr)}}  
   {{Session('user')}}
   @php
    

    
   @endphp
</body>
</html>

@php
    if(Session('role')=='client'){
    $order=DB::table('orders')->where('client_id','=',Session('id'))->first();
    $freelancer=DB::table('freelancers')->select('username')->where('freelancer_id','=',$order->freelancer_id)->first();
    $client=DB::table('clients')->select('username')->where('client_id','=',$order->client_id)->first();
    
    // dd($order);
    }
    else {
        $order=DB::table('orders')->where('freelancer_id','=',Session('id'))->first();
    $freelancer=DB::table('freelancers')->select('username')->where('freelancer_id','=',$order->freelancer_id)->first();
    $client=DB::table('clients')->select('username')->where('client_id','=',$order->client_id)->first(); 
    // dd($order);
    }

@endphp
<script>
    var conn = new WebSocket('ws://localhost:8090');
    conn.onopen=function(e)
    {
        console.log('established');
    }
    conn.onmessage=function(e)
    {
      
        var text=e.data;
        console.log(e);
        var message=text.replace('"','');
        var data='<div style="text-align:left; width:100%; display:block;background:white;"class="my-2"><span  style="width:400px;border:1px solid grey;border-radius:2px;background:#5e6064" class="text-white px-1">'+message.replace('"','')+'</span></div>';

        $(document).ready(function(){
            $('#chatbox').append(data);
        });
      
    }
    // function hasorder(channel)
    // {
    //     conn.send(JSON.stringify(
    //         {
    //             command:'hasOrder',
    //             channel:channel;
    //         }
    //     ));
    // }
   
    // $(document).ready(function(){
    // $("#btn").click(function(){
    function fun(){
    var data='<div style="text-align:right; width:100%; display:block;background:white;"class="my-2 pr-1"><span  style="width:400px;border-radius:2px;background:#bae8a7;" class="text-dark px-1">'+$('#messagebox').val()+'</span></div>';
    // var msg=$('#messagebox').val();
    var msg=document.querySelector('#messagebox').value;
     
    

    @if(Session('role')=='client')
    var content={
            msg:msg,
            to:"{{$freelancer->username}}",
            from:"{{$client->username}}",
            
            };  
    @elseif(Session('role')=='freelancer') 
    var content={
            msg:msg,
            to:'{{$client->username}}',
            from:'{{$freelancer->username}}',
            
            };  
    @endif
    // conn.send(content);
    console.log(content);
    // $('#chatbox').append(data);
    var chatbox=document.querySelector('#chatbox');
    chatbox.innerHTML+=data;
    console.log(conn);
    conn.send(JSON.stringify(content));
    
    // conn.send(JSON.stringify(datas));
    // $('#messagebox').val('');
    chatbox.value=" ";
    }
//   });
  
// });
   
// conn.onmessage=function(e)
//     {
//         console.log('disconnected');
//     }
    conn.onerror=function(e)
    {
        console.log('error');
    }


</script>
