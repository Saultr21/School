<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminProductController extends Controller
{
    public function index()
    {
        $viewData = [];
        $viewData["title"] = "Admin Page - Products - Tienda Online";
        $viewData["products"] = Product::all();
        return view('admin.product.index')->with("viewData", $viewData);
    }


    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|max:255',
        'price' => 'required|numeric|min:0',
        'description' => 'required',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ], [
        'name.required' => 'El campo nombre es obligatorio.',
        'name.max' => 'El campo nombre no puede tener más de :max caracteres.',
        'price.required' => 'El campo precio es obligatorio.',
        'price.numeric' => 'El campo precio debe ser un número.',
        'price.min' => 'El campo precio debe ser al menos :min.',
        'description.required' => 'El campo descripción es obligatorio.',
        'image.image' => 'El archivo debe ser una imagen.',
        'image.mimes' => 'El archivo debe tener uno de los siguientes formatos: jpeg, png, jpg, gif, svg.',
        'image.max' => 'El tamaño de la imagen no debe ser mayor a :max kilobytes.',
    ]);

    // Verificar si se ha adjuntado un archivo de imagen
    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $extension = $image->extension(); 


        $product = new Product();
        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $product->description = $request->input('description');
        $product->image = 'image.jpg';
        $product->save(); 


        $imageName = "{$product->id}.{$product->image}.{$extension}";

        
        Storage::disk('public')->put($imageName, file_get_contents($image->getRealPath()));


        $product->image = $imageName;

        $product->save(); 

        return redirect()->route('admin.product.index')->with('success', 'Producto creado exitosamente.');
    } 
}


       
    public function destroy($id)
    {
        $product = Product::find($id);

        if ($product) {
            $product->delete();
            return redirect()->route('admin.product.index')->with('success', 'Producto eliminado exitosamente.');
        }

        return redirect()->route('admin.product.index')->with('error', 'Producto no encontrado.');
    }
}




