<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>chat</title>
</head>
<body>
    <div id="chat"></div>
    <div>
        <input type="text" name="" id="input">
        <button  onclick="send()">send</button>
    </div>
    <script>
        var conn = new WebSocket('ws://localhost:8080/');
        conn.onopen()=function(e)
        {

            console.log('connection');
        }
        conn.onmessage()=function(e)
        {
            console.log(e.data);
            var chat=document.getElementById('chat');
            chat.innerHTML+='<p>'+e.data+'</p>';

        }
        function send()
        {
            var input=document.getElementById('input');
            var message=input.value;
            input.value="";
            conn.send(message);
        }
        
    </script>
    
</body>
</html>