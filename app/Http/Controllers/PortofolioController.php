<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\FundCheckout;

use Carbon\Carbon;

class PortofolioController extends Controller
{
    public function index(){
        $checkouts = FundCheckout::leftJoin('fund_checkout_status', 'fund_checkout_status.id', 'fund_checkouts.fund_checkout_status_id')
            ->leftJoin('fund_payments', 'fund_payments.invoice_code', 'fund_checkouts.invoice_code')
            ->leftJoin('fund_products', 'fund_products.id', 'fund_checkouts.fund_product_id')
            ->where('fund_checkouts.user_id', Auth::id())
            ->select(
                'fund_checkouts.portofolio_code as portofolio_code',
                'fund_checkouts.invoice_code as invoice_code',
                'fund_checkouts.fund_checkout_status_id as status_id',
                'fund_checkout_status.name as status',
                'fund_checkouts.updated_at as pay_time',
                'fund_products.monthly_return',
                'fund_checkouts.fund_start'
            )
            ->get();
        $running_portofolios = [];
        $w = [null, 1, 2, null, 4];
        foreach ($checkouts as $checkout) {
            if(!$checkout->fund_start){
                array_push($running_portofolios, 0);
            }else{
                array_push($running_portofolios, Carbon::parse($checkout->fund_start)->floatDiffInMonths(Carbon::now(), false));
            }
        }
        return view('portofolio.index', ['checkouts' => $checkouts, 'running_portofolios' => $running_portofolios]);
    }
}
