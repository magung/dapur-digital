<?php

namespace App\Http\Controllers;

use App\Models\TransactionStatus;
use Illuminate\Http\Request;

class TransactionStatusController extends Controller
{
    public function index() {
        $transaction_statuses = TransactionStatus::latest()->get();
        return view('transaction-status.index', compact('transaction_statuses'));
    }
}
