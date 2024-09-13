<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://js.stripe.com/v3/"></script>
</head>
<body>
    <div class="container mt-5">
        <h1>Secure Payment Form</h1>
        <form id="payment-form">
            @csrf
            <div class="form-group">
                <label for="card-element">Credit or Debit Card</label>
                <div id="card-element" class="form-control">
                    <!-- Stripe Element will be inserted here -->
                </div>
                <div id="card-errors" role="alert" class="text-danger mt-2"></div>
            </div>
            <button id="submit" class="btn btn-primary mt-3">Submit Payment</button>
        </form>
        <div id="payment-status" class="alert mt-4 d-none"></div>
    </div>

    <script>
        var stripe = Stripe('{{ env("STRIPE_KEY") }}'); 
        var elements = stripe.elements();
        var card = elements.create('card');
        card.mount('#card-element');

        var form = document.getElementById('payment-form');
        form.addEventListener('submit', function(event) {
            event.preventDefault();
            
            fetch('/charge', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({})
            }).then(function(result) {
                return result.json();
            }).then(function(data) {
                stripe.confirmCardPayment(data.clientSecret, {
                    payment_method: {
                        card: card,
                    }
                }).then(function(result) {
                    if (result.error) {
                        document.getElementById('card-errors').textContent = result.error.message;
                    } else {
                        document.getElementById('payment-status').classList.remove('d-none', 'alert-danger');
                        document.getElementById('payment-status').classList.add('alert-success');
                        document.getElementById('payment-status').textContent = 'Payment Successful!';
                    }
                });
            });
        });
    </script>
</body>
</html>




