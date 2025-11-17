@extends('layouts.master')

@section('content')
    <h1>Product Details</h1>
    <hr>
    <div class="card">
        <div class="card-header">
            Our Product Details
        </div>
        
        <div class="class-body">
            <img src="https://placehold.co/600x400" class="img-fluid" alt="">
            <p>Product Name: {{ $product->name_product }}</p>
            <p>Price: RP. {{ $product->price_product }}</p>
            <p>Description: {{ $product->description_product }}</p>
            <p>Category: awawa</p>
            <p>Stock: tersedia kesediaan</p>
            <a href="/product" class="btn btn-primary">awawa</a>
        </div>
    </div>
@endsection