@php
    use App\Helpers\CurrencyHelper;
    use App\Helpers\ShippingHelper;
        $order = $order->load('customer.addresses');
        $shipping = $order->customer->addresses->first();
        $delivery_cost = ShippingHelper::getShippingFee($order->delivery_method);
        $delivery_method = ShippingHelper::getShippingLabel($order->delivery_method);
        $delivery_location = ShippingHelper::getShippingLocation($order->delivery_method);
        $sub_total = ($order->total_price) / 100;
        $total_due = CurrencyHelper::formatWithCurrencyAndSign($sub_total + $delivery_cost);

@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
    <style>
        /* Reset some default styles */
        body, h1, p {
            margin: 0;
            padding: 0;
        }

        /* Container */
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            font-family: Arial, sans-serif;
        }

        /* Header */
        .header {
            background-color: #39f;
            color: #fff;
            text-align: center;
            padding: 20px;
        }

        /* Logo */
        .logo {
            display: block;
            margin: 0 auto;
            width: 150px; /* Adjust the width as needed */
        }

        /* Site Name */
        .site-name {
            margin-top: 10px;
            font-size: 24px; /* Adjust the font size as needed */
        }

        /* Order Details */
        .order-details {
            /*background-color: #39f;*/
            padding: 20px;
        }

        /* Table */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #007bff;
            color: #fff;
        }

        /* Footer */
        .footer {
            text-align: center;
            padding: 20px;
            /*background-color: #39f;*/
        }

        /* Button */
        .track-button {
            margin-top: 10px;
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
{{--        <img class="logo" src="your-site-logo.png" alt="TechsTronix Logo">--}}
        <div class="site-name">TechsTronix</div>
        <h1>Order Confirmation</h1>
    </div>
    <div class="order-details">
        <p>Dear {{ $order->customer->first_name }},</p>
        <p>Your Order Tracking Number is: <strong>{{ $order->order_number }}</strong></p>
        <p>Your order has been confirmed. Below are the details of your order:</p>
        <table>
            <thead>
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total</th>
            </tr>
            </thead>
            <tbody>
            @foreach($order->orderItems as $item)
            <tr>
                <td>{{ $item->product->name }}</td>
                <td>{{ $item->quantity }}</td>
                <td>{{ CurrencyHelper::formatWithCurrencyAndSign($item->unit_price/100) }}</td>
                <td>{{ CurrencyHelper::formatWithCurrencyAndSign(($item->unit_price * $item->quantity)/100) }}</td>
            </tr>

            @endforeach
            </tbody>
            <tfoot>
            <tr>
                <td colspan="3"><strong>Sub Total:</strong></td>
                <td><strong>{{ CurrencyHelper::formatWithCurrencyAndSign($order->total_price/100) }}</strong></td>
            </tr>
            <tr style="border-bottom: 1px solid rgb(147,145,145)">
                <td colspan="3"><strong>Delivery charge:</strong></td>
                <td><strong>{{ CurrencyHelper::formatWithCurrencyAndSign($delivery_cost) }}</strong></td>
            </tr>

            <tr style="border-bottom: 1px solid rgb(128,128,128)">
                <td colspan="3"><strong>Total:</strong></td>
                <td><strong>{{ $total_due }}</strong></td>
            </tr>

            <tr style="margin-top: 10px;">
                <td colspan="3">Delivery Method:</td>
                <td>{{ $delivery_method }}</td>
            </tr>
            <tr>
                <td colspan="3">Delivery Location:</td>
                <td>{{ $delivery_location }}</td>
            </tr>
            </tfoot>
        </table>
        <p>Thank you for shopping with us!</p>
    </div>
    <div class="footer">
        <p>If you have any questions, please contact our customer support at <a href="mailto:techstronix@softscholar.com">techstronix@softscholar.com</a></p>
        <a class="track-button" href="{{ config('app.url') }}/account"><span style="color: white">Track Your Order</span></a>
    </div>
</div>
</body>
</html>
