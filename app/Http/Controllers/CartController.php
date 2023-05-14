<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Cutting;
use App\Models\Finishing;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function create()
    {
        $user = Auth::user();
        $store_id = $user->store_id;
        $products = Product::latest()
                    ->join('categories', 'categories.id', '=', 'products.category_id')
                    ->select('products.*', 'categories.satuan')
                    ->where('store_id', $store_id)->get();
        $finishings = Finishing::latest()->get();
        $cuttings = Cutting::latest()->get();
        return view('cart.create', compact('products', 'finishings', 'cuttings'));
    }

    public function addToCart($id) {
        $user_id =  Auth::id();
        $product = Product::latest()
                    ->where('products.id', $id)
                    ->leftJoin('categories','categories.id', '=', 'products.category_id')
                    ->select('products.*', 'categories.satuan')
                    ->first();
        $datasend = [
            'product_id' => $product->id,
            'qty' => 1,
            'panjang' => 1,
            'lebar' => 1,
            'price' => $product->price,
            'total_price' => $product->price,
            'user_id' => $user_id,
            'satuan' => $product->satuan
        ];

        $cart = Cart::latest()
            ->where('user_id', $user_id)
            ->where('product_id', $product->product_id)->first();
        if($cart) {
            $cart->update($datasend);
        } else {
            $cart = Cart::create($datasend);
        }
        if ($cart) {
            return redirect()
                ->route('dashboard')
                ->with([
                    'success' => 'Produk berhasil ditambahkan ke keranjang'
                ]);
        } else {
            return redirect()
                ->back()
                ->withInput()
                ->with([
                    'error' => 'Produk gagal ditambahkan ke keranjang'
                ]);
        }
    }

    public function store(Request $request)
    {
        $user_id =  Auth::id();
        $validators = [
            'product_id'    => 'required',
            'qty'           => 'required|numeric|min:1',
            'total_price'   => 'required|numeric',
            'satuan'        => 'required',
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
            'user_id' => $user_id,
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

        $cart = Cart::latest()
            ->where('user_id', $user_id)
            ->where('product_id', $request->product_id)->first();

        if($cart) {
            // var_dump($cart);
            // die();
            // $cart = Cart::findOrFail($cart->id);
            $cart->update($datasend);
        } else {
            $cart = Cart::create($datasend);
        }


        if ($cart) {
            return redirect()
                ->route('transaction.create')
                ->with([
                    'success' => 'New Cart has been created successfully'
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
        $products = Product::latest()
                    ->join('categories', 'categories.id', '=', 'products.category_id')
                    ->select('products.*', 'categories.satuan')
                    ->where('store_id', $store_id)->get();
        $cart = Cart::findOrFail($id);
        $finishings = Finishing::latest()->get();
        $cuttings = Cutting::latest()->get();
        return view('cart.edit', compact('products', 'cart', 'finishings', 'cuttings', 'user'));

    }

    public function update(Request $request, $id)
    {
        $validators = [
            'product_id'    => 'required',
            'qty'           => 'required|numeric|min:1',
            'total_price'   => 'required|numeric',
            'satuan'        => 'required',
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
            'user_id' => Auth::id(),
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

        $cart = Cart::findOrFail($id);

        $cart->update($datasend);

        if ($cart) {
            return redirect()
                ->route('transaction.create')
                ->with([
                    'success' => 'cart has been updated successfully'
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

    public function updatePelanggan(Request $request, $id)
    {
        $validators = [
            'product_id'    => 'required',
            'qty'           => 'required|numeric|min:1',
            'total_price'   => 'required|numeric',
            'satuan'        => 'required',
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
            'user_id' => Auth::id(),
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

        $cart = Cart::findOrFail($id);

        $cart->update($datasend);

        if ($cart) {
            return redirect()
                ->route('cart.list')
                ->with([
                    'success' => 'cart has been updated successfully'
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
        $cart = Cart::findOrFail($id);
        $cart->delete();

        if ($cart) {
            return redirect()
                ->route('transaction.create')
                ->with([
                    'success' => 'cart has been deleted successfully'
                ]);
        } else {
            return redirect()
                ->route('transaction.create')
                ->with([
                    'error' => 'Some problem has occurred, please try again'
                ]);
        }
    }
}
