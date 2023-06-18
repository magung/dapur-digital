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
    public function create($id)
    {
        $user = Auth::guard('customer')->user();
        $store_id = $user->store_id;
        $product = Product::latest()
                    ->join('categories', 'categories.category_id', '=', 'products.category_id')
                    ->select('products.*', 'categories.satuan')
                    ->where('products.product_id', '=', $id)
                    ->first();
        $finishings = Finishing::latest()->get();
        $cuttings = Cutting::latest()->get();
        return view('cart.create', compact('product', 'finishings', 'cuttings'));
    }

    public function addToCart($id) {
        $user_id =  Auth::guard('customer')->id();
        $product = Product::latest()
                    ->where('products.product_id', $id)
                    ->leftJoin('categories','categories.category_id', '=', 'products.category_id')
                    ->select('products.*', 'categories.satuan')
                    ->first();
        $datasend = [
            'product_id' => $product->product_id,
            'qty' => 1,
            'panjang' => 1,
            'lebar' => 1,
            'price' => $product->price,
            'total_price' => $product->price,
            'customer_id' => $user_id,
            'satuan' => $product->satuan
        ];

        $cart = Cart::latest()
            ->where('customer_id', $user_id)
            ->where('product_id', $product->product_id)->first();
        if($cart) {
            $cart->update($datasend);
        } else {
            $cart = Cart::create($datasend);
        }
        if ($cart) {
            return redirect()
                ->to(route('dashboard') . '#produk_kami')
                ->with([
                    'success' => 'Sukses'
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
        $user_id =  Auth::guard('customer')->id();
        $validators = [
            'product_id'    => 'required',
            'qty'           => 'required|numeric|min:1',
            'total_price'   => 'required|numeric',
            'satuan'        => 'required',
            'file'          => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
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
            'customer_id' => $user_id,
            'satuan' => $request->satuan,
            'finishing_id' => $request->finishing_id,
            'finishing_price' => $request->finishing_price,
            'cutting_id' => $request->cutting_id,
            'cutting_price' => $request->cutting_price,
        ];

        if(isset($request->file)) {
            $file = 'CETAK-'.Auth::guard('customer')->id().'-'.time().'.'.$request->file->extension();
            $request->file->move(public_path('files-cetak'), $file);
            $datasend['file'] = $file;
        }

        if($request->satuan == 'M') {
            $datasend['panjang'] = $request->panjang;
            $datasend['lebar'] = $request->lebar;
        }

        $cart = Cart::latest()
            ->where('customer_id', $user_id)
            ->where('product_id', $request->product_id)->first();

        if($cart) {
            $cart->update($datasend);
        } else {
            $cart = Cart::create($datasend);
        }

        if ($cart) {
            return redirect()
                ->route('cart.list')
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
        $user = Auth::guard('customer')->user();
        $cart = Cart::findOrFail($id);
        $product = Product::latest()
                    ->join('categories', 'categories.category_id', '=', 'products.category_id')
                    ->select('products.*', 'categories.satuan')
                    ->where('products.product_id', '=', $cart->product_id)
                    ->first();
        $finishings = Finishing::latest()->get();
        $cuttings = Cutting::latest()->get();
        return view('cart.edit', compact('product', 'cart', 'finishings', 'cuttings', 'user'));

    }

    public function update(Request $request, $id)
    {
        $validators = [
            'product_id'    => 'required',
            'qty'           => 'required|numeric|min:1',
            'total_price'   => 'required|numeric',
            'satuan'        => 'required',
            'file'          => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
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
            'customer_id' => Auth::guard('customer')->id(),
            'satuan' => $request->satuan,
            'finishing_id' => $request->finishing_id,
            'finishing_price' => $request->finishing_price,
            'cutting_id' => $request->cutting_id,
            'cutting_price' => $request->cutting_price,
        ];

        if(isset($request->file)) {
            $file = 'CETAK-'.Auth::guard('customer')->id().'-'.time().'.'.$request->file->extension();
            $request->file->move(public_path('files-cetak'), $file);
            $datasend['file'] = $file;
        }

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
            'customer_id' => Auth::guard('customer')->id(),
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
        $cart = Cart::findOrFail($id);
        $cart->delete();

        if ($cart) {
            return redirect()
                ->route('cart.list')
                ->with([
                    'success' => 'Sukses'
                ]);
        } else {
            return redirect()
                ->route('cart.list')
                ->with([
                    'error' => 'Some problem has occurred, please try again'
                ]);
        }
    }
}
