<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FundCheckout extends Model
{
    protected $table = 'fund_checkouts';
    protected $fillable = ['user_id', 'portofolio_code', 'invoice_code','fund_product_id', 'fund_checkout_status_id', 'lots', 'fund_status_id', 'fund_start', 'fund_end', 'created_at', 'updated_at'];
}
