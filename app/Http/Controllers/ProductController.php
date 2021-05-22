<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function showAll(Request $request)
    {
        $data = Products::paginate(25);
        return view('products_table', compact('data'));
    }

    public function showSingle($id)
    {
        $product = Products::findOrFail($id);
        $map = Products::getFieldsMap();
        $product_array = [];

        foreach ($map as $key => $label) {
            $product_array[$key] = $product->{$key};
        }
        if ($product->attributes)
            $product_array['attributes'] = $product->attributes->toArray();

        return view('product_page', ['product' => $product_array, 'map' => $map]);
    }
}
