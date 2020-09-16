<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MarketWishlist extends Model
{
    protected $table = 'market_wishlists';
    protected $fillable = ['user_id', 'market_product_id', 'created_at'];
}
