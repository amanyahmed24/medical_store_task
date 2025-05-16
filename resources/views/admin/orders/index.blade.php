@extends('layouts.admin')

@section('content')
    <h1>Orders List</h1>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Customer Name</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Total Price</th>
                <th>Products</th>
            </tr>
        </thead>
        <tbody>
           
            @foreach ($orders as $order)
                <tr>
                    <td>
                        <a href="{{ route('admin.orders.show', $order->id) }}">
                            {{ $order->id }}
                        </a>
                    </td>
                    <td>{{ $order->customer_name }}</td>
                    <td>{{ $order->phone }}</td>
                    <td>{{ $order->address }}</td>
                    <td>{{ number_format($order->total_price, 2) }} EGP</td>
                    <td>
                        <ul>
                            @foreach ($order->items as $item)
                                <li>{{ $item->product->name }} - Quantity: {{ $item->quantity }} - Price:
                                    {{ number_format($item->price, 2) }}</li>
                            @endforeach
                        </ul>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $orders->links() }}
@endsection
