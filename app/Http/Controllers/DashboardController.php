<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function view(Request $request){
        $category_id = $request->query('category_id');
        $product_name = $request->query('product_name');
        $user = Auth::user();
        $productController = new ProductController();
        $products = $productController->getProducts($request);
        $categories = Category::latest()->get();
        $stores = \App\Models\Store::latest()->get();
        $banners = Banner::latest()->get();
        if($user != null) {
            return view('home.dashboard', compact('user','products', 'categories', 'stores', 'category_id', 'product_name', 'banners'));
        } else {
            return view('home.index', compact('products', 'categories', 'stores', 'category_id', 'product_name', 'banners'));
        }
    }

}
