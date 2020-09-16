<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FundProduct extends Model
{
    protected $table = 'fund_products';
    protected $fillable = ['slug', 'name', 'description', 'image', 'max_lot', 'price', 'size', 'stock', 'periode', 'monthly_return', 'fund_category_id', 'vendor_id', 'created_at', 'updated_at', 'expired_at'];
    protected $hidden = ['created_at', 'updated_at'];
}
