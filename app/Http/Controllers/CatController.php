<?php

namespace App\Http\Controllers;

use App\Cat;
use App\Http\Controllers\DataClear\InputTrait;
use App\Product;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Validation\Rule;

class CatController extends Controller
{
    use InputTrait;

    public function show($catId)
    {
        $cat = Cat::findOrFail($catId);
        $data = [
            'productRandom' => Product::inRandomOrder()->first(),
            'cats' => Cat::all(),
            'products' => Product::getProductsByCatId($catId),
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

        Cat::storeCat($data['title'], $data['description']);

        return redirect()->route('admin.index');
    }

    public function edit($catId)
    {
        return view('admin.cat.edit', ['cat' => Cat::findOrFail($catId)]);
    }

    public function update($catId, Request $request)
    {
        $data = $this->clearAll($request->all());

        Validator::make($data, [
            'title' => [
                'required',
                Rule::unique('cats')->ignore($catId),
                'max:255'],
            'description' => 'required|max:500',
        ])->validate();


        Cat::findOrFail($catId)->update($data);

        return redirect()->route('admin.index');
    }

    public function delete($catId)
    {
        return view('admin.cat.delete', ['cat' => Cat::findOrFail($catId)]);
    }

    public function destroy($catId)
    {
        if (empty(Product::where('cat_id', $catId)->first())) {
            Cat::destroy($catId);
        }
        return redirect()->route('admin.index');
    }
}
