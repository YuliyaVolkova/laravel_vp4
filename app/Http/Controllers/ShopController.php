<?php

namespace App\Http\Controllers;

use App\Cat;
use App\Product;

class ShopController extends Controller
{
    public function index()
    {
        $data = [
            'productRandom' => Product::inRandomOrder()->first(),
            'cats' => Cat::all(),
            'products' =>Product::orderBy('created_at', 'desc')
            ->paginate(6)
        ];
        return view('shop', $data);
    }
}
