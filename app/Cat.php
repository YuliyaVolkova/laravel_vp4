<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cat extends Model
{
    protected $guarded = ['id'];
    protected $fillable = ['title', 'description'];
    public $table = "cats";

    public function products()
    {
        return $this->hasMany(Product::class, 'cat_id', 'id');
    }
}
