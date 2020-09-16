<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MarketCart extends Model
{
    protected $table = 'market_checkouts';
    protected $fillable = ['user_id', 'market_checkout_status_id', 'created_at', 'invoice_code', 'invoice_created_at', 'invoice_expired_at', 'updated_at'];
}
