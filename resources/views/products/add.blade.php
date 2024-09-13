<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Product</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Add New Product</h1>

        <!-- Form for adding a new product -->
        <form id="addProductForm">
            @csrf

            <!-- Product Name -->
            <div class="mb-3">
                <label for="name" class="form-label">Product Name</label>
                <input type="text" class="form-control" id="name" name="name" >
                <div class="invalid-feedback" id="nameError"></div>
            </div>

            <!-- Price -->
            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input  class="form-control" id="price" name="price" step="0.01" >
                <div class="invalid-feedback" id="priceError"></div>
            </div>

            <!-- Quantity -->
            <div class="mb-3">
                <label for="quantity" class="form-label">Quantity</label>
                <input type="number" class="form-control" id="quantity" name="quantity" >
                <div class="invalid-feedback" id="quantityError"></div>
            </div>

            <!-- Category ID -->
            <div class="mb-3">
                <label for="category_id" class="form-label">Category ID</label>
                <input type="number" class="form-control" id="category_id" name="category_id" >
                <div class="invalid-feedback" id="categoryIdError"></div>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Add Product</button>
        </form>

        <div id="successMessage" class="alert alert-success mt-3" style="display: none;"></div>
    </div>

    <!-- jQuery and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- AJAX Script -->
    <script>
        $(document).ready(function() {
            $('#addProductForm').on('submit', function(event) {
                event.preventDefault();

                // Clear previous errors and messages
                $('.invalid-feedback').text('');
                $('#successMessage').hide();

                $.ajax({
                    url: "{{ url('products/create') }}",
                    method: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        $('#successMessage').text('Product added successfully!').show();
                        $('#addProductForm')[0].reset();
                    },
                    error: function(xhr) {
                        if (xhr.responseJSON.errors) {
                            $.each(xhr.responseJSON.errors, function(key, error) {
                                $('#' + key + 'Error').text(error[0]);
                                $('#' + key).addClass('is-invalid');
                            });
                        }
                    }
                });
            });
        });
    </script>
</body>
</html>
