<!DOCTYPE html>
<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<head>
    <title>Product Details</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
        }

        .product-info {
            width: 100%;
        }

        .product-info th,
        .product-info td {
            text-align: left;
            padding: 8px;
        }

        .product-info th {
            background-color: #f2f2f2;
        }

        .image-container img {
            max-width: 100px;
            height: auto;
        }
    </style>
</head>

<body>
    <h1>Product Details</h1>
    <table class="product-info">
        <tr>
            <th>Name:</th>
            <td>{{ $product->name }}</td>
        </tr>
        <tr>
            <th>Price:</th>
            <td>${{ number_format($product->price, 2) }}</td>
        </tr>
        <tr>
            <th>Description:</th>
            <td>{{ $product->description }}</td>
        </tr>
        <tr>
            <th>Feature Image:</th>
            <td class="image-container">
                <img src="{{ public_path('image/feature/'.$product->feature_image) }}" alt="Feature Image">
            </td>
        </tr>
        <tr>
            <th>Gallery Images:</th>
            <td class="image-container">
                @if($product->gallery_images)
                @foreach(json_decode($product->gallery_images, true) as $image)
                <img src="{{ public_path('image/gallery/'.$image) }}" alt="Gallery Image">
                @endforeach
                @endif
            </td>
        </tr>
        <tr>
            <th>Shipping Cost:</th>
            <td>${{ number_format($product->shipping_cost, 2) }}</td>
        </tr>
        <tr>
            <th>Product Status:</th>
            <td>{{ ucfirst($product->product_status) }}</td>
        </tr>
    </table>
</body>

</html>