<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Create Order</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Create an Order</h2>
        <form id="order-form" method="POST" action="{{ route('orders.create') }}">
            @csrf
            <div class="mb-3">
                <label for="amount" class="form-label">Order Amount (in USD)</label>
                <input type="number" class="form-control" id="amount" name="amount" min="1" step="0.01" required>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Create Order</button>
            </div>
        </form>
    </div>
</body>
</html>
