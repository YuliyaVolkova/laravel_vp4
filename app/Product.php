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

    public static function getProductsByCatId($catId)
    {
        return self::with('cat')
            ->where('cat_id', $catId)
            ->orderBy('id', 'desc');
    }

    public static function getProductById($productId)
    {
        return self::with('cat')->find($productId);
    }

    public static function getNewProducts($number)
    {
        return self::orderBy('id', 'desc')
            ->take($number)->get();
    }

    public static function searchByString($string)
    {
        return self::where('name', 'like', '%' . $string .'%')
        ->orWhere('description', 'like', '%' . $string . '%')
        ->orderBy('id', 'desc');
    }

    public static function randomProduct()
    {
        return self::inRandomOrder()->first();
    }
}
