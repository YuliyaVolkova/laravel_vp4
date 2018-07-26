<?php

namespace App\Http\Controllers;

use App\Cat;
use App\Http\Controllers\DataClear\InputTrait;
use App\Http\Controllers\DataClear\ImageTrait;
use App\Product;
use Illuminate\Http\Request;
use Validator;

class ProductController extends Controller
{
    use InputTrait, ImageTrait;

    protected function validation()
    {
        return Validator::make($this->clearAll($this->data), [
            'name' => 'required|max:255',
            'cat_id' => 'required|exists:cats,id',
            'description' => 'required|max:500',
            'price_rub' => 'required|integer|min:1',
            'quantity' => 'required|integer|min:1'
        ])->validate();
    }

    public function show($productId)
    {
        $data = [
            'productRandom' => Product::inRandomOrder()->first(),
            'cats' => Cat::all(),
            'product' => Product::getProductById($productId),
            'products' => Product::orderBy('created_at', 'desc')
            ->take(3)->get()
        ];
        return view('single.product', $data);
    }

    public function create()
    {
        return view('admin.product.create', ['cats' => Cat::all()]);
    }

    public function store(Request $request)
    {
        $this->data = $request->except(['image']);
        $this->data['image_url'] = null;
        $this->checkImage($request);
        $this->validation();
        Product::storeProduct($this->data);

        return redirect()->route('admin.index');
    }

    public function edit($productId)
    {
        $data = [
            'cats' => Cat::all(),
            'product' => Product::findOrFail($productId)
        ];

        return view('admin.product.edit', $data);
    }

    public function update($productId, Request $request)
    {
        $this->data = $request->except(['image']);
        $this->data['image_url'] = Product::findOrFail($productId)->image_url;
        $this->checkImage($request);
        $this->validation();
        Product::findOrFail($productId)->update($this->data);

        return redirect()->route('admin.index');
    }

    public function delete($productId)
    {
        return view('admin.product.delete', ['product' => Product::with('cat')->findOrFail($productId)]);
    }

    public function destroy($productId)
    {
        Product::destroy($productId);
        return redirect()->route('admin.index');
    }
}
