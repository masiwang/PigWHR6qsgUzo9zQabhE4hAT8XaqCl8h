<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\MarketProduct;
use App\MarketWishlist;

class WishlistController extends Controller
{
    public function index(){
        $wishlists = MarketWishlist::join('market_products', 'market_products.id', 'market_wishlists.market_product_id')
            ->where('user_id', Auth::id())
            ->select(
                'market_products.image as image',
                'market_products.name as name',
                'market_products.price as price',
                'market_products.size as size',
                'market_products.stock as stock'
            )
            ->get();
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
        return view('wishlist.index', ['wishlists' => $wishlists, 'recommends' => $recommends, 'user'=> Auth::user()]);
    }
}
