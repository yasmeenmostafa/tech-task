@extends('products.layout')
@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Edit Product</h1>

    <!-- Form for updating the product -->
    <form method="POST" action="{{ url('products/update/'. $product->id) }}">
        @csrf
        @method('PUT')

        <!-- Product Name -->
        <div class="mb-3">
            <label for="name" class="form-label">Product Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $product->name) }}" >
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Price -->
        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="number" class="form-control" id="price" name="price" value="{{ old('price', $product->price) }}" step="0.01" >
            @error('price')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Quantity -->
        <div class="mb-3">
            <label for="quantity" class="form-label">Quantity</label>
            <input type="number" class="form-control" id="quantity" name="quantity" value="{{ old('quantity', $product->quantity) }}" >
            @error('quantity')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

      

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Update Product</button>
    </form>

    <a href="{{ url('products/all') }}" class="btn btn-secondary mt-3">Back to Products List</a>
</div>
@endsection