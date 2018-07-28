<?php

namespace App\Http\Controllers;

use App\Product;
use App\Services\ClearData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Validator;

class SearchController extends Controller
{
    public function index(Request $request, ClearData $clearData)
    {
        $data = $clearData->clearAll($request->all());

        Validator::make($data, [
            'q' => 'required|min:3|max:15',
        ])->validate();

        return view('shop', [
            'products' => Product::searchByString($data['q'])
                ->paginate(Config::get('constants.PRODUCTS_PER_PAGE'))
        ]);
    }
}
