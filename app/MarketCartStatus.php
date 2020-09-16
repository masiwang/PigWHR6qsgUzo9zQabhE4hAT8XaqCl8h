<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MarketCartStatus extends Model
{
    protected $table = 'market_checkout_status';
    protected $fillable = ['slug', 'name', 'created_at', 'updated_at'];
}
