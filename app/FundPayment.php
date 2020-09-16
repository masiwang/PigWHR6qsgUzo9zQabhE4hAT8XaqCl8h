<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FundPayment extends Model
{
    protected $table = 'fund_payments';
    protected $fillable = ['user_id', 'bank_type_id', 'bank_code', 'image', 'fund_checkout_id', 'nominal', 'invoice_code', 'created_at', 'updated_at'];
}
