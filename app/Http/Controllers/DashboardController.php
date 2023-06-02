<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function view(){
        $user = Auth::user();
        $products = DB::table('products')
        ->select(['products.*', 'categories.category_name','categories.satuan', 'stores.store_name'])
        ->join('categories', 'categories.category_id', '=', 'products.category_id')
        ->leftJoin('stores', 'stores.store_id', '=', 'products.store_id')
        ->get();
        $categories = Category::latest()->get();
        if($user != null) {
            if($user->role_id == 4) {
                return view('home.index', compact('user', 'products', 'categories'));
            } else {
                return view('home.dashboard', compact('user'));
            }
        } else {
            return view('home.index', compact('products', 'categories'));
        }
    }

    public function image($file)
    {
        $path = public_path('uploads') . '/' . $file;
        return response()->download($path);
    }
}
