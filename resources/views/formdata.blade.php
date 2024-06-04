<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Test Product Update</title>
</head>
<body>
    <form id="productForm" method="post" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div>
            <label for="product_id">Product ID:</label>
            <input type="text" id="product_id" name="product_id" required>
        </div>
        <div>
            <label for="product_name">Product Name:</label>
            <input type="text" id="product_name" name="product_name" required>
        </div>
        <div>
            <label for="status">Status:</label>
            <input type="text" id="status" name="status" required>
        </div>
        <div>
            <label for="note">Note:</label>
            <input type="text" id="note" name="note" >
        </div>
        <div>
            <label for="description">Description:</label>
            <input type="text" id="description" name="description" required>
        </div>
        <div>
            <label for="price">Price:</label>
            <input type="number" id="price" name="price" required>
        </div>
        <div>
            <label for="price">Discount:</label>
            <input type="number" id="discount" name="discount" >
        </div>
        <div>
            <label for="brand_id">Brand ID:</label>
            <input type="text" id="brand_id" name="brand_id" required>
        </div>
        <div>
            <label for="category_id">Category ID:</label>
            <input type="text" id="category_id" name="category_id" required>
        </div>
        <div>
            <label for="image">Product Image:</label>
            <input type="file" id="image" name="image">
        </div>
        <button type="submit">Update Product</button>
    </form>

    <script>
        document.getElementById('productForm').addEventListener('submit', function(event) {
            event.preventDefault();
            var productId = document.getElementById('product_id').value;
            var formAction = "{{ url('/api/product') }}/" + productId;
            this.action = formAction;
            alert('sdadasdasd');
            this.submit();
        });
    </script>
</body>
</html>
