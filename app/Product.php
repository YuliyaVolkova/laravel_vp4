<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = ['id'];
    protected $fillable = ['name', 'cat_id', 'image_url', 'description', 'price_rub', 'quantity'];
    public $table = "products";

    public function cat()
    {
        return $this->belongsTo(Cat::class, 'cat_id', 'id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'product_id', 'id');
    }

    public static function storeProduct($array)
    {
        $product = new Product();
        $product->name = $array['name'];
        $product->cat_id = $array['cat_id'];
        $product->image_url = $array['image_url'];
        $product->description = $array['description'];
        $product->price_rub = $array['price_rub'];
        $product->quantity = $array['quantity'];
        return $product->save();
    }

    public static function getProductsByCatId($catId)
    {
        return Product::with('cat')
            ->where('cat_id', $catId)
            ->orderBy('created_at', 'desc')
            ->paginate(6);
    }

    public static function getProductById($productId)
    {
        return Product::with('cat')
            ->where('id', $productId)->first();
    }
}
