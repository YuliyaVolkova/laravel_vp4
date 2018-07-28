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
        $user = User::find($userId);
        if ($user === null) {
            return null;
        }
        $product = Product::find($productId);
        if ($product === null) {
            return null;
        }
        return self::create(
            [
                'user_id' => $userId,
                'product_id' => $productId
            ]
        );
    }

    public static function showOrders($userId)
    {
        return self::with('product')
            ->where('user_id', $userId)
            ->orderBy('id', 'desc');
    }
}
