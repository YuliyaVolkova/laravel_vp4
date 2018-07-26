<?php

namespace App\Http\Controllers;

use App\Http\Controllers\DataClear\InputTrait;
use App\Product;
use App\Cat;
use Illuminate\Http\Request;
use Validator;

class SearchController extends Controller
{
    use InputTrait;

    protected $data;

    protected function validation()
    {
        return Validator::make($this->data, [
            'q' => 'required|min:3|max:15',
        ])->validate();
    }

    public function index(Request $request)
    {
        $this->data = $this->clearAll($request->all());
        $this->validation();
        $searchStr = $this->data['q'];
        $result = [
            'productRandom' => Product::inRandomOrder()->first(),
            'cats' => Cat::all(),
            'products' => Product::where('name', 'like', '%' . $searchStr .'%')
            ->orWhere('description', 'like', '%' . $searchStr . '%')
            ->orderBy('created_at', 'desc')
            ->paginate(6)
        ];
        return view('shop', $result);
    }
}
