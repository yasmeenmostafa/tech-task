@extends('products.layout')
@section('content')
<div class="container mt-5">
    <h1 class="mb-4">All Products</h1>
    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Category ID</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->name }}</td>
                <td>${{ number_format($product->price, 2) }}</td>
                <td>{{ $product->quantity }}</td>
                <td>{{ $product->category_id }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection