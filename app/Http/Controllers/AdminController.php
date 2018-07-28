<?php

namespace App\Http\Controllers;

use App\Cat;
use App\Product;
use App\Order;
use App\Services\ClearData;
use App\User;
use Illuminate\Support\Facades\Config;
use Illuminate\Http\Request;
use Validator;

class AdminController extends Controller
{
    public function index()
    {
        $data = [
            'cats' => Cat::all(),
            'products' => Product::with('cat')->get(),
            'orders' => Order::with('user', 'product')
                ->orderBy('id', 'desc')->get(),
            'admin' => User::where('role', Config::get('constants.ADMIN_ROLE_FOR_SENDING_MAIL'))
                ->first(),
            'admins' => User::where('role', Config::get('constants.ADMIN_ROLE'))->get()
        ];

        return view('admin.index', $data);
    }

    public function select(Request $request, ClearData $clearData)
    {
        $data = $clearData->clearAll($request->all());

        Validator::make($data, [
            'name' => 'required|string|max:255',
            'userId' => 'required|exists:users,id'
        ])->validate();

        $user = User::where('role', Config::get('constants.ADMIN_ROLE_FOR_SENDING_MAIL'))->first();

        if ($user !== null && $user->id !== $data['userId']) {
            $user->update(['role' => Config::get('constants.ADMIN_ROLE')]);
        }

        User::updateInfo(
            $data['userId'],
            ['name' => $data['name'],
             'role' => Config::get('constants.ADMIN_ROLE_FOR_SENDING_MAIL')
            ]
        );
        return redirect()->route('admin.index');
    }
}
