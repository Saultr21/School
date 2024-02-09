<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();

        $viewData = [
            'title' => 'Listado de Productos - Tienda Online',
            'products' => $products,
        ];

        return view('products.index')->with('viewData', $viewData);
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);

        $viewData = [
            'title' => $product->name . ' - Detalles del Producto',
            'product' => $product,
        ];

        return view('products.show')->with('viewData', $viewData);
    }
}

