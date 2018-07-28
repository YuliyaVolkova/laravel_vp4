<?php

namespace App\Http\Controllers;

use App\Cat;
use App\Product;
use App\Services\ClearData;
use App\Services\ImageToUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Validator;

class ProductController extends Controller
{
    protected $data;

    protected function validation()
    {
        return Validator::make($this->data, [
            'name' => 'required|max:255',
            'cat_id' => 'required|exists:cats,id',
            'description' => 'required|max:500',
            'price_rub' => 'required|integer|min:1',
            'quantity' => 'required|integer|min:1'
        ])->validate();
    }

    public function show($productId)
    {
        $newProducts = Product::getNewProducts(Config::get('constants.PRODUCTS_PER_SINGLE_PAGE_BOTTOM'));
        $data = [
            'product' => Product::getProductById($productId),
            'products' => $newProducts
        ];
        return view('single.product', $data);
    }

    public function create()
    {
        return view('admin.product.create', ['cats' => Cat::all()]);
    }

    public function store(Request $request, ClearData $clearData, ImageToUpload $image)
    {
        $this->data = $request->except(['image']);
        $this->data = $clearData->clearAll($this->data);
        $this->data['image_url'] = $image->checkImage($request);
        $this->validation();
        Product::create($this->data);

        return redirect()->route('admin.index');
    }

    public function edit($productId)
    {
        $product = Product::find($productId);
        $data = [
            'cats' => Cat::all(),
            'product' => $product
        ];

        return view('admin.product.edit', $data);
    }

    public function update($productId, Request $request, ClearData $clearData, ImageToUpload $image)
    {
        $this->data = $request->except(['image']);
        $this->data = $clearData->clearAll($this->data);
        $product = Product::find($productId);
        if ($product === null) {
            return redirect()->route('product.edit', ['product_id' => $productId]);
        }
        $this->data['image_url'] = $product->image_url;
        $newImageUrl = $image->checkImage($request);
        if ($newImageUrl !== null) {
            $this->data['image_url'] = $newImageUrl;
        }

        $this->validation();
        $product->update($this->data);

        return redirect()->route('admin.index');
    }

    public function delete($productId)
    {
        $product = Product::getProductById($productId);
        return view('admin.product.delete', ['product' => $product]);
    }

    public function destroy($productId)
    {
        Product::destroy($productId);
        return redirect()->route('admin.index');
    }
}
