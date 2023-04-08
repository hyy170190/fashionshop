@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2>Product List</h2>
            <hr>
            <div class="row">
                <div class="col-md-12">
                    <form action="{{ route('products.index') }}" method="get">
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <input type="text" name="search" class="form-control" value="{{ old('search', $search ?? '') }}" placeholder="Search...">
                            </div>
                            <div class="form-group col-md-3">
                                <select name="category" class="form-control">
                                    <option value="">All Categories</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category }}" {{ old('category', $categoryFilter ?? '') == $category ? 'selected' : '' }}>{{ $category }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-2">
                                <input type="number" name="price_min" class="form-control" value="{{ old('price_min', $priceMin ?? '') }}" placeholder="Price Min">
                            </div>
                            <div class="form-group col-md-2">
                                <input type="number" name="price_max" class="form-control" value="{{ old('price_max', $priceMax ?? '') }}" placeholder="Price Max">
                            </div>
                            <div class="form-group col-md-2">
                                <button type="submit" class="btn btn-primary">Filter</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row">
                @foreach($products as $product)
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <p class="card-text">{{ $product->description }}</p>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">{{ $product->category }}</li>
                                    <li class="list-group-item">Size S: {{ $product->size_S }}</li>
                                    <li class="list-group-item">Size M: {{ $product->size_M }}</li>
                                    <li class="list-group-item">Size L: {{ $product->size_L }}</li>
                                    <li class="list-group-item">Price: ${{ number_format($product->unit_price, 2) }}</li>
                                </ul>
                                <a href="#" class="btn btn-primary">Add to cart</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
