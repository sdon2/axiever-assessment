<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Order Details</title>
    <style>
        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th {
            border: 1px solid #222222;
            padding: 8px;
            text-align: left;
        }

        .table td {
            border: 1px solid #222222;
            padding: 8px;
            text-align: center;
        }

        .products-table th,
        .products-table td {
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2 style="text-align: center;">Sales Order Details - {{ $salesOrder->id }}</h2>
        <table class="table">
            <tr>
                <th>Customer Name</th>
                <td>{{ $salesOrder->customer_name }}</td>
            </tr>
            <tr>
                <th>Order Date</th>
                <td>{{ Carbon\Carbon::parse($salesOrder->order_date)->format('d/m/Y') }}</td>
            </tr>
            <tr>
                <th>Order Status</th>
                <td>{{ ucfirst($salesOrder->status) }}</td>
            </tr>
        </table>
        <h3>Products:</h3>
        <table class="table products-table" style="margin-top: 20px">
            <tr>
                <th>#</th>
                <th>Product</th>
                <th>Quantity</th>
                <th>Price</th>
            </tr>
            @foreach ($salesOrder['products'] as $index => $orderProduct)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $orderProduct->product->name }}</td>
                    <td>{{ $orderProduct->quantity }}
                    <td>{{ $orderProduct->price }}</td>
                </tr>
            @endforeach
            <tr>
                <th colspan="3">Total Amount</th>
                <td>{{ $salesOrder->total_amount }}</td>
            </tr>
        </table>
    </div>
</body>

</html>
