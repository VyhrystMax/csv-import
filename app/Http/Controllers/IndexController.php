<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function __invoke(Request $request)
    {
        $map = Products::getFieldsMap();

        return view('index', compact('map'));
    }
}
