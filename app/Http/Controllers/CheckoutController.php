<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\MarketProduct;
use App\MarketCart;

class CheckoutController extends Controller
{
    public function index(){
        $recommends = MarketProduct::join('market_categories', 'market_categories.id', 'market_products.category_id')
        ->where('is_delete', 0)
        ->select(
            'market_products.image as image',
            'market_products.name as name',
            'market_products.slug as slug',
            'market_products.price as price',
            'market_products.size as size',
            'market_categories.slug as category'
        )
        ->limit(6)
        ->get();
        $checkouts = MarketCart::join('market_checkout_status', 'market_checkout_status.id', 'market_checkouts.market_checkout_status_id')
            ->leftJoin('market_payments', 'market_payments.invoice_code', 'market_checkouts.invoice_code')
            ->where('market_checkouts.user_id', Auth::id())
            ->whereIn('market_checkouts.market_checkout_status_id', [2, 3, 4, 5])
            ->select(
                'market_checkouts.id as checkout_id',
                'market_checkouts.invoice_code as invoice_code',
                'market_checkout_status.id as status_id',
                'market_checkout_status.name as status',
                'market_payments.payment_code as payment_code'
            )
            ->get();
        return view('checkout.index', ['checkouts' => $checkouts, 'recommends' => $recommends]);
    }
}
