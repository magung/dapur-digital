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
        $daterange = $request->query('daterange');
       

        $transactions = TransactionList::latest();
        if(!empty($daterange)) {
            $explodeDateRange = explode(" - ", $daterange);
            // var_dump($daterange);
            // var_dump($explodeDateRange);die();
            $startDate = $explodeDateRange[0] . " 00:00:00";
            $endDate = $explodeDateRange[1] . " 23:59:59";
            $transactions = $transactions->whereBetween('created_at', [$startDate, $endDate]);    
        }

        $transactions = $transactions->get();
        
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
