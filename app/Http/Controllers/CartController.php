<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\MarketProduct;
use App\MarketCart;
use App\MarketCartProduct;
use App\MarketCategory;
use Carbon\Carbon;

class CartController extends Controller
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
        $cart = MarketCart::where('user_id', Auth::id())
            ->where('market_checkout_status_id', 1)
            ->select('id')
            ->first();
        if(!$cart){
            $cart_products = null;
        }else{
            $cart_products = MarketCartProduct::leftJoin('market_products', 'market_products.id', 'market_checkout_products.market_product_id')
            ->leftJoin('market_categories', 'market_categories.id', 'market_products.category_id')
            ->where('market_checkout_id', $cart->id)
            ->select(
                'market_products.image as image',
                'market_products.name as name',
                'market_products.slug as slug',
                'market_categories.slug as category_slug',
                'market_products.price as price',
                'market_products.size as size',
                'market_checkout_products.qty as qty',
                'market_products.stock as stock'
            )
            ->get();
        }
        return view('cart.index', ['cart_products' => $cart_products,'recommends' => $recommends]);
    }

    public function delete($category, $product){
        $category = MarketCategory::where('slug', $category)->first();
        $product = MarketProduct::where('slug', $product)
            ->where('category_id', $category->id)
            ->first();

        if(!$product){
            return '404';
        }

        $cart = MarketCart::where('user_id', Auth::id())
            ->where('market_checkout_status_id', 1)
            ->first();

        $product_in_cart = MarketCartProduct::where('market_checkout_id', $cart->id)
            ->where('market_product_id', $product->id)
            ->first();
        
        if(!$product_in_cart){
            return '404';
        }

        if($product_in_cart->delete()){
            return back();
        }else{
            return back();
        }
    }

    public function checkout(){
        $cart = MarketCart::where('user_id', Auth::id())
            ->where('market_checkout_status_id', 1)
            ->first();
        if(!$cart){
            return back();
        }else{
            $query = [
                'market_checkout_status_id' => 2,
                'invoice_code' => 'INV'.rand(500000000000, 999999999999),
                'invoice_created_at' => Carbon::now(),
                'invoice_expired_at' => Carbon::now()->addDay(1),
                'updated_at' => Carbon::now()
            ];

            if($cart->update($query)){
                return redirect('checkout');
            }else{
                return back()->with('error', 'Maaf sistem sedang sibuk. Coba sesaat lagi.');
            }
        }
    }
}
