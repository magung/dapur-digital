<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use charlieuki\ReceiptPrinter\ReceiptPrinter as ReceiptPrinter;
use Illuminate\Support\Facades\Auth;
use PDF;
class PrintController extends Controller
{
    public function printPDF($id)
    {
        $user = Auth::user();
        $transaction = new TransactionController();
        $detail_transaction = $transaction->detailTransaction($id);

        $data = [
            "detail_transaction" => $detail_transaction,
            "user" => $user
        ];
        $pdf = PDF::loadView('struk.transaksi-detail', $data)->setOption(['dpi' => 200, 'defaultFont' => 'sans-serif']);
        $namaFile = "transaksi-".$detail_transaction->transaction_list_id . ".pdf";
        return $pdf->download($namaFile);
    }
    //
    // public function printStruk()
    // {
    //     // Set params
    //     $mid = '123123456';
    //     $store_name = 'YOURMART';
    //     $store_address = 'Mart Address';
    //     $store_phone = '1234567890';
    //     $store_email = 'yourmart@email.com';
    //     $store_website = 'yourmart.com';
    //     $tax_percentage = 10;
    //     $transaction_list_id = 'TX123ABC456';
    //     $currency = 'Rp';
    //     $image_path = 'logo.png';

    //     // Set items
    //     $items = [
    //         [
    //             'name' => 'French Fries (tera)',
    //             'qty' => 2,
    //             'price' => 65000,
    //         ],
    //         [
    //             'name' => 'Roasted Milk Tea (large)',
    //             'qty' => 1,
    //             'price' => 24000,
    //         ],
    //         [
    //             'name' => 'Honey Lime (large)',
    //             'qty' => 3,
    //             'price' => 10000,
    //         ],
    //         [
    //             'name' => 'Jasmine Tea (grande)',
    //             'qty' => 3,
    //             'price' => 8000,
    //         ],
    //     ];

    //     // Init printer
    //     $printer = new ReceiptPrinter;
    //     $printer->init(
    //         config('receiptprinter.connector_type'),
    //         config('receiptprinter.connector_descriptor')
    //     );

    //     // Set store info
    //     $printer->setStore($mid, $store_name, $store_address, $store_phone, $store_email, $store_website);

    //     // Set currency
    //     $printer->setCurrency($currency);

    //     // Add items
    //     foreach ($items as $item) {
    //         $printer->addItem(
    //             $item['name'],
    //             $item['qty'],
    //             $item['price']
    //         );
    //     }
    //     // Set tax
    //     $printer->setTax($tax_percentage);

    //     // Calculate total
    //     $printer->calculateSubTotal();
    //     $printer->calculateGrandTotal();

    //     // Set transaction ID
    //     $printer->setTransactionID($transaction_list_id);

    //     // Set logo
    //     // Uncomment the line below if $image_path is defined
    //     $printer->setLogo($image_path);

    //     // Set QR code
    //     $printer->setQRcode([
    //         'tid' => $transaction_list_id,
    //     ]);

    //     // Print receipt
    //     $printer->printReceipt();
    // }
}
