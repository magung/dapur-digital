<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Cutting;
use App\Models\Finishing;
use App\Models\Address;
use App\Models\Courier;
use App\Models\Product;
use App\Models\Store;
use App\Models\TransactionType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Payment;
use Illuminate\Support\Facades\Http;

class CartController extends Controller
{
    public function cartListCustomer()
    {
        $customer = Auth::guard('customer')->user();
        $payments = Payment::latest()->get();
        $types = TransactionType::latest()->get();
        $stores = Store::latest()->get();
        $carts = Cart::latest()
                ->join('products', 'products.product_id', '=', 'carts.product_id')
                ->leftJoin('finishings', 'finishings.finishing_id', '=', 'carts.finishing_id')
                ->leftJoin('cuttings', 'cuttings.cutting_id', '=', 'carts.cutting_id')
                ->select('carts.*', 'products.product_name', 'finishings.finishing', 'cuttings.cutting', 'products.photo', 'products.weight')
                ->where('customer_id', $customer->customer_id)->get();
        $total_harga = 0;
        foreach($carts as $cart) {
            $total_harga += $cart->total_price;
        }
        $addresses = Address::where('customer_id', '=', $customer->customer_id)->get();
        $couriers = Courier::where('status', '=', 1 )->get();
        return view('cart.index',
                    compact(
                            'payments',
                            'types',
                            'stores',
                            'carts',
                            'total_harga',
                            'addresses',
                            'couriers'
                        ));
    }

    public function cekOngkir(Request $request)
    {
        $data = [
            "shipper_contact_name" => "Dapur Digital",
            "shipper_contact_phone" => "088704145010",
            "origin_contact_name" => "dapur digital",
            "origin_contact_phone" => "088704145010",
            "origin_address" => "Cibinong, Kabupaten Bogor, Jawa Barat",
            "origin_note" => "",
            "origin_postal_code" => "16911",
            "destination_contact_name" => $request->contact_name,
            "destination_contact_phone" => $request->contact_phone,
            "destination_address" => $request->address,
            "destination_postal_code" => $request->postal_code,
            "destination_note" =>  $request->note,
            "courier_company" => $request->courier_code,
            "courier_type" =>  $request->courier_service_code,
            "delivery_type" => "now",
            "order_note" => $request->note,
            "metadata" => [],
            "items" => $request->items
        ];
        $url = "https://api.biteship.com/v1/orders";
        $apiKey = env('BITESHIP_KEY');
        $response = Http::withHeaders([
            "Authorization" => $apiKey,
            "Content-Type" => "application/json"
        ])->post($url, $data);

        $price = 0;
        $message = "";
        $errorCode = "";
        if ($response->successful()) {
            $order = $response->json();
            // Process the order data
            $price = $order['price'];
            $message = 'success';
            $errorCode = $response->status();
        } else {
            $errorCode = $response->status();
            $message = $response->body();
            $price = 0;
        }
        $data = [
            'message' => $message,
            'error_code' => $errorCode,
            'price' => $price
        ];
        return response()->json($data, 200);
    }

    public function apiCekOngkir($data)
    {
        $url = "https://api.biteship.com/v1/orders";
        $apiKey = env('BITESHIP_KEY');
        // var_dump($apiKey);
        $response = Http::withHeaders([
            "Authorization" => $apiKey,
            "Content-Type" => "application/json"
        ])->post($url, $data);

        // Handle the response
        if ($response->successful()) {
            $order = $response->json();
            $price = $order['price'];
            return $price;
        } else {
            return 0;
        }
    }

    public function cartPaymentCustomer(Request $request)
    {
        $validators = [
            'transaction_type'  => 'required',
            'payment_method'    => 'required',
        ];

        if($request->transaction_type == 1) {
            $validators['store'] = 'required';
        } else {
            $validators['address'] = 'required';
            $validators['courier'] = 'required';
        }

        $this->validate($request, $validators);

        $transaction_type_id = $request->transaction_type;
        $payment_method_id = $request->payment_method;
        $store_id = $request->store;
        $address_id = $request->address;
        $courier_id = $request->courier;

        $customer = Auth::guard('customer')->user();
        $payment = Payment::find($payment_method_id);
        $transaction_type = TransactionType::find($transaction_type_id);
        $store = Store::find($store_id);
        $carts = Cart::latest()
                ->join('products', 'products.product_id', '=', 'carts.product_id')
                ->leftJoin('finishings', 'finishings.finishing_id', '=', 'carts.finishing_id')
                ->leftJoin('cuttings', 'cuttings.cutting_id', '=', 'carts.cutting_id')
                ->select('carts.*', 'products.product_name', 'finishings.finishing', 'cuttings.cutting', 'products.photo', 'products.weight')
                ->where('customer_id', $customer->customer_id)->get();
        $total_harga = 0;
        $items = [];
        foreach($carts as $cart) {
            $total_harga += $cart->total_price;
            $weight = 0;
            if($cart->satuan == 'M') {
                $weight = $cart->product->weight * $cart->luas;
            } else {
                $weight = $cart->product->weight;
            }
            $item = [
                "id" => $cart->cart_id,
                "name" => $cart->product->product_name,
                "image" => "",
                "description" => "",
                "value" => $cart->total_price,
                "quantity" => $cart->qty,
                "weight" => $weight
            ];
            $items[] = $item;
        }
        $address = Address::find($address_id);
        $courier = Courier::find($courier_id);
        $courier_price = 0;
        if($transaction_type_id == 2) {
            $data = [
                "shipper_contact_name" => "Dapur Digital",
                "shipper_contact_phone" => "088704145010",
                "origin_contact_name" => "dapur digital",
                "origin_contact_phone" => "088704145010",
                "origin_address" => "Cibinong, Kabupaten Bogor, Jawa Barat",
                "origin_note" => "",
                "origin_postal_code" => "16911",
                "destination_contact_name" => $address->contact_name,
                "destination_contact_phone" => $address->contact_phone,
                "destination_address" => $address->address,
                "destination_postal_code" => $address->postal_code,
                "destination_note" =>  $address->note,
                "courier_company" => $courier->courier_code,
                "courier_type" =>  $courier->courier_service_code,
                "delivery_type" => "now",
                "order_note" => $address->note,
                "metadata" => [],
                "items" => $items
            ];


            $courier_price = $this->apiCekOngkir($data);
            if($courier_price == 0) {
                return redirect()
                    ->to(route('cart.list'))
                    ->with([
                        'error' => 'Alamat yang anda pilih tidak valid atau kurir tidak tersedia'
                    ]);
            }
            $total_harga += $courier_price;
        }

        return view('cart.payment',
                    compact(
                            'payment',
                            'transaction_type',
                            'store',
                            'carts',
                            'total_harga',
                            'address',
                            'transaction_type_id',
                            'payment_method_id',
                            'store_id',
                            'address_id',
                            'courier',
                            'courier_id',
                            'courier_price'
                        ));
    }

    public function create($id)
    {
        $product = Product::findOrFail($id);
        $finishings = Finishing::latest()->where('category_id', $product->category_id)->get();
        $cuttings = Cutting::latest()->where('category_id', $product->category_id)->get();
        return view('cart.create', compact('product', 'finishings', 'cuttings'));
    }

    public function admin_cart_create($id)
    {
        $product = Product::findOrFail($id);
        $finishings = Finishing::latest()->where('category_id', $product->category_id)->get();
        $cuttings = Cutting::latest()->where('category_id', $product->category_id)->get();
        return view('cart.admin_cart_create', compact('product', 'finishings', 'cuttings'));
    }

    public function edit($id)
    {
        $user = Auth::guard('customer')->user();
        $cart = Cart::findOrFail($id);
        $product = Product::findOrFail($cart->product_id);
        $finishings = Finishing::latest()->where('category_id', $product->category_id)->get();
        $cuttings = Cutting::latest()->where('category_id', $product->category_id)->get();
        return view('cart.edit', compact('product', 'cart', 'finishings', 'cuttings', 'user'));

    }

    public function admin_cart_edit($id)
    {
        $user = Auth::user();
        $cart = Cart::findOrFail($id);
        $product = Product::findOrFail($cart->product_id);
        $finishings = Finishing::latest()->where('category_id', $product->category_id)->get();
        $cuttings = Cutting::latest()->where('category_id', $product->category_id)->get();
        return view('cart.admin_cart_edit', compact('product', 'cart', 'finishings', 'cuttings', 'user'));

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
            'file'          => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];

        if($request->satuan == 'M') {
            $validators['panjang'] = 'required|numeric|min:1';
            $validators['lebar'] = 'required|numeric|min:1';
            $validators['luas'] = 'required|numeric|min:1';
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

        $cart = null;
        if($request->satuan == 'M') {
            $datasend['panjang'] = $request->panjang;
            $datasend['lebar'] = $request->lebar;
            $datasend['luas'] = $request->luas;
            $cart = Cart::latest()
                ->where('customer_id', $user_id)
                ->where('product_id', $request->product_id)
                ->where('panjang', $request->panjang)
                ->where('lebar', $request->lebar)
                ->where('finishing_id', $request->finishing_id)
                ->where('cutting_id', $request->cutting_id)
                ->first();

            if($cart) {
                $cart->update($datasend);
            } else {
                $cart = Cart::create($datasend);
            }
        } else {
            $cart = Cart::latest()
                ->where('customer_id', $user_id)
                ->where('product_id', $request->product_id)->first();

            if($cart) {
                $cart->update($datasend);
            } else {
                $cart = Cart::create($datasend);
            }
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

    public function admin_cart_store(Request $request)
    {
        $user_id =  Auth::id();
        $validators = [
            'product_id'    => 'required',
            'qty'           => 'required|numeric|min:1',
            'total_price'   => 'required|numeric',
            'satuan'        => 'required',
            'file'          => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];

        if($request->satuan == 'M') {
            $validators['panjang'] = 'required|numeric|min:1';
            $validators['lebar'] = 'required|numeric|min:1';
            $validators['luas'] = 'required|numeric|min:1';
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

        if(isset($request->file)) {
            $file = 'CETAK-'.Auth::guard('customer')->id().'-'.time().'.'.$request->file->extension();
            $request->file->move(public_path('files-cetak'), $file);
            $datasend['file'] = $file;
        }

        $cart = null;
        if($request->satuan == 'M') {
            $datasend['panjang'] = $request->panjang;
            $datasend['lebar'] = $request->lebar;
            $datasend['luas'] = $request->luas;
            $cart = Cart::latest()
                ->where('user_id', $user_id)
                ->where('product_id', $request->product_id)
                ->where('panjang', $request->panjang)
                ->where('lebar', $request->lebar)
                ->where('finishing_id', $request->finishing_id)
                ->where('cutting_id', $request->cutting_id)
                ->first();

            if($cart) {
                $cart->update($datasend);
            } else {
                $cart = Cart::create($datasend);
            }
        } else {
            $cart = Cart::latest()
                ->where('user_id', $user_id)
                ->where('product_id', $request->product_id)->first();

            if($cart) {
                $cart->update($datasend);
            } else {
                $cart = Cart::create($datasend);
            }
        }


        if ($cart) {
            return redirect()
                ->route('transaction.create')
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
            $validators['luas'] = 'required|numeric|min:1';
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
            $datasend['luas'] = $request->luas;
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

    public function admin_cart_update(Request $request, $id)
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
            $validators['luas'] = 'required|numeric|min:1';
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

        if(isset($request->file)) {
            $file = 'CETAK-'.time().'.'.$request->file->extension();
            $request->file->move(public_path('files-cetak'), $file);
            $datasend['file'] = $file;
        }

        if($request->satuan == 'M') {
            $datasend['panjang'] = $request->panjang;
            $datasend['lebar'] = $request->lebar;
            $datasend['luas'] = $request->luas;
        }

        $cart = Cart::findOrFail($id);

        $cart->update($datasend);

        if ($cart) {
            return redirect()
                ->route('transaction.create')
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
                    'error' => 'Gagal'
                ]);
        }
    }

    public function admin_cart_destroy($id)
    {
        $cart = Cart::findOrFail($id);
        $cart->delete();

        if ($cart) {
            return redirect()
                ->route('transaction.create')
                ->with([
                    'success' => 'Sukses'
                ]);
        } else {
            return redirect()
                ->route('transaction.create')
                ->with([
                    'error' => 'Gagal'
                ]);
        }
    }
}
