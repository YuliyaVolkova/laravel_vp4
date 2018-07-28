<?php

namespace App\Http\Controllers;

use App\Cat;
use App\Product;
use App\Services\ClearData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Validator;
use Illuminate\Validation\Rule;

class CatController extends Controller
{
    public function show($catId)
    {
        $cat = Cat::find($catId);

        $catTitle = ($cat === null) ? null : $cat->title;

        $data = [
            'products' => Product::getProductsByCatId($catId)
            ->paginate(Config::get('constants.PRODUCTS_PER_PAGE')),
            'catTitle' => $catTitle
        ];
        return view('single.cat', $data);
    }

    public function create()
    {
        return view('admin.cat.create');
    }

    public function store(Request $request, ClearData $clearData)
    {
        $data = $clearData->clearAll($request->all());

        Validator::make($data, [
            'title' => 'required|unique:cats|max:255',
            'description' => 'required|max:500',
        ])->validate();

        Cat::create($data);

        return redirect()->route('admin.index');
    }

    public function edit($catId)
    {
        return view('admin.cat.edit', ['cat' => Cat::find($catId)]);
    }

    public function update($catId, Request $request, ClearData $clearData)
    {
        $cat = Cat::find($catId);
        if ($cat === null) {
            return route('cat.edit', ['cat_id' => $catId]);
        }
        $data = $clearData->clearAll($request->all());

        Validator::make($data, [
            'title' => [
                'required',
                Rule::unique('cats')->ignore($catId),
                'max:255'],
            'description' => 'required|max:500',
        ])->validate();


        $cat->update($data);

        return redirect()->route('admin.index');
    }

    public function delete($catId)
    {
        return view('admin.cat.delete', ['cat' => Cat::find($catId)]);
    }

    public function destroy($catId)
    {
        $checkProducts = Product::getProductsByCatId($catId)->first();

        if ($checkProducts !== null) {
            return view('admin.cat.delete', ['cat' => Cat::find($catId),
                'product' => $checkProducts]);
        }
        Cat::destroy($catId);
        return redirect()->route('admin.index');
    }
}
