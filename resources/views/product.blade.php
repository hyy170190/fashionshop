@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="{{ route('products.show', ['id' => $product->id]) }}">View Product</a>
            <h1>{{ $product->name }}</h1>
                <p>Size: {{ $product->size }}</p>
                <p>Price: {{ $product->price }}</p>
                <p>Category: {{ $product->category }}</p>
                <p>Description: {{ $product->description }}</p>
    </div>
@endsection
