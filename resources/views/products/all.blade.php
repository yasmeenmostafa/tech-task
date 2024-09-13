@extends('products.layout')
@section('content')
<div class="container mt-5">
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="btn btn-danger">Logout</button>
    </form>
    <h1 class="mb-4">All Products</h1>
    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Category ID</th>
                <th></th>
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
                <td><a href="{{ url('products/edit/'. $product->id) }}" class="btn btn-warning">Edit Product</a>

                    <!-- Form to delete the product -->
                    <form method="POST" action="{{ url('products/delete/', $product->id) }}" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this product?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete Product</button>
                    </form></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection