<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
        return view('portofolio.index', ['checkouts' => $checkouts, 'running_portofolios' => $running_portofolios, 'user' =>Auth::user()]);
    }

    public function index2(){
        $portofolios = DB::table('fund_checkouts')
            ->join('fund_products', 'fund_products.id', 'fund_checkouts.fund_product_id')
            ->join('fund_return_types', 'fund_return_types.id', 'fund_products.return_type_id')
            ->leftJoin('vendors', 'vendors.id', 'fund_products.vendor_id')
            ->where('user_id', Auth::id())
            ->select(
                'fund_products.name as name',
                'fund_checkouts.fund_checkout_status_id',
                'vendors.name as vendor_name',
                'fund_products.price as price',
                'fund_checkouts.lots as lots',
                'fund_products.return as return',
                'fund_return_types.name as return_type',
                'fund_products.started_at',
                'fund_products.ended_at'
                )
            ->get();
        return view('user.portofolio', ['user' => Auth::user(), 'portofolios' => $portofolios]);
    }

    // === API Section ===
    public function _search(Request $request){
        $portofolios = DB::table('fund_checkouts')
            ->join('fund_products', 'fund_products.id', 'fund_checkouts.fund_product_id')
            ->join('fund_return_types', 'fund_return_types.id', 'fund_products.return_type_id')
            ->leftJoin('vendors', 'vendors.id', 'fund_products.vendor_id')
            ->select(
                'fund_products.name as name',
                'fund_checkouts.fund_checkout_status_id',
                'vendors.name as vendor_name',
                'fund_products.price as price',
                'fund_checkouts.lots as lots',
                'fund_products.return as return',
                'fund_return_types.name as return_type',
                'fund_products.started_at',
                'fund_products.ended_at'
            );
            if($request->get('name')){
                $portofolios = $portofolios->where('fund_products.name', 'like', '%'.$request->get('name').'%');
            }
            if($request->get('status') == 'menunggu-pembayaran'){
                $portofolios = $portofolios->where('fund_checkouts.fund_checkout_status_id', 1);
            }
            if($request->get('status') == 'dalam-pendanaan'){
                $portofolios = $portofolios->where('fund_checkouts.fund_checkout_status_id', 2);
            }
            if($request->get('status') == 'pendanaan-selesai'){
                $portofolios = $portofolios->where('fund_checkouts.fund_checkout_status_id', 3);
            }
            if($request->get('status') == 'pendanaan-gagal'){
                $portofolios = $portofolios->where('fund_checkouts.fund_checkout_status_id', 4);
            }
            $portofolios = $portofolios->where('user_id', $request->get('user_id'))
                ->get();
        return response()->json($portofolios, 200);
    }
}
