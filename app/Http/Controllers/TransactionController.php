<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Cart;
use App\Models\Courier;
use App\Models\Customer;
use App\Models\Cutting;
use App\Models\Finishing;
use App\Models\Payment;
use App\Models\PaymentStatus;
use App\Models\Product;
use App\Models\Store;
use App\Models\TransactionList;
use App\Models\TransactionProductList;
use App\Models\TransactionStatus;
use App\Models\TransactionType;
use App\Models\User;
use Facade\FlareClient\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;

class TransactionController extends Controller
{

    public function createTransactionMidtrans($data) : string
    {
        $url = 'https://api.sandbox.midtrans.com/v1/payment-links';
        $serverKey = env('SERVER_KEY');
        $base64Auth = base64_encode($serverKey . ":");

        $response = Http::withHeaders([
            "Content-Type" => "application/json",
            "Accept" => "application/json",
            "Authorization" => "Basic " . $base64Auth
        ])->post($url, $data);
        // var_dump($data);
        // Handle the response
        if ($response->successful()) {
            $transaction = $response->json();
            // var_dump($transaction);die();
            // Process the transaction data
            // ...

            return $transaction['payment_url'] ?? "";
        } else {
            $errorCode = $response->status();
            $errorMessage = $response->body();
            // var_dump($errorCode);
            // var_dump($errorMessage);die();
            // Handle the error
            // ...
            return "";
        }
    }

    public function getPaymentLinkUrl($order_id) : string
    {
        $url = "https://api.sandbox.midtrans.com/v1/payment-links/{$order_id}";
        $serverKey = env('SERVER_KEY');

        // var_dump($serverKey);
        $base64Auth = base64_encode($serverKey . ":");
        $headers = [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => 'Basic '.$base64Auth,
        ];

        $response = Http::withHeaders($headers)->get($url);
        $responseData = $response->json();
        // var_dump($responseData);die();
        return $responseData['payment_link_url'] ?? "";
    }
    public function index()
    {
        $user = Auth::user();
        $transactions = TransactionList::orderBy('transaction_list_id', 'desc')->get();
        foreach($transactions as $transaction) {
            $transaction->products = TransactionProductList::where(['transaction_list_id' => $transaction->transaction_list_id])
                                    ->join('products', 'products.product_id', '=', 'transaction_product_lists.product_id')
                                    ->get();
        }
        return view('transaction.index', compact('transactions', 'user'));
    }

    public function indexPending()
    {
        $user = Auth::user();
        $transactions = TransactionList::where('transaction_status_id', '=', 1)->orderBy('transaction_list_id', 'DESC')->get();
        foreach($transactions as $transaction) {
            $transaction->products = TransactionProductList::where(['transaction_list_id' => $transaction->transaction_list_id])
                                    ->join('products', 'products.product_id', '=', 'transaction_product_lists.product_id')
                                    ->get();
        }
        return view('transaction.index', compact('transactions', 'user'));
    }

    public function indexMenungguKonfirmasi()
    {
        $user = Auth::user();
        $transactions = TransactionList::where('transaction_status_id', '=', 2)->orderBy('transaction_list_id', 'DESC')->get();
        foreach($transactions as $transaction) {
            $transaction->products = TransactionProductList::where(['transaction_list_id' => $transaction->transaction_list_id])
                                    ->join('products', 'products.product_id', '=', 'transaction_product_lists.product_id')
                                    ->get();
        }
        return view('transaction.index', compact('transactions', 'user'));
    }

    public function indexApproved()
    {
        $user = Auth::user();
        $transactions = TransactionList::where('transaction_status_id', '=', 3)->orderBy('transaction_list_id', 'DESC')->get();
        foreach($transactions as $transaction) {
            $transaction->products = TransactionProductList::where(['transaction_list_id' => $transaction->transaction_list_id])
                                    ->join('products', 'products.product_id', '=', 'transaction_product_lists.product_id')
                                    ->get();
        }
        return view('transaction.index', compact('transactions', 'user'));
    }

    public function indexDiproses()
    {
        $user = Auth::user();
        $transactions = TransactionList::where('transaction_status_id', '=', 5 )->orderBy('transaction_list_id', 'DESC')->get();
        foreach($transactions as $transaction) {
            $transaction->products = TransactionProductList::where(['transaction_list_id' => $transaction->transaction_list_id])
                                    ->join('products', 'products.product_id', '=', 'transaction_product_lists.product_id')
                                    ->get();
        }
        return view('transaction.index', compact('transactions', 'user'));
    }

    public function indexDikirim()
    {
        $user = Auth::user();
        $transactions = TransactionList::where('transaction_status_id', '=', 6)->orderBy('transaction_list_id', 'DESC')->get();
        foreach($transactions as $transaction) {
            $transaction->products = TransactionProductList::where(['transaction_list_id' => $transaction->transaction_list_id])
                                    ->join('products', 'products.product_id', '=', 'transaction_product_lists.product_id')
                                    ->get();
        }
        return view('transaction.index', compact('transactions', 'user'));
    }

    public function indexSelesai()
    {
        $user = Auth::user();
        $transactions = TransactionList::where('transaction_status_id', '=', 7)->orderBy('transaction_list_id', 'DESC')->get();
        foreach($transactions as $transaction) {
            $transaction->products = TransactionProductList::where(['transaction_list_id' => $transaction->transaction_list_id])
                                    ->join('products', 'products.product_id', '=', 'transaction_product_lists.product_id')
                                    ->get();
        }
        return view('transaction.index', compact('transactions', 'user'));
    }

    public function indexBatal()
    {
        $user = Auth::user();
        $transactions = TransactionList::whereIn('transaction_status_id', [4,8] )->orderBy('transaction_list_id', 'DESC')->get();
        foreach($transactions as $transaction) {
            $transaction->products = TransactionProductList::where(['transaction_list_id' => $transaction->transaction_list_id])
                                    ->join('products', 'products.product_id', '=', 'transaction_product_lists.product_id')
                                    ->get();
        }
        return view('transaction.index', compact('transactions', 'user'));
    }

    public function indexTransactionCustomer()
    {
        $customer = Auth::guard('customer')->user();
        $transactions = TransactionList::latest()
                        ->select('transaction_lists.*', 'transaction_statuses.transaction_status', 'payment_statuses.payment_status')
                        ->join('transaction_statuses', 'transaction_statuses.transaction_status_id', '=', 'transaction_lists.transaction_status_id')
                        ->join('payments', 'payments.payment_id', '=', 'transaction_lists.payment_method_id')
                        ->join('payment_statuses', 'payment_statuses.payment_status_id', '=', 'transaction_lists.payment_status_id')
                        ->where('transaction_lists.customer_id', $customer->customer_id)
                        ->get();
        foreach($transactions as $transaction) {
            $transaction->products = TransactionProductList::where(['transaction_list_id' => $transaction->transaction_list_id])
                                    ->join('products', 'products.product_id', '=', 'transaction_product_lists.product_id')
                                    ->get();
        }
        return view('transaction-customer.index', compact('transactions', 'customer'));
    }
    public function create()
    {
        $user = Auth::user();
        $store_id = $user->store_id;
        $customers = Customer::latest()->get(); // where role is pelanggan
        $payments = Payment::where('payment_id', '<>', 2)->get();
        $transaction_statuses = TransactionStatus::latest()->get();
        $types = TransactionType::latest()->get();
        $stores = Store::latest()->get();
        $payment_statuses = PaymentStatus::latest()->get();
        $carts = Cart::latest()->where('customer_id', null)->get();
        $couriers = Courier::where('status', 1)->get();
        $total_harga = 0;
        foreach($carts as $cart) {
            $total_harga += $cart->total_price;
        }
        return view('transaction.create', 
                    compact(
                            'customers', 
                            'payments', 
                            'transaction_statuses', 
                            'types',
                            'stores',
                            'payment_statuses',
                            'store_id',
                            'carts',
                            'total_harga',
                            'couriers'
                        ));
    }

    public function storeTransactionCustomer(Request $request)
    {
        $customer = Auth::guard('customer')->user();
        
        $validators = [
            'transaction_type_id' => 'required',
            'payment_method_id' => 'required',
            'final_price' => 'required'
        ];

        if($request->transaction_type_id == 1) {
            $validators['store_id'] = 'required';
        } else {
            $validators['address_id'] = 'required';
            $validators['courier_id'] = 'required';
            $validators['courier_price'] = 'required';
        }

        $this->validate($request, $validators);

        $datasend = [
            'transaction_type_id' => $request->transaction_type_id,
            'transaction_status_id' => 1,
            'payment_method_id' => $request->payment_method_id,
            'customer_id' => $customer->customer_id,
            'final_price' => $request->final_price,
            'payment_status_id' => 2,
            'created_by' => $customer->customer_id
        ];

        if($request->transaction_type_id == 1) {
            $datasend['store_id'] = $request->store_id;
        } else {
            $datasend['address_id'] = $request->address_id;
            $datasend['courier_id'] = $request->courier_id;
            $datasend['courier_price'] = $request->courier_price;
        }
        
        $transaction = TransactionList::create($datasend);

        $carts = Cart::latest()->where('customer_id', Auth::id())->get();

        foreach($carts as $cart) {
            TransactionProductList::create([
                'transaction_list_id' => $transaction->transaction_list_id,
                'product_id' => $cart->product_id,
                'qty' => $cart->qty,
                'panjang' => $cart->panjang,
                'lebar' => $cart->lebar,
                'satuan' => $cart->satuan,
                'price' => $cart->price,
                'total_price' => $cart->total_price,
                'finishing_id' => $cart->finishing_id,
                'finishing_price' => $cart->finishing_price,
                'cutting_id' => $cart->cutting_id,
                'cutting_price' => $cart->cutting_price,
                'file' => $cart->file,
                'luas' => $cart->luas,
            ]);
            $product = Product::findOrFail($cart->product_id);
            $product->stock -= $cart->qty;
            $product->save();
            $cart = Cart::findOrFail($cart->cart_id);
            $cart->delete();
        }
        $payment_url = null;
        if($request->payment_method_id == 2){
            $body = [
                "transaction_details" => [
                    "order_id" => $transaction->transaction_list_id,
                    "gross_amount" => $transaction->final_price
                ],
                "usage_limit" => 1
            ];

            
            $payment_url = $this->createTransactionMidtrans($body);
            if($payment_url != "") {
                return redirect()->away($payment_url)->with('new_tab', true);
                
            }
        }

        if ($transaction) {
            return redirect()
                ->route('transaction.customer.index')
                ->with([
                    'success' => 'Sukses'
                ]);
        } else {
            return redirect()
                ->back()
                ->withInput()
                ->with([
                    'error' => 'Gagal'
                ]);
        }
    }

    public function store(Request $request)
    {
        
        $this->validate($request, [
            'transaction_type' => 'required',
            'transaction_status' => 'required',
            'payment_method' => 'required',
            'final_price' => 'required',
            'payment_status' => 'required'
        ]);
        $address_id = $request->address;
        
        if($request->customer == "0" && $request->transaction_type == 2) {
            $address = Address::create([
                'address' => $request->address_text,
                'contact_name' => $request->nama_pelanggan,
                'contact_phone' => $request->nomor_pelanggan,
                'name' => 'Rumah',
                'customer_id' => $request->customer,
                'postal_code' => $request->kode_pos,
            ]);
            $address_id = $address->address_id;
        } else {
            $address = Address::where('customer_id',$request->customer)->get();
            if(count($address) == 0 && $request->transaction_type == 2) {
                $address = Address::create([
                    'address' => $request->address_text,
                    'contact_name' => $request->nama_pelanggan,
                    'contact_phone' => $request->nomor_pelanggan,
                    'name' => 'Rumah',
                    'customer_id' => $request->customer,
                    'postal_code' => $request->kode_pos,
                ]);
                $address_id = $address->address_id;
            }
        }
        $datasend = [
            'transaction_type_id' => $request->transaction_type,
            'transaction_status_id' => $request->transaction_status,
            'payment_method_id' => $request->payment_method,
            'customer_id' => $request->customer,
            'user_id' => Auth::id(),
            'final_price' => $request->final_price,
            'payment_status_id' => $request->payment_status,
            'created_by' => Auth::id()
        ];

        if($request->transaction_type == 2) {
            $datasend['courier_id'] = $request->courier;
            $datasend['courier_price'] = $request->ongkir;
            $datasend['address_id'] = $address_id;
        } else {
            $datasend['store_id'] = $request->store;
        }
        
        $transaction = TransactionList::create($datasend);
        $carts = Cart::latest()->where('user_id', Auth::id())->get();

        foreach($carts as $cart) {
            TransactionProductList::create([
                'transaction_list_id' => $transaction->transaction_list_id,
                'product_id' => $cart->product_id,
                'qty' => $cart->qty,
                'panjang' => $cart->panjang,
                'lebar' => $cart->lebar,
                'satuan' => $cart->satuan,
                'price' => $cart->price,
                'total_price' => $cart->total_price,
                'finishing_id' => $cart->finishing_id,
                'finishing_price' => $cart->finishing_price,
                'cutting_id' => $cart->cutting_id,
                'cutting_price' => $cart->cutting_price,
                'file' => $cart->file,
            ]);
            $cart = Cart::findOrFail($cart->cart_id);
            $cart->delete();
        }

        if ($transaction) {
            return redirect()
                ->route('transaction.index')
                ->with([
                    'success' => 'Sukses'
                ]);
        } else {
            return redirect()
                ->back()
                ->withInput()
                ->with([
                    'error' => 'Gagal'
                ]);
        }
    }

    public function edit($id)
    {
        $user = Auth::user();
        $store_id = $user->store_id;
        $users = User::latest()->where('role_id', 4)->get();
        $payments = Payment::latest()->get();
        $statuses = TransactionStatus::latest()->get();
        $types = TransactionType::latest()->get();
        $stores = Store::latest()->get();
        $payment_statuses = PaymentStatus::latest()->get();
        $transaction = TransactionList::findOrFail($id);
        $transaction_product_lists = TransactionProductList::latest()
                ->join('products', 'products.product_id', '=', 'transaction_product_lists.product_id')
                ->leftJoin('finishings', 'finishings.finishing_id', '=', 'transaction_product_lists.finishing_id')
                ->leftJoin('cuttings', 'cuttings.cutting_id', '=', 'transaction_product_lists.cutting_id')
                ->select('transaction_product_lists.*', 'products.product_name', 'finishings.finishing', 'cuttings.cutting')
                ->where('transaction_list_id', $transaction->transaction_list_id)->get();
        $total_harga = 0;
        foreach($transaction_product_lists as $product) {
            $total_harga += $product->total_price;
        }
        return view('transaction.edit', compact(
            'transaction', 
            'users',
            'payments', 
            'statuses', 
            'types',
            'stores',
            'payment_statuses',
            'store_id',
            'transaction_product_lists',
            'total_harga'
        ));
    }

    public function detailTransaction($id) {
        $transaction = TransactionList::findOrFail($id);
        return $transaction;
    }

    public function detailTransactionCustomer($id)
    {
        // $transaction = TransactionList::latest()
        //     ->select('transaction_lists.*', 'transaction_statuses.transaction_status', 'payment_statuses.payment_status', 'transaction_types.transaction_type', 'payments.payment_method')
        //     ->join('transaction_statuses', 'transaction_statuses.transaction_status_id', '=', 'transaction_lists.transaction_status_id')
        //     ->join('transaction_types', 'transaction_types.transaction_type_id', '=', 'transaction_lists.transaction_type_id')
        //     ->join('payments', 'payments.payment_id', '=', 'transaction_lists.payment_method_id')
        //     ->join('payment_statuses', 'payment_statuses.payment_status_id', '=', 'transaction_lists.payment_status_id')
        //     ->where('transaction_lists.transaction_list_id', $id)
        //     ->first();
        // $transaction_product_lists = TransactionProductList::latest()
        //         ->join('products', 'products.product_id', '=', 'transaction_product_lists.product_id')
        //         ->leftJoin('finishings', 'finishings.finishing_id', '=', 'transaction_product_lists.finishing_id')
        //         ->leftJoin('cuttings', 'cuttings.cutting_id', '=', 'transaction_product_lists.cutting_id')
        //         ->select('transaction_product_lists.*', 'products.product_name', 'finishings.finishing', 'cuttings.cutting')
        //         ->where('transaction_list_id', $id)->get();
        $transaction = TransactionList::findOrFail($id);
        $transaction_product_lists = TransactionProductList::latest()->where('transaction_list_id', $id)->get();
        $total_harga = 0;
        foreach($transaction_product_lists as $transaction_product) {
            $total_harga += $transaction_product->total_price;
        }
        return view('transaction-customer.detail', compact(
            'transaction', 
            'transaction_product_lists',
            'total_harga'
        ));
    }
    public function pembayaran($id)
    {
        $payments = Payment::latest()->get();
        $statuses = TransactionStatus::latest()->get();
        $types = TransactionType::latest()->get();
        $transaction = TransactionList::findOrFail($id);
        if($transaction->payment_method_id == 2) {
            $payment_link = $this->getPaymentLinkUrl($id);
            return redirect()->away($payment_link)->with('new_tab', true);
        }

        return view('transaction-customer.pembayaran', compact('transaction', 'payments', 'types'));
    }

    public function updatePembayaran(Request $request, $id)
    {
        $this->validate($request, [
            'bukti_pembayaran' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        
        $datasend = [
            'transaction_status_id' => 2,
            'updated_by' => Auth::id()
        ];

        if(isset($request->bukti_pembayaran)) {
            $bukti_pembayaran = 'BUKTI-PEMBAYARAN-'.Auth::id().'-'.time().'.'.$request->bukti_pembayaran->extension();
            $request->bukti_pembayaran->move(public_path('bukti-pembayaran'), $bukti_pembayaran);
            $datasend['bukti_pembayaran'] = $bukti_pembayaran;
        }

        $transaction = TransactionList::findOrFail($id);
        $transaction->update($datasend);
        
        if ($transaction) {
            return redirect()
                ->route('transaction.customer.index')
                ->with([
                    'success' => 'Sukses'
                ]);
        } else {
            return redirect()
                ->back()
                ->withInput()
                ->with([
                    'error' => 'Gagal'
                ]);
        }
    }

    public function detail($id)
    {
        $user = Auth::user();
        $role_id = $user->role_id;
        $store_id = $user->store_id;
        $users = User::latest()->where('role_id', 4)->get();
        $payments = Payment::latest()->get();
        $statuses = TransactionStatus::latest()->get();
        $types = TransactionType::latest()->get();
        $stores = Store::latest()->get();
        $payment_statuses = PaymentStatus::latest()->get();
        $transaction = TransactionList::findOrFail($id);
        $transaction_product_lists = TransactionProductList::latest()
                ->join('products', 'products.product_id', '=', 'transaction_product_lists.product_id')
                ->leftJoin('finishings', 'finishings.finishing_id', '=', 'transaction_product_lists.finishing_id')
                ->leftJoin('cuttings', 'cuttings.cutting_id', '=', 'transaction_product_lists.cutting_id')
                ->select('transaction_product_lists.*', 'products.product_name', 'finishings.finishing', 'cuttings.cutting')
                ->where('transaction_list_id', $transaction->transaction_list_id)->get();
        $total_harga = 0;
        foreach($transaction_product_lists as $product) {
            $total_harga += $product->total_price;
        }
        return view('transaction.detail', compact(
            'transaction', 
            'users',
            'payments', 
            'statuses', 
            'types',
            'stores',
            'payment_statuses',
            'store_id',
            'transaction_product_lists',
            'total_harga',
            'role_id'
        ));
    }
    

    public function createProductList($id)
    {
        $user = Auth::user();
        $store_id = $user->store_id;
        $products = Product::latest()
                    ->join('categories', 'categories.category_id', '=', 'products.category_id')
                    ->select('products.*', 'categories.satuan')
                    ->where('store_id', $store_id)->get();
        $finishings = Finishing::latest()->get();
        $cuttings = Cutting::latest()->get();
        $transaction_list_id = $id;
        return view('transaction.product.create', compact('products', 'finishings', 'cuttings', 'transaction_list_id'));
    }

    public function storeProductList(Request $request)
    {
        
        $validators = [
            'product_id'    => 'required',
            'qty'           => 'required|numeric|min:1',
            'total_price'   => 'required|numeric',
            'satuan'        => 'required',
            'transaction_list_id'    => 'required',
        ];

        if($request->satuan == 'M') {
            $validators['panjang'] = 'required|numeric|min:1';
            $validators['lebar'] = 'required|numeric|min:1';
        }

        $this->validate($request, $validators);

        $transaction_list_id = $request->transaction_list_id;

        $datasend = [
            'product_id' => $request->product_id,
            'qty' => $request->qty,
            'price' => $request->price,
            'total_price' => $request->total_price,
            'transaction_list_id' => $transaction_list_id,
            'satuan' => $request->satuan,
            'finishing_id' => $request->finishing_id,
            'finishing_price' => $request->finishing_price,
            'cutting_id' => $request->cutting_id,
            'cutting_price' => $request->cutting_price
        ];

        if($request->satuan == 'M') {
            $datasend['panjang'] = $request->panjang;
            $datasend['lebar'] = $request->lebar;
        }

        $product = TransactionProductList::latest()
            ->where('transaction_list_id', $transaction_list_id)
            ->where('product_id', $request->product_id)->first();

        $transaction = TransactionList::findOrFail($transaction_list_id);

        if($product) {
            $transaction->final_price = $transaction->final_price - $product->total_price + $request->total_price;
            $transaction->save();
            $product->update($datasend);
        } else {
            $transaction->final_price = $transaction->final_price + $request->total_price;
            $transaction->save();
            $product = TransactionProductList::create($datasend);
        }

        if ($product) {
            return redirect()
                ->route('transaction.edit', $transaction_list_id)
                ->with([
                    'success' => 'Sukses'
                ]);
        } else {
            return redirect()
                ->back()
                ->withInput()
                ->with([
                    'error' => 'Gagal'
                ]);
        }
    }

    public function editProductList($id)
    {
        $user = Auth::user();
        $store_id = $user->store_id;
        $products = Product::latest()
                    ->join('categories', 'categories.category_id', '=', 'products.category_id')
                    ->select('products.*', 'categories.satuan')
                    ->where('store_id', $store_id)->get();
        $finishings = Finishing::latest()->get();
        $cuttings = Cutting::latest()->get();
        $transaction_product_list = TransactionProductList::findOrFail($id);
        return view('transaction.product.edit', compact('products', 'finishings', 'cuttings', 'transaction_product_list'));
    }

    public function updateProductList(Request $request, $id)
    {
        $validators = [
            'product_id'    => 'required',
            'qty'           => 'required|numeric|min:1',
            'total_price'   => 'required|numeric',
            'satuan'        => 'required'
        ];

        if($request->satuan == 'M') {
            $validators['panjang'] = 'required|numeric|min:1';
            $validators['lebar'] = 'required|numeric|min:1';
        }

        $this->validate($request, $validators);

        $datasend = [
            'product_id' => $request->product_id,
            'qty' => $request->qty,
            'price' => $request->price,
            'total_price' => $request->total_price,
            'satuan' => $request->satuan,
            'finishing_id' => $request->finishing_id,
            'finishing_price' => $request->finishing_price,
            'cutting_id' => $request->cutting_id,
            'cutting_price' => $request->cutting_price,
        ];

        if($request->satuan == 'M') {
            $datasend['panjang'] = $request->panjang;
            $datasend['lebar'] = $request->lebar;
        }

        $product = TransactionProductList::findOrFail($id);

        $transaction = TransactionList::findOrFail($product->transaction_list_id);
        $transaction->final_price = $transaction->final_price - $product->total_price + $request->total_price;
        $transaction->save();
        $product->update($datasend);

        if ($product) {
            return redirect()
                ->route('transaction.edit', $product->transaction_list_id)
                ->with([
                    'success' => 'Sukses'
                ]);
        } else {
            return redirect()
                ->back()
                ->withInput()
                ->with([
                    'error' => 'Gagal'
                ]);
        }
    }

    public function update(Request $request, $id)
    {
        
        $this->validate($request, [
            'store_id' => 'required',
            'transaction_type_id' => 'required',
            'transaction_status_id' => 'required',
            'payment_method_id' => 'required',
            'user_id' => 'required',
            'final_price' => 'required',
            'payment_status_id' => 'required',
        ]);
        
        $datasend = [
            'store_id' => $request->store_id,
            'transaction_type_id' => $request->transaction_type_id,
            'transaction_status_id' => $request->transaction_status_id,
            'payment_method_id' => $request->payment_method_id,
            'user_id' => $request->user_id,
            'final_price' => $request->final_price,
            'payment_status_id' => $request->payment_status_id,
            'updated_by' => Auth::id()
        ];

        $transaction = TransactionList::findOrFail($id);
        $transaction->update($datasend);
        
        if ($transaction) {
            return redirect()
                ->route('transaction.index')
                ->with([
                    'success' => 'Sukses'
                ]);
        } else {
            return redirect()
                ->back()
                ->withInput()
                ->with([
                    'error' => 'Gagal'
                ]);
        }
    }

    public function destroy($id)
    {
        $transaction = TransactionList::findOrFail($id);
        $transaction_product_lists = TransactionProductList::latest()->where('transaction_list_id', $id)->get();
        foreach($transaction_product_lists as $product) {
            $product->delete();
        }
        $transaction->delete();

        if ($transaction) {
            return redirect()
                ->route('transaction.index')
                ->with([
                    'success' => 'Sukses'
                ]);
        } else {
            return redirect()
                ->route('transaction.index')
                ->with([
                    'error' => 'Gagal'
                ]);
        }
    }

    public function destroyProductList($id)
    {
        $transaction_product_list = TransactionProductList::findOrFail($id);
        $transaction_list_id = $transaction_product_list->transaction_list_id;
        $transaction = TransactionList::findOrFail($transaction_list_id);
        $transaction->final_price = $transaction->final_price - $transaction_product_list->total_price;
        $transaction->save();
        $transaction_product_list->delete();

        if($transaction_product_list) {
            return redirect()
                ->route('transaction.edit', $transaction_list_id)
                ->with([
                    'success' => 'Sukses'
                ]);
        } else {
            return redirect()
                ->route('transaction.edit', $transaction_list_id)
                ->with([
                    'error' => 'Gagal'
                ]);
        }
    }

    public function updateTransactionStatus(Request $request, $id)
    {
        $status = $request->status;
        $transaction = TransactionList::findOrFail($id);
        $transaction->transaction_status_id = $status;
        $transaction->save();
        if($transaction) {
            return redirect()
                ->route('transaction.index')
                ->with([
                    'success' => 'Sukses'
                ]);
        } else {
            return redirect()
                ->route('transaction.index')
                ->with([
                    'error' => 'Gagal'
                ]);
        }
    }

    public function updatePaymentStatus(Request $request, $id)
    {
        $status = $request->status;
        $transaction = TransactionList::findOrFail($id);
        $transaction->payment_status_id = $status;
        $transaction->save();
        if($transaction) {
            return redirect()
                ->route('transaction.index')
                ->with([
                    'success' => 'Sukses'
                ]);
        } else {
            return redirect()
                ->route('transaction.index')
                ->with([
                    'error' => 'Gagal'
                ]);
        }
    }

    public function paymentNotifHandler(Request $request)
    {
        $transaction_status = $request->transaction_status;
        $order_id = $request->order_id;
        $parts = explode("-", $order_id);
        $id = $parts[0];
        $transaction = TransactionList::findOrFail($id);
        if($transaction_status == 'capture' || $transaction_status == 'settlement'){
            $transaction->payment_status_id = 1; // LUNAS
            $transaction->transaction_status_id = 2; // Menunggu Konfirmasi
            $transaction->save();
        } else if ($transaction_status == 'deny' || $transaction_status == 'expire' || $transaction_status == 'cancel') {
            
            $transaction->transaction_status_id = 4; // 
            $transaction->save();
        }

        $data = [
            'message' => 'success',
            'order_id' => $order_id
        ];
    
        return response()->json($data, 200);
    }



}
