<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://js.stripe.com/v3/"></script>

</head>
<body>
    <form action="/process-payment" method="POST">
        @csrf
        {{-- <script
          src="https://checkout.stripe.com/checkout.js"
          class="stripe-button"
          data-key="pk_test_51MoL3DSEdH4rFdg1vnEz3LF1BGN9fcb7oNHNaXKNTfkX8Sxkm5j8KyNwuzb2YT4mWgVY7T8HoYUtahJimS0D1h4h00S0RxyF3q"
          data-name="test payment"
          data-description="test"
          data-amount="5000"
          data-currency="usd"
          data-locale="auto">
        </script> --}}
        <button type="submit">checkout</button>
    </form>
        
    
        {{-- {{dd(Session::all())}} --}}
</body>
</html> 



