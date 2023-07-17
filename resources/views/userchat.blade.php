<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script> --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
        <form  id="chat-form">
        <div class="row">
            
            <div class="col-10">
              
                <textarea name="" id="message-input" class="form-control" cols="10" rows="1" id="messagebox" name="message"></textarea>
               
            </div>
            <div class="col-2">
                <button class="btn btn-primary"  id="btn">Send</button>
            </div>
        
        </div>
    </form>
    </div>
    </div>
  
   
    
   {{Session('user')}}
 
</body>
</html>

@php
    
    if(Session('role')=='client'){
    // $order=DB::table('orders')->where('client_id','=',Session('id'))->first();
    $order=DB::table('orders')->where('order_id','=',$orderid)->first();
    $freelancer=DB::table('freelancers')->select('freelancer_id')->where('freelancer_id','=',$order->freelancer_id)->first();
    $client=DB::table('clients')->select('client_id')->where('client_id','=',$order->client_id)->first();
    $room=DB::select('select * from chatrooms where order_id = ?', [$order->order_id]);
    }
    else {
        // $order=DB::table('orders')->where('freelancer_id','=',Session('id'))->first();
        $order=DB::table('orders')->where('order_id','=',$orderid)->first();
    $freelancer=DB::table('freelancers')->select('freelancer_id')->where('freelancer_id','=',$order->freelancer_id)->first();
    $client=DB::table('clients')->select('client_id')->where('client_id','=',$order->client_id)->first(); 
    $room=DB::select('select * from chatrooms where order_id = ?', [$order->order_id]);
    }
    // $room=DB::table('chatrooms')->where('freelancer_id','='.$freelancer,'and','client_id','=',$client)->get();
@endphp


<script>
    // Intercept form submission
// document.getElementById('chat-form').addEventListener('submit', function(event) {
//   event.preventDefault();
//   sendMessage();
// });
// var chatbox=document.getElementById('chat-form');
// // Send message to server
// function sendMessage() {
//   var messageInput = document.getElementById('message-input');
//   var message = messageInput.value;
//   if(message==' ')
//   {
//     console.log('null value');
//   }
//   messageInput.value = '';
//   var xhr = new XMLHttpRequest();
//   xhr.open('POST', 'http://127.0.0.1:8000/sendmessages');
//   xhr.setRequestHeader('Content-Type', 'application/json;charset=UTF-8');
// //   xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
//   xhr.onload = function() {
//     // Message sent successfully
//     console.log(xhr.responseText);
//   };
//  var data={
//     msg:message
//  };
// //   var contents=JSON.stringify(data);
//   xhr.send(JSON.stringify(data));
//   chatbox.innerHTML+=message;
// }

// Poll server for new messages
// setInterval(function() {
//   var xhr = new XMLHttpRequest();
//   xhr.open('GET', 'http://127.0.0.1:8000/sendmessages',true);
//   xhr.onload = function() {
//     var messages = JSON.parse(xhr.responseText);
//     // Update chat interface with new messages
//   };
//   xhr.send();
// }, 1000); // Poll every second
$('#chat-form').on('submit', function(e) {
    e.preventDefault();

    var recipientId = {{Session('id')}}
    var message = $('#message-input').val();

    $.ajax({
        url: '/sendmessages',
        method: 'GET',
        @if(Session('role')=='client')
        data: {
            room:{{$room[0]->id}},
            sender:'{{Session('user')}}',
            message: message,
            from:{{$order->client_id}},
            to:{{$order->freelancer_id}}
        }
        @elseif(Session('role')=='freelancer')
        data: {
            room:{{$room[0]->id}},
            sender:'{{Session('user')}}',
            message: message,
            to:{{$order->client_id}},
            from:{{$order->freelancer_id}},
        }
        @endif
        ,
        success: function(response) {
            // console.log(JSON.stringify(response));
             $('#chatbox').append('<div style="text-align:right; width:100%; display:block;background:white;"class="my-2 pr-1"><span  style="width:400px;border-radius:2px;background:#bae8a7;" class="text-dark px-1">'+message+'</span></div>');
            $('#message-input').val('');
            $('#message-input').focus('');
            
            // Update the chat interface to show the new message
        },
        error: function(xhr, status, error) {
            console.log(error);
        }
    });
});

function getNewMessages() {
    var recipientId = $('#recipient-id').val();

    $.ajax({
        url: '/getmessages',
        method: 'GET',
        data: {
            room_id:{{$room[0]->id}},
        },
        success: function(response) {
                        // data.forEach(function(element))
            var jsonData=response;
            $('#chatbox').html('');
            
           
            
                    for(var i=0;i<jsonData.length;i++)
                    {

                         if(jsonData[i].sender=='{{Session('user')}}')
                            {
                                $('#chatbox').append('<div style="text-align:right; width:100%; display:block;background:white;"class="my-2 pr-1"><span  style="width:400px;border-radius:2px;background:#bae8a7;" class="text-dark px-1">'+jsonData[i]['message']+'</span></div>');
                            }
                            else
                            {
                                $('#chatbox').append('<div style="text-align:left; width:100%; display:block;background:white;"class="my-2"><span  style="width:400px;border:1px solid grey;border-radius:2px;background:#5e6064" class="text-white px-1">'+jsonData[i]['message']+'</span></div>');
                            }

                    }
                    // console.log(response);

            
     


            
        },
        error: function(error) {
            // Handle message receive error
        }
    });
}

setInterval(getNewMessages, 2000);
</script>
