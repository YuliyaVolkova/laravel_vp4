<?php

namespace App\Http\Controllers;

use App\Cat;
use App\Http\Controllers\DataClear\InputTrait;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Validator;
use Illuminate\Validation\Rule;

class CatController extends Controller
{
    use InputTrait;

    public function show($catId)
    {
        $cat = Cat::find($catId);
        if ($cat === null) {
            return redirect()->back();
        }
        $data = [
            'products' => Product::getProductsByCatId($catId)
            ->paginate(Config::get('constants.PRODUCTS_PER_PAGE')),
            'catTitle' => $cat->title
        ];
        return view('single.cat', $data);
    }

    public function create()
    {
        return view('admin.cat.create');
    }

    public function store(Request $request)
    {
        $data = $this->clearAll($request->all());

        Validator::make($data, [
            'title' => 'required|unique:cats|max:255',
            'description' => 'required|max:500',
        ])->validate();

        Cat::storeCat($data);

        return redirect()->route('admin.index');
    }

    public function edit($catId)
    {
        $cat = Cat::find($catId);
        if ($cat === null) {
            return redirect()->back();
        }
        return view('admin.cat.edit', ['cat' => $cat]);
    }

    public function update($catId, Request $request)
    {
        $cat = Cat::find($catId);
        if ($cat === null) {
            return redirect()->back();
        }
        $data = $this->clearAll($request->all());

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
        $cat = Cat::find($catId);
        if ($cat === null) {
            return redirect()->back();
        }
        return view('admin.cat.delete', ['cat' => $cat]);
    }

    public function destroy($catId)
    {
        $checkProducts = Product::getProductsByCatId($catId)->first();
        if ($checkProducts === null) {
            Cat::destroy($catId);
        }
        return redirect()->route('admin.index');
    }
}
