@extends('layouts.admin')

@section('content')
    <h1>Order Details #{{ $order->id }}</h1>

    <div class="mb-4">
        <h4>Customer Information</h4>
        <p><strong>Name:</strong> {{ $order->customer_name }}</p>
        <p><strong>Phone:</strong> {{ $order->phone }}</p>
        <p><strong>Address:</strong> {{ $order->address }}</p>
    </div>

    <div class="mb-4">
        <h4>Order Items</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Price per item</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->items as $item)
                    <tr>
                        <td>{{ $item->product->name }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ number_format($item->price, 2) }} EGP</td>
                        <td>{{ number_format($item->price * $item->quantity, 2) }} EGP</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3" class="text-end">Total Price:</th>
                    <th>{{ number_format($order->total_price, 2) }}EGP</th>
                </tr>
            </tfoot>
        </table>
    </div>

    <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">Back to Orders</a>
@endsection
