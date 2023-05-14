<?php

namespace App\Http\Controllers;

use App\Models\TransactionType;
use Illuminate\Http\Request;

class TransactionTypeController extends Controller
{
    //
    public function index() {
        $transaction_types = TransactionType::latest()->get();
        return view('transaction-type.index', compact('transaction_types'));
    }
}
