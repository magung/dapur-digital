<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {
        // $products = Product::latest()->get();
        $products = DB::table('products')
            ->select(['products.*', 'categories.category_name','categories.satuan', 'stores.branch_name'])
            ->join('categories', 'categories.id', '=', 'products.category_id')
            ->join('stores', 'stores.id', '=', 'products.store_id')
            ->get();

        return view('product.index', compact('products'));
    }
    public function create()
    {
        $categories = Category::latest()->get();
        $stores = Store::latest()->get();
        return view('product.create', compact('categories', 'stores'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'product_name' => 'required',
            'category' => 'required',
            'store' => 'required',
            'stock' => 'required',
            'price' => 'required',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $photo = 'PRODUCT-'.time().'.'.$request->photo->extension();

        $request->photo->move(public_path('uploads'), $photo);


        $product = Product::create([
            'product_name' => $request->product_name,
            'category_id' => $request->category,
            'store_id' => $request->store,
            'stock' => $request->stock,
            'price' => $request->price,
            'photo' => $photo
        ]);

        if ($product) {
            return redirect()
                ->route('product.index')
                ->with([
                    'success' => 'New Product has been created successfully'
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
        $product = Product::findOrFail($id);
        $categories = Category::latest()->get();
        $stores = Store::latest()->get();
        return view('product.edit', compact('product','categories','stores'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'product_name' => 'required',
            'category' => 'required',
            'store' => 'required',
            'stock' => 'required',
            'price' => 'required'
        ]);

        $datasend = [
            'product_name' => $request->product_name,
            'category_id' => $request->category,
            'store_id' => $request->store,
            'stock' => $request->stock,
            'price' => $request->price,
        ];

        $product = Product::findOrFail($id);

        if(isset($request->photo)) {
            $photo = 'PRODUCT-'.time().'.'.$request->photo->extension();
            $request->photo->move(public_path('uploads'), $photo);
            $datasend['photo'] = $photo;
            // if (file_exists(public_path('uploads').'/'.$product->photo)) {
            //     unlink(public_path('uploads').'/'.$product->photo);
            // } 
        }
        

        $product->update($datasend);

        if ($product) {
            return redirect()
                ->route('product.index')
                ->with([
                    'success' => 'category has been updated successfully'
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
        $product = Product::findOrFail($id);
        if (file_exists(public_path('uploads').'/'.$product->photo)) {
            unlink(public_path('uploads').'/'.$product->photo);
        } 
        $product->delete();

        if ($product) {
            return redirect()
                ->route('product.index')
                ->with([
                    'success' => 'category has been deleted successfully'
                ]);
        } else {
            return redirect()
                ->route('product.index')
                ->with([
                    'error' => 'Some problem has occurred, please try again'
                ]);
        }
    }

    public function indexProductList()
    {
        $products = DB::table('products')
        ->select(['products.*', 'categories.category_name','categories.satuan', 'stores.branch_name'])
        ->join('categories', 'categories.id', '=', 'products.category_id')
        ->join('stores', 'stores.id', '=', 'products.store_id')
        ->get();

        return view('product-list.index', compact('products'));
    }
}
