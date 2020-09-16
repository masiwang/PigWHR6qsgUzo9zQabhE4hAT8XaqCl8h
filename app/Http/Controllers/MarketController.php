<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Carbon\Carbon;

use App\MarketProduct;
use App\MarketCart;
use App\MarketCartProduct;
use App\MarketCategory;
use App\MarketWishlist;
use App\User;


class MarketController extends Controller
{
    public function index(Request $request){
        $products = MarketProduct::leftJoin('market_categories', 'market_categories.id', 'market_products.category_id')
                    ->where('is_delete', 0)
                    ->select(
                        'market_products.image as image',
                        'market_products.name as name',
                        'market_products.slug as slug',
                        'market_products.price as price',
                        'market_products.size as size',
                        'market_categories.slug as category'
                    )
                    ->get();
        return view('market.index', ['products' => $products, 'user' => Auth::user()]);
    }

    public function category($category){
        $category = MarketCategory::where('name', $category)->first();
        $products = MarketProduct::join('market_categories', 'market_categories.id', 'market_products.category_id')
            ->where('is_delete', 0)
            ->where('category_id', $category->id)
            ->select(
                'market_products.image as image',
                'market_products.name as name',
                'market_products.slug as slug',
                'market_products.price as price',
                'market_products.size as size',
                'market_categories.slug as category'
            )
            ->get();
        return view('market.index', ['products' => $products, 'user' => Auth::user()]);
    }

    public function detail($category, $product){
        $product = MarketProduct::leftJoin(
            DB::raw(
                    '(SELECT market_wishlists.market_product_id as wish 
                        FROM market_wishlists 
                        JOIN users ON market_wishlists.user_id = users.id 
                        WHERE users.id = 6) my_wish'
                ), 'my_wish.wish', 'market_products.id'
            )
            ->leftJoin('market_categories', 'market_categories.id', 'market_products.category_id')
            ->select(
                'market_products.image as image',
                'market_products.name as name',
                'market_products.slug as slug',
                'market_products.description as description',
                'market_products.price as price',
                'market_products.size as size',
                'market_products.stock as stock',
                'market_categories.slug as category_slug',
                'market_categories.name as category_name',
                'my_wish.wish as is_wishlist'
            )
            ->where('market_products.slug', $product)
            ->first();
        $recommends = MarketProduct::join('market_categories', 'market_categories.id', 'market_products.category_id')
                    ->where('is_delete', 0)
                    ->where('market_categories.slug', $category)
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
        $email_is_verified = User::where('id', Auth::id())->select('email_verified_at')->first();
        if(!$product){
            return '404';
        }else{
            return view('market.detail-product', ['product' => $product, 'recommends' => $recommends, 'email_is_verified'=> $email_is_verified, 'user' => Auth::user()]);
        }
    }

    public function wish($category, $product){
        $category = MarketCategory::where('slug', $category)->select('id')->first();
        $wish_product = MarketProduct::where('is_delete', 0)
            ->where('category_id', $category->id)
            ->where('slug', $product)
            ->select('id')
            ->first();
        $query = [
            'user_id' => Auth::id(),
            'market_product_id' => $wish_product->id,
            'created_at' => Carbon::now()
        ];
        if(MarketWishlist::insert($query)){
            return back()->with('success', 'Produk berhasil ditambahkan ke wishlist');
        }else{
            return back()->with('failed', 'Produk gagal ditambahkan ke wishlist');
        }
    }

    public function cart(Request $request){
        $cart = MarketCart::where('user_id', Auth::id())
            ->where('market_checkout_status_id', 1)
            ->first();
        
        $product = MarketProduct::where('slug', $request->product)->first();

        if(!$cart){
            $cart_id = MarketCart::insertGetId([
                'user_id' => Auth::id(),
                'market_checkout_status_id' => 1,
                'created_at' => Carbon::now()
            ]);

            $query = [
                'market_checkout_id' => $cart_id,
                'market_product_id' => $product->id,
                'qty' => $request->qty,
                'created_at' => Carbon::now()
            ];

            if(MarketCartProduct::insert($query)){
                return redirect('cart');
            }else{
                return back();
            }
        }else{
            $query = [
                'market_checkout_id' => $cart->id,
                'market_product_id' => $product->id,
                'qty' => $request->qty,
                'created_at' => Carbon::now()
            ];

            $product_in_cart = MarketCartProduct::where('market_checkout_id', $cart->id)
                ->where('market_product_id', $product->id)
                ->first();
            
            if(!$product_in_cart){
                if(MarketCartProduct::insert($query)){
                    return redirect('cart');
                }else{
                    return back();
                }
            }else{
                $query = [
                    'qty' => (int)$product_in_cart->qty + (int)$request->qty
                ];

                if($product_in_cart->update($query)){
                    return redirect('cart');
                }else{
                    return back();
                }
            }
            
        }
    }
}
