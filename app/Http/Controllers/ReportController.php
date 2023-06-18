<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\TransactionList;
use App\Models\TransactionProductList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function reportTransaction(Request $request)
    {
        $transactions = TransactionList::latest()
                        ->select('transaction_lists.*', 'transaction_statuses.transaction_status', 'users.name', 'users.email')
                        ->join('transaction_statuses', 'transaction_statuses.transaction_status_id', '=', 'transaction_lists.transaction_status_id')
                        ->leftJoin('users', 'users.user_id', '=', 'transaction_lists.user_id')
                        ->get();
        foreach($transactions as $transaction) {
            $transaction->products = TransactionProductList::where(['transaction_list_id' => $transaction->transaction_list_id])
                                    ->join('products', 'products.product_id', '=', 'transaction_product_lists.product_id')
                                    ->get();
        }
        return view('report.report-transaction', compact('transactions'));
    }

    public function reportStockProduct(Request $request)
    {
        $productController = new ProductController();
        $products = $productController->getProducts($request);
        return view('report.report-stock-product', compact('products'));
    }
}
