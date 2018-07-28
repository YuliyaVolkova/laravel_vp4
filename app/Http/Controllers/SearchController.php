<?php

namespace App\Http\Controllers;

use App\Http\Controllers\DataClear\InputTrait;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
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
            'products' => Product::searchByString($searchStr)
            ->paginate(Config::get('constants.PRODUCTS_PER_PAGE'))
        ];
        return view('shop', $result);
    }
}
