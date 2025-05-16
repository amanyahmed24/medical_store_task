@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h2>Checkout</h2>
        <form method="POST" action="{{ route('checkout.store') }}">
            @csrf
            <div class="mb-3">
                <label for="full_name" class="form-label">Full Name</label>
                <input type="text" class="form-control" name="full_name" required>
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone Number</label>
                <input type="text" class="form-control" name="phone" required>
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Delivery Address</label>
                <textarea class="form-control" name="address" rows="3" required></textarea>
            </div>


            <button type="submit" class="btn btn-success">Place Order</button>
        </form>
    </div>
@endsection
