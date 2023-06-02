<?php

namespace App\Http\Controllers;

use App\Models\Cart;
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

class TransactionController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $transactions = TransactionList::latest()
                        ->select('transaction_lists.*', 'transaction_statuses.transaction_status', 'users.name', 'users.email', 'payment_statuses.payment_status')
                        ->join('transaction_statuses', 'transaction_statuses.transaction_status_id', '=', 'transaction_lists.transaction_status_id')
                        ->join('payment_statuses', 'payment_statuses.payment_status_id', '=', 'transaction_lists.payment_status_id')
                        ->leftJoin('users', 'users.user_id', '=', 'transaction_lists.user_id')
                        ->get();
        foreach($transactions as $transaction) {
            $transaction->products = TransactionProductList::where(['transaction_list_id' => $transaction->transaction_list_id])
                                    ->join('products', 'products.product_id', '=', 'transaction_product_lists.product_id')
                                    ->get();
        }
        return view('transaction.index', compact('transactions', 'user'));
    }

    public function indexPelanggan()
    {
        $user = Auth::user();
        $transactions = TransactionList::latest()
                        ->select('transaction_lists.*', 'transaction_statuses.transaction_status', 'users.name', 'users.email')
                        ->join('transaction_statuses', 'transaction_statuses.transaction_status_id', '=', 'transaction_lists.transaction_status_id')
                        ->join('users', 'users.user_id', '=', 'transaction_lists.user_id')
                        ->where('transaction_lists.user_id', Auth::id())
                        ->get();
        foreach($transactions as $transaction) {
            $transaction->products = TransactionProductList::where(['transaction_list_id' => $transaction->transaction_list_id])
                                    ->join('products', 'products.product_id', '=', 'transaction_product_lists.product_id')
                                    ->get();
        }
        return view('transaction.index', compact('transactions', 'user'));
    }
    public function create()
    {
        $user = Auth::user();
        // echo "<pre>";
        // var_dump($user);
        // echo "</pre>";
        $store_id = $user->store_id;
        // var_dump($store_id);
        // $products = Product::latest()
        //             ->join('categories', 'categories.category_id', '=', 'products.category_id')
        //             ->select('products.*', 'categories.satuan')
        //             ->where('store_id', $store_id)->get();
        // echo "<pre>";
        // var_dump($products);
        // echo "</pre>";
        // $finishings = Finishing::latest()->get();
        // $cuttings = Cutting::latest()->get();
        $users = User::latest()->where('role_id', 4)->get(); // where role is pelanggan
        $payments = Payment::latest()->get();
        $statuses = TransactionStatus::latest()->get();
        $types = TransactionType::latest()->get();
        $stores = Store::latest()->get();
        $payment_statuses = PaymentStatus::latest()->get();
        $carts = Cart::latest()
                ->join('products', 'products.product_id', '=', 'carts.product_id')
                ->leftJoin('finishings', 'finishings.finishing_id', '=', 'carts.finishing_id')
                ->leftJoin('cuttings', 'cuttings.cutting_id', '=', 'carts.cutting_id')
                ->select('carts.*', 'products.product_name', 'finishings.finishing', 'cuttings.cutting')
                ->where('user_id', $user->user_id)->get();
        $total_harga = 0;
        foreach($carts as $cart) {
            $total_harga += $cart->total_price;
        }
        return view('transaction.create', 
                    compact(
                            // 'products', 
                            // 'finishings', 
                            // 'cuttings', 
                            'users', 
                            'payments', 
                            'statuses', 
                            'types',
                            'stores',
                            'payment_statuses',
                            'store_id',
                            'carts',
                            'total_harga'
                        ));
    }

    public function createTransacationPelanggan()
    {
        $customer = Auth::guard('customer')->user();
        $payments = Payment::latest()->get();
        $statuses = TransactionStatus::latest()->get();
        $types = TransactionType::latest()->get();
        $stores = Store::latest()->get();
        $payment_statuses = PaymentStatus::latest()->get();
        $carts = Cart::latest()
                ->join('products', 'products.product_id', '=', 'carts.product_id')
                ->leftJoin('finishings', 'finishings.finishing_id', '=', 'carts.finishing_id')
                ->leftJoin('cuttings', 'cuttings.cutting_id', '=', 'carts.cutting_id')
                ->select('carts.*', 'products.product_name', 'finishings.finishing', 'cuttings.cutting')
                ->where('customer_id', $customer->customer_id)->get();
        $total_harga = 0;
        foreach($carts as $cart) {
            $total_harga += $cart->total_price;
        }
        return view('cart-list.create', 
                    compact(
                            'payments', 
                            'statuses', 
                            'types',
                            'stores',
                            'payment_statuses',
                            'carts',
                            'total_harga'
                        ));
    }

    public function storePelanggan(Request $request)
    {
        
        
        $this->validate($request, [
            'store_id' => 'required',
            'transaction_type_id' => 'required',
            'payment_method_id' => 'required',
            'final_price' => 'required',
            'file' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        // var_dump($request);
        // die();
        
        $datasend = [
            'store_id' => $request->store_id,
            'transaction_type_id' => $request->transaction_type_id,
            'transaction_status_id' => 1,
            'payment_method_id' => $request->payment_method_id,
            'user_id' => Auth::id(),
            'final_price' => $request->final_price,
            'payment_status_id' => 2,
            'created_by' => Auth::id()
        ];

        if(isset($request->file)) {
            $file = 'CETAK-'.$request->user_id.'-'.time().'.'.$request->file->extension();
            $request->file->move(public_path('files-cetak'), $file);
            $datasend['file'] = $file;
        }
        
        $transaction = TransactionList::create($datasend);
        // var_dump($transaction);
        // die();

        $carts = Cart::latest()->where('customer_id', Auth::id())->get();
        //  var_dump($carts);
        // die();
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
            ]);
            $cart = Cart::findOrFail($cart->cart_id);
            $cart->delete();
        }

        if ($transaction) {
            return redirect()
                ->route('transaction-list')
                ->with([
                    'success' => 'New transaction has been created successfully'
                ]);
        } else {
            return redirect()
                ->back()
                ->withInput()
                ->with([
                    'error' => 'Some problem occurred, please try again'
                ]);
        }
    }

    public function store(Request $request)
    {
        
        // $validations = [
        //     'store_id' => 'required',
        //     'transaaction_type_id' => 'required',
        //     'transaaction_status_id' => 'required',
        //     'payment_method_id' => 'required',
        //     'user_id' => 'required',
        //     'final_price' => 'required|numeric|min:1',
        //     'payment_status_id' => 'required',
        // ];
        
        $this->validate($request, [
            'store_id' => 'required',
            'transaction_type_id' => 'required',
            'transaction_status_id' => 'required',
            'payment_method_id' => 'required',
            'user_id' => 'required',
            'final_price' => 'required',
            'payment_status_id' => 'required',
            'file' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        
        $datasend = [
            'store_id' => $request->store_id,
            'transaction_type_id' => $request->transaction_type_id,
            'transaction_status_id' => $request->transaction_status_id,
            'payment_method_id' => $request->payment_method_id,
            'user_id' => $request->user_id,
            'final_price' => $request->final_price,
            'payment_status_id' => $request->payment_status_id,
            'created_by' => Auth::id()
        ];

        if(isset($request->file)) {
            $file = 'CETAK-'.$request->user_id.'-'.time().'.'.$request->file->extension();
            $request->file->move(public_path('files-cetak'), $file);
            $datasend['file'] = $file;
        }
        
        $transaction = TransactionList::create($datasend);
        // var_dump($transaction);
        // die();

        $carts = Cart::latest()->where('user_id', Auth::id())->get();
        //  var_dump($carts);
        // die();
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
            ]);
            $cart = Cart::findOrFail($cart->cart_id);
            $cart->delete();
        }

        if ($transaction) {
            return redirect()
                ->route('transaction.index')
                ->with([
                    'success' => 'New transaction has been created successfully'
                ]);
        } else {
            return redirect()
                ->back()
                ->withInput()
                ->with([
                    'error' => 'Some problem occurred, please try again'
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


    public function pembayaran($id)
    {
        $payments = Payment::latest()->get();
        $statuses = TransactionStatus::latest()->get();
        $types = TransactionType::latest()->get();
        $transaction = TransactionList::findOrFail($id);
        return view('transaction.pembayaran', compact('transaction', 'payments', 'types'));
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
                    'success' => 'New product has been created successfully'
                ]);
        } else {
            return redirect()
                ->back()
                ->withInput()
                ->with([
                    'error' => 'Some problem occurred, please try again'
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
                    'success' => 'New product has been created successfully'
                ]);
        } else {
            return redirect()
                ->back()
                ->withInput()
                ->with([
                    'error' => 'Some problem occurred, please try again'
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
            'file' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
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

        if(isset($request->file)) {
            $file = 'CETAK-'.$request->user_id.'-'.time().'.'.$request->file->extension();
            $request->file->move(public_path('files-cetak'), $file);
            $datasend['file'] = $file;
        }

        $transaction = TransactionList::findOrFail($id);
        $transaction->update($datasend);
        


        if ($transaction) {
            return redirect()
                ->route('transaction.index')
                ->with([
                    'success' => 'transaction has been updated successfully'
                ]);
        } else {
            return redirect()
                ->back()
                ->withInput()
                ->with([
                    'error' => 'Some problem has occured, please try again'
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
                    'success' => 'transaction has been deleted successfully'
                ]);
        } else {
            return redirect()
                ->route('transaction.index')
                ->with([
                    'error' => 'Some problem has occurred, please try again'
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
                    'success' => 'transaction has been deleted successfully'
                ]);
        } else {
            return redirect()
                ->route('transaction.edit', $transaction_list_id)
                ->with([
                    'error' => 'Some problem has occurred, please try again'
                ]);
        }
    }

    public function download($file)
    {
        $path = public_path('files-cetak') . '/' . $file;
        return response()->download($path);
    }
}
