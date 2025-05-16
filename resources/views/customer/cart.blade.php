@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h2 class="mb-4">Shopping Cart</h2>

        @php
            $total = 0;
        @endphp

        @if (session('cart') && count(session('cart')) > 0)
            @foreach (session('cart') as $id => $item)
                @php
                    $subtotal = $item['price'] * $item['quantity'];
                    $total += $subtotal;
                @endphp

                <div class="card mb-3">
                    <div class="row g-0 align-items-center">
                        <div class="col-md-2">
                            <img src="{{ asset('storage/' . $item['image']) }}" class="img-fluid rounded-start"
                                alt="{{ $item['name'] }}">
                        </div>
                        <div class="col-md-10">
                            <div class="card-body d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="card-title">{{ $item['name'] }}</h5>
                                    <p class="card-text mb-1"> price : {{ number_format($item['price'], 2) }} EGP</p>
                                    <form method="POST" action="{{ route('cart.update') }}"
                                        class="d-flex align-items-center">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $id }}">
                                        <input type="number" name="quantity" value="{{ $item['quantity'] }}"
                                            class="form-control me-2" style="width: 80px;" min="1">
                                        <button type="submit" class="btn btn-sm btn-outline-primary">update</button>
                                    </form>
                                </div>

                                <div class="text-end">
                                    <p class="mb-1">Total <strong>{{ number_format($subtotal, 2) }} EGP</strong></p>
                                    <a href="{{ route('cart.remove', $id) }}" class="btn btn-sm btn-danger">delete</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            <div class="text-end">
                <h4 class="mt-4">Total : <strong>{{ number_format($total, 2) }} ج.م</strong></h4>
                <a href="{{ route('checkout.show') }}" class="btn btn-success btn-lg mt-3">Checkout</a>
            </div>
        @else
            <div class="alert alert-info">Cart is Empty</div>
        @endif
    </div>
@endsection
