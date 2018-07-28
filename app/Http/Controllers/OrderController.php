<?php

namespace App\Http\Controllers;

use App\Services\ClearData;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Order;
use App\Product;
use Illuminate\Support\Facades\Config;
use Illuminate\Validation\Rule;
use Validator;
use App\Events\OrderMailEvent;

class OrderController extends Controller
{
    public function show()
    {
        $userId = Auth::id();
        $data = [
            'orders' => Order::showOrders($userId)
                ->paginate(Config::get('constants.ORDERS_PER_PAGE'))
        ];
        return view('single.userOrders', $data);
    }

    public function create($productId)
    {
        $userId = Auth::id();

        $product = Product::find($productId);
        if ($product === null) {
            return false;
        }

        //response на ajax запрос
        return ['email' => User::find($userId)->email,
            'product' => $product->id
        ];
    }

    public function store($productId, Request $request, ClearData $clearData)
    {
        $userId = Auth::id();

        $data = $clearData->clearAll($request->all());
        Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => ['required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($userId)],
            'message' => 'max:300'
        ])->validate();

        $user = User::updateInfo($userId, ['name' => $data['name'],
                    'email' => $data['email']
            ]);

        if ($user === null) {
            return false;
        }

        $order = Order::storeOrder($userId, $productId);

        if ($order === null) {
            return false;
        }

        $order = Order::with('user', 'product')->find($order->id);

        event(new OrderMailEvent((['order' => $order,
                                    'mes' => $data['message']
        ])));
        return 'ok';
    }
}
