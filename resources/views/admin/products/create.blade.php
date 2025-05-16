@extends('layouts.admin')

@section('content')
    <div class="container mt-4">
        <h2>Add New Product</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label>Name:</label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}">
            </div>

            <div class="mb-3">
                <label>Price:</label>
                <input type="number" step="0.01" name="price" class="form-control" value="{{ old('price') }}">
            </div>

            <div class="mb-3">
                <label>Category:</label>
                <select name="category_id" class="form-control">
                    <option disabled selected>Choose category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label>Image:</label>
                <input type="file" name="image" class="form-control">
            </div>

            <button class="btn btn-success">Save</button>
            <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection
