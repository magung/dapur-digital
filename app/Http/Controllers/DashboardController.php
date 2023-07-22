<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;
use App\Models\TransactionList;
use Carbon\Carbon;
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

            $daysOfWeek = [
                'minggu',
                'senin',
                'selasa',
                'rabu',
                'kamis',
                'jumat',
                'sabtu'
            ];
            
            $minggu = count(DB::table('transaction_lists')
                ->whereRaw("WEEK(created_at) = WEEK(CURDATE()) and  DAYNAME(created_at)  = 'Sunday'")
                ->get());
            $senin = count(DB::table('transaction_lists')
                ->whereRaw("WEEK(created_at) = WEEK(CURDATE()) and  DAYNAME(created_at)  = 'Monday'")
                ->get());
            $selasa = count(DB::table('transaction_lists')
                ->whereRaw("WEEK(created_at) = WEEK(CURDATE()) and  DAYNAME(created_at)  = 'Tuesday'")
                ->get());
            $rabu = count(DB::table('transaction_lists')
                ->whereRaw("WEEK(created_at) = WEEK(CURDATE()) and  DAYNAME(created_at)  = 'Wednesday'")
                ->get());
            $kamis = count(DB::table('transaction_lists')
                ->whereRaw("WEEK(created_at) = WEEK(CURDATE()) and  DAYNAME(created_at)  = 'Thursday'")
                ->get());
            $jumat = count(DB::table('transaction_lists')
                ->whereRaw("WEEK(created_at) = WEEK(CURDATE()) and  DAYNAME(created_at)  = 'Friday'")
                ->get());
            $sabtu = count(DB::table('transaction_lists')
                ->whereRaw("WEEK(created_at) = WEEK(CURDATE()) and  DAYNAME(created_at)  = 'Saturday'")
                ->get());

            $pending = count(TransactionList::where('transaction_status_id', '=', 1)->get());
            $menunggu_konfirmasi = count(TransactionList::where('transaction_status_id', '=', 2)->get());
            $approved = count(TransactionList::where('transaction_status_id', '=', 3)->get());
            $diproses = count(TransactionList::where('transaction_status_id', '=', 5)->get());
            $dikirim = count(TransactionList::where('transaction_status_id', '=', 6)->get());
            $selesai = count(TransactionList::where('transaction_status_id', '=', 7)->get());
            $batal = count(TransactionList::whereIn('transaction_status_id', [4, 8])->get());
             
            $januari= count(DB::table('transaction_lists')
                ->whereRaw("DATE_FORMAT(created_at, '%Y') = YEAR(CURDATE()) and  DATE_FORMAT(created_at, '%m') = '01'")
                ->get());
            $februari=  count(DB::table('transaction_lists')
                ->whereRaw("DATE_FORMAT(created_at, '%Y') = YEAR(CURDATE()) and  DATE_FORMAT(created_at, '%m') = '02'")
                ->get());
            $maret=  count(DB::table('transaction_lists')
                ->whereRaw("DATE_FORMAT(created_at, '%Y') = YEAR(CURDATE()) and  DATE_FORMAT(created_at, '%m') = '03'")
                ->get());
            $april=  count(DB::table('transaction_lists')
                ->whereRaw("DATE_FORMAT(created_at, '%Y') = YEAR(CURDATE()) and  DATE_FORMAT(created_at, '%m') = '04'")
                ->get());
            $mei=  count(DB::table('transaction_lists')
            ->whereRaw("DATE_FORMAT(created_at, '%Y') = YEAR(CURDATE()) and  DATE_FORMAT(created_at, '%m') = '05'")
            ->get());
            $juni=  count(DB::table('transaction_lists')
            ->whereRaw("DATE_FORMAT(created_at, '%Y') = YEAR(CURDATE()) and  DATE_FORMAT(created_at, '%m') = '06'")
            ->get());
            $juli= count(DB::table('transaction_lists')
                ->whereRaw("DATE_FORMAT(created_at, '%Y') = YEAR(CURDATE()) and  DATE_FORMAT(created_at, '%m') = '07'")
                ->get());
            $agustus=  count(DB::table('transaction_lists')
            ->whereRaw("DATE_FORMAT(created_at, '%Y') = YEAR(CURDATE()) and  DATE_FORMAT(created_at, '%m') = '08'")
            ->get());
            $sebtember=  count(DB::table('transaction_lists')
            ->whereRaw("DATE_FORMAT(created_at, '%Y') = YEAR(CURDATE()) and  DATE_FORMAT(created_at, '%m') = '09'")
            ->get());
            $oktober=  count(DB::table('transaction_lists')
            ->whereRaw("DATE_FORMAT(created_at, '%Y') = YEAR(CURDATE()) and  DATE_FORMAT(created_at, '%m') = '10'")
            ->get());
            $november=  count(DB::table('transaction_lists')
            ->whereRaw("DATE_FORMAT(created_at, '%Y') = YEAR(CURDATE()) and  DATE_FORMAT(created_at, '%m') = '11'")
            ->get());
            $desember =  count(DB::table('transaction_lists')
            ->whereRaw("DATE_FORMAT(created_at, '%Y') = YEAR(CURDATE()) and  DATE_FORMAT(created_at, '%m') = '12'")
            ->get());
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
                'batal',
                'januari',
                'februari',
                'maret',
                'april',
                'mei',
                'juni',
                'juli',
                'agustus',
                'sebtember',
                'oktober',
                'november',
                'desember',
            ));
        } else {
            return view('home.index', compact('products', 'categories', 'stores', 'category_id', 'product_name', 'banners'));
        }
    }
}
