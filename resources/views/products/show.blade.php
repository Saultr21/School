@extends('layouts.app')
@section('title', $viewData['title'])
@section('subtitle', $viewData['product']['name'])
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-6">
            <img src="{{ asset("/img/{$viewData['product']['image']}") }}" class="img-fluid" alt="{{ $viewData['product']['name'] }}">
        </div>
        <div class="col-md-6 mt-5">
            <h4>{{ $viewData['product']['name'] }}</h4>
            <p>{{ $viewData['product']['description'] }}</p>
            <h6>Precio: ${{ $viewData['product']['price'] }}</h6>
            <a class="nav-link inactive" href="">Añadir al carrito</a>
        </div>
    </div>

</div>

@endsection
