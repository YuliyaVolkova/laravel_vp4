<?php

namespace App\Http\Controllers;

use App\Http\Controllers\DataClear\InputTrait;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Cat;
use App\Order;
use App\Product;
use Illuminate\Validation\Rule;
use Validator;
use App\Events\OrderMailEvent;

class OrderController extends Controller
{
    use InputTrait;

    public function show()
    {
        $userId = Auth::id();
        if (!$userId) {
            return redirect()->route('login');
        }
        $data = [
            'productRandom' => Product::inRandomOrder()->first(),
            'cats' => Cat::all(),
            'orders' => Order::with('product')
                ->where('user_id', $userId)
                ->orderBy('created_at', 'desc')
                ->paginate(4)
        ];
        return view('single.userOrders', $data);
    }

    public function create($productId)
    {
        $userId = Auth::id();
        if (!$userId) {
            return redirect()->route('login');
        }
        return ['email' => User::findOrFail($userId)->email,
            'product' => Product::findOrFail($productId)->id
        ];
    }

    public function store($productId, Request $request)
    {
        $userId = Auth::id();
        if (!$userId) {
            return redirect()->route('login');
        }

        $data = $this->clearAll($request->all());

        Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => ['required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($userId)],
            'message' => 'max:300'
        ])->validate();

        User::findOrFail($userId)
            ->update(['name' => $data['name'],
                    'email' => $data['email']]);

        $order = Order::storeOrder($userId, $productId);
        $order = Order::with('user', 'product')
                    ->where('id', $order->id)
                    ->first();

        event(new OrderMailEvent((['order' => $order,
                                    'mes' => $data['message']
        ])));

        return redirect()->route('orders.show');
    }
}
