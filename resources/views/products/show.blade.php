@extends('products.layout')
@section('content')
<div class="container mt-5">
    <h1 class="mb-4">{{ $product->name }} Details</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Product Information</h5>
            <p class="card-text"><strong>ID:</strong> {{ $product->id }}</p>
            <p class="card-text"><strong>Name:</strong> {{ $product->name }}</p>
            <p class="card-text"><strong>Price:</strong> ${{ number_format($product->price, 2) }}</p>
            <p class="card-text"><strong>Quantity:</strong> {{ $product->quantity }}</p>
            <p class="card-text"><strong>Category ID:</strong> {{ $product->category_id }}</p>

            <a href="/products/all" class="btn btn-primary">Back to Products List</a>
        </div>
    </div>
</div>
@endsection