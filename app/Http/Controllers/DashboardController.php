<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;
use App\Models\TransactionList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function view(Request $request)
    {
        $category_id = $request->query('category_id');
        $product_name = $request->query('product_name');
        $user = Auth::user();
        $productController = new ProductController();
        $products = $productController->getProducts($request);
        $categories = Category::latest()->get();
        $stores = \App\Models\Store::latest()->get();
        $banners = Banner::latest()->get();
        if ($user != null) {
            $minggu = count(DB::table('transaction_lists')
                ->whereRaw("DAYOFWEEK(created_at) = CASE
                                WHEN DAYNAME(CURDATE()) = 'Sunday' THEN 1
                            END")
                ->get());
            $senin = count(DB::table('transaction_lists')
                ->whereRaw("DAYOFWEEK(created_at) = CASE
                            WHEN DAYNAME(CURDATE()) = 'Monday' THEN 2
                        END")
                ->get());
            $selasa = count(DB::table('transaction_lists')
                ->whereRaw("DAYOFWEEK(created_at) = CASE
                        WHEN DAYNAME(CURDATE()) = 'Tuesday' THEN 3
                    END")
                ->get());
            $rabu = count(DB::table('transaction_lists')
                ->whereRaw("DAYOFWEEK(created_at) = CASE
                        WHEN DAYNAME(CURDATE()) = 'Wednesday' THEN 4
                    END")
                ->get());
            $kamis = count(DB::table('transaction_lists')
                ->whereRaw("DAYOFWEEK(created_at) = CASE
                        WHEN DAYNAME(CURDATE()) = 'Thursday' THEN 5
                    END")
                ->get());
            $jumat = count(DB::table('transaction_lists')
                ->whereRaw("DAYOFWEEK(created_at) = CASE
                        WHEN DAYNAME(CURDATE()) = 'Friday' THEN 6
                    END")
                ->get());
            $sabtu = count(DB::table('transaction_lists')
                ->whereRaw("DAYOFWEEK(created_at) = CASE
                        WHEN DAYNAME(CURDATE()) = 'Saturday' THEN 7
                    END")
                ->get());

            $pending = count(TransactionList::where('transaction_status_id', '=', 1)->get());
            $menunggu_konfirmasi = count(TransactionList::where('transaction_status_id', '=', 2)->get());
            $approved = count(TransactionList::where('transaction_status_id', '=', 3)->get());
            $diproses = count(TransactionList::where('transaction_status_id', '=', 5)->get());
            $dikirim = count(TransactionList::where('transaction_status_id', '=', 6)->get());
            $selesai = count(TransactionList::where('transaction_status_id', '=', 7)->get());
            $batal = count(TransactionList::whereIn('transaction_status_id', [4, 8])->get());

            return view('home.dashboard', compact(
                'user',
                'products',
                'categories',
                'stores',
                'category_id',
                'product_name',
                'banners',
                'minggu',
                'senin',
                'selasa',
                'rabu',
                'kamis',
                'jumat',
                'sabtu',
                'pending',
                'menunggu_konfirmasi',
                'approved',
                'diproses',
                'dikirim',
                'selesai',
                'batal'
            ));
        } else {
            return view('home.index', compact('products', 'categories', 'stores', 'category_id', 'product_name', 'banners'));
        }
    }
}
