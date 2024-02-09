@extends('layouts.app')
@section('title', $viewData['title'])
@section('subtitle', 'Lista de Productos')
@section('content')

<div class="container">
    <div class="row">
        @foreach ($viewData['products'] as $product)
            <div class="col-md-4 col-lg-3 mb-4">
                <div class="card">
                    <img src="{{ asset("/storage/{$product['image']}") }}" class="card-img-top" alt="{{ $product['name'] }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product['name'] }}</h5>
                        <p class="card-text">{{ $product['description'] }}</p>
                        <a href="{{ route('products.show', ['id' => $product['id']]) }}" class="btn btn-primary">Ver detalles</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

</div>

@endsection
