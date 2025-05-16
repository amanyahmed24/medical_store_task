@extends('layouts.app')

@section('content')
    <div class="container my-5">
        <div class="alert alert-success text-center">
            <h2>Order Confirmed</h2>
            <p>Thank you for your order! We'll deliver it soon </p>

        </div>

        <div class="card my-4">
            <div class="card-header bg-light">
                <strong>order summary </strong>
            </div>
            <div class="card-body">
                <p><strong>full name:</strong> {{ $order->customer_name }}</p>
                <p><strong>phone :</strong> {{ $order->phone }}</p>
                <p><strong>address:</strong> {{ $order->address }}</p>
            </div>
        </div>

        <div class="card">
            <div class="card-header bg-light">
                <strong>Order Details </strong>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>product</th>
                            <th>quantity</th>
                            <th>price</th>
                            <th>total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->items as $item)
                            <tr>
                                <td>{{ $item->product->name ?? 'deleted ' }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>{{ number_format($item->price, 2) }} EGP</td>
                                <td>{{ number_format($item->price * $item->quantity, 2) }}EGP</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="text-end">
                    <strong> Total: {{ number_format($order->total_price, 2) }} EGP</strong>
                </div>
            </div>
        </div>

        <a href="{{ route('home') }}" class="btn btn-primary">Back to Home</a>

    </div>
@endsection
