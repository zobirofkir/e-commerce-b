<!DOCTYPE html>
<html>
<head>
    <title>New Order Notification</title>
</head>
<body>
    <h1>New Order Received</h1>
    <p><strong>Name:</strong> {{ $order['name'] }}</p>
    <p><strong>Email:</strong> {{ $order['email'] }}</p>
    <p><strong>Product Name:</strong> {{ $order['product_name'] }}</p>
    <p><strong>Product Image:</strong> <img src="{{ $order['product_image'] }}" alt="Product Image" /></p>
    <p><strong>Product Price:</strong> {{ $order['product_price'] }}</p>
    <p><strong>Address:</strong> {{ $order['address'] }}</p>
    <p><strong>City:</strong> {{ $order['city'] }}</p>
    <p><strong>Zip Code:</strong> {{ $order['zip_code'] }}</p>
    <p><strong>Phone:</strong> {{ $order['phone'] }}</p>
</body>
</html>
