<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = ['id'];
    protected $fillable = ['user_id', 'product_id'];
    public $table = "orders";

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public static function storeOrder($userId, $productId)
    {
        if (empty(Product::findOrFail($productId))) {
            return null;
        }
        $order = new Order();
        $order->user_id = $userId;
        $order->product_id = $productId;
        $order->save();
        return $order;
    }
}
