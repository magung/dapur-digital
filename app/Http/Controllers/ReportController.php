<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\TransactionList;
use App\Models\TransactionProductList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index()
    {
        $products = DB::table('products')
            ->select(['products.*', 'categories.category_name','categories.satuan', 'stores.branch_name'])
            ->join('categories', 'categories.id', '=', 'products.category_id')
            ->join('stores', 'stores.id', '=', 'products.store_id')
            ->get();
        $transactions = TransactionList::latest()
                        ->select('transaction_lists.*', 'transaction_statuses.status', 'users.name', 'users.email')
                        ->join('transaction_statuses', 'transaction_statuses.id', '=', 'transaction_lists.transaction_status_id')
                        ->leftJoin('users', 'users.id', '=', 'transaction_lists.user_id')
                        ->get();
        foreach($transactions as $transaction) {
            $transaction->products = TransactionProductList::where(['transaction_id' => $transaction->id])
                                    ->join('products', 'products.id', '=', 'transaction_product_lists.product_id')
                                    ->get();
        }
        return view('report.index', compact('products', 'transactions'));
    }
}
