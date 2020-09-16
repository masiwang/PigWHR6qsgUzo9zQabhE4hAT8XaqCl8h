<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\FundProduct;
use App\FundCheckout;
use App\User;
use Carbon\Carbon;

class FundController extends Controller
{
    public function index(){
        $products = FundProduct::join('fund_categories', 'fund_categories.id', 'fund_products.fund_category_id')
        ->select(
            'fund_products.id as id',
            'image',
            'fund_products.name as name',
            'price',
            'fund_products.slug as slug',
            'periode',
            'stock',
            'size',
            'expired_at',
            'fund_categories.slug as category'
        )
        ->get();
        return view('fund.index', ['products' => $products]);
    }
    public function detail($category, $product){
        $product = FundProduct::join('fund_categories', 'fund_categories.id', 'fund_products.fund_category_id')
            ->where('fund_categories.slug', $category)
            ->where('fund_products.slug', $product)
            ->select(
                'fund_products.image as image',
                'fund_products.name as name',
                'fund_products.slug as slug',
                'fund_products.description as description',
                'fund_products.price as price',
                'fund_products.size as size',
                'fund_products.stock as stock',
                'max_lot',
                'fund_categories.slug as category_slug',
                'fund_categories.name as category_name'
            )
            ->first();
        $is_verified = User::where('id', Auth::id())->select('email_verified_at', 'ktp_verified_at')->first();
        if(!$product){
            return '404';
        }else{
            return view('fund.detail', ['product' => $product, 'is_verified' => $is_verified]);
        }
    }

    public function checkout(Request $request, $category, $product){
        $lots = $request->lots;
        $fund_product = FundProduct::where('slug', $product)->first();
        $current_stock = (int)$fund_product->stock;
        $query = [
            'portofolio_code' => 'MKY1'.Auth::id().strtotime(Carbon::now()),
            'invoice_code' => 'INV1'.strtotime(Carbon::now()),
            'user_id' => Auth::id(),
            'fund_product_id' => $fund_product->id,
            'lots' => $request->lots,
            'fund_checkout_status_id' => 1,
            'fund_start' => null,
            'fund_end' => null,
            'created_at' => Carbon::now()
        ];
        if(FundCheckout::insert($query)){
            $fund_product->update([
                'stock' => $current_stock-(int)$lots,
                'updated_at' => Carbon::now()
            ]);
            return redirect('portofolio');
        }else{
            return back()->with('error', 'Maaf sistem sedang sibuk.');
        }
    }
}
