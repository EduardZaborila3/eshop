<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Order Created</title>
</head>
<body>
<h1>Congrats, {{ $order->recipient->name }}!</h1>

<p>Your order has been successfully created. Here are the details:</p>

<p>
    <strong>Order ID:</strong> {{ $order->id }}<br>
    <strong>Status:</strong> {{ ucfirst($order->status) }}<br>
    <strong>Order Date:</strong> {{ $order->placed_at }}
</p>

<h3>Products Ordered:</h3>
<table border="1" cellpadding="5" cellspacing="0">
    <thead>
    <tr>
        <th>Product</th>
        <th>Quantity</th>
        <th>Unit Price</th>
        <th>Subtotal</th>
    </tr>
    </thead>
    <tbody>
    @foreach($order->products as $product)
        <tr>
            <td>{{ $product->name }}</td>
            <td>{{ $order->quantity_per_product }}</td>
            <td>{{ number_format($product->price, 2) }} {{ $order->currency }}</td>
            <td>{{ number_format($product->price * $order->quantity_per_product, 2) }} {{ $order->currency }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

<p>
    <strong>Total Items:</strong> {{ $order->total_items }}<br>
    <strong>Total Amount:</strong> {{ number_format($order->total_amount, 2) }} {{ $order->currency }}
</p>

<p>
    <a href="{{ route('orders.show', $order) }}">View Your Order</a>
</p>

<p>Thanks,<br>Eshop</p>
</body>
</html>
