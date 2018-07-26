<?php

namespace App\Http\Controllers;

use App\Cat;
use App\Product;
use App\Order;

class AdminController extends Controller
{
    public function index()
    {
        $data = [
            'cats' => Cat::all(),
            'products' => Product::with('cat')->get(),
            'orders' => Order::with('user', 'product')
                ->orderBy('created_at', 'desc')->get()
        ];

        return view('admin.index', $data);
    }
}
