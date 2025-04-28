<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function addProductApi(Request $request)
    {
        $incomingFields = $request->validate([
            "name"=>"required",
            "price"=>"required",
        ]);
        $incomingFields["created_by"] = auth("admin")->admin()->id;

        return null;
    }
}
