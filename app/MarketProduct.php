<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MarketProduct extends Model
{
    protected $table = 'market_products';
    protected $fillable = ['name', 'image', 'price', 'stock', 'size', 'description', 'category_id'];
}