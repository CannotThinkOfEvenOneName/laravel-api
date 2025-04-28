<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function getProductsApi() {
        $products = Product::all();
        return $products;
    }
    public function addProductApi(Request $request)
    {
        $incomingFields = $request->validate([
            "name" => "required",
            "price" => "required",
        ]);

        $user = auth()->user();
        
        $newProduct = Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'created_by' => $user->id,  
        ]);
        return $newProduct;
    }
}
