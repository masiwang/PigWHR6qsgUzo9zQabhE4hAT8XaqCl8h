<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MarketCartProduct extends Model
{
    protected $table = 'market_checkout_products';
    protected $fillable = ['market_checkout_id', 'market_product_id', 'qty', 'created_at', 'updated_at'];
}
