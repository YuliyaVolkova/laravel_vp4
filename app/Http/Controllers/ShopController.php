<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Support\Facades\Config;

class ShopController extends Controller
{
    public function index()
    {
        $data = [
            'products' =>Product::orderBy('id', 'desc')
            ->paginate(Config::get('constants.PRODUCTS_PER_PAGE'))
        ];
        return view('shop', $data);
    }
}
