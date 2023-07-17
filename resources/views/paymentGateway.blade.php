@include('bcdn')
  <div class="container mt-5">
  <form action="/afterPayment/{{$order_id}}/{{$amount}}/{{$delivery_id}}" method="POST">
    @csrf
    <div class="row justify-content-center border">
        <div class="col-12 bg-light text-center my-2">
            <span class="mx-5"><input required type="radio" value="Debit card" name="payment_type" id="">Debit Card</span><span class="mx-5"><input type="radio" required value="Credit card" name="payment_type" id="">Credit Card</span>
        </div>
        <div class="col-10 my-3">
            <input type="number" maxlength="12" minlength="12" name="card_no" class="form-control" id="" placeholder="Card Number" required>
        </div>
        <div class="col-5 my-3">
            <input type="text" name="expiry_date" class="form-control" id="" placeholder="expiry Date:mm/yy" required>
        </div>
        <div class="col-5 my-3">
            <input type="number" maxlength="3" name="cvv" class="form-control" id="" placeholder="CVV" required>
        </div>
        <div class="col-5">
          <div class="btn btn-secondary  form-control">Amount :INR {{$amount}}</div>
        </div>
        <div class="col-5">
            <input type="submit" value="Pay" class="form-control btn btn-success">
        </div>
    </div>
  </form>
</div>

