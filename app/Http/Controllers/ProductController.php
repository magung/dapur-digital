<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = $this->getProducts($request);
        return view('product.index', compact('products'));
    }

    public function getProducts(Request $request) {
        $category_id = $request->query('category_id');
        $product_name = $request->query('product_name');
        $products = DB::table('products')
        ->select(['products.*', 'categories.category_name','categories.satuan'])
        ->join('categories', 'categories.category_id', '=', 'products.category_id');
        if($category_id != null) {
            $products = $products->where('categories.category_id', '=', $category_id);
        }
        if($product_name != null) {
            $products = $products->where('products.product_name', 'LIKE', '%' . $product_name . '%');
        }
        $products = $products->get();
        return $products;
    }
    public function create()
    {
        $categories = Category::latest()->get();
        return view('product.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'product_name' => 'required',
            'category' => 'required',
            'description' => 'required',
            'stock' => 'required',
            'weight' => 'required',
            'price' => 'required',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $photo = 'PRODUCT-'.time().'.'.$request->photo->extension();

        $request->photo->move(public_path('uploads'), $photo);

        $product = Product::create([
            'product_name' => $request->product_name,
            'category_id' => $request->category,
            'description' => $request->description,
            'stock' => $request->stock,
            'weight' => $request->weight,
            'price' => $request->price,
            'photo' => $photo
        ]);

        if ($product) {
            return redirect()
                ->route('product.index')
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
        $product = Product::findOrFail($id);
        $categories = Category::latest()->get();
        return view('product.edit', compact('product','categories'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'product_name' => 'required',
            'category' => 'required',
            'description' => 'required',
            'stock' => 'required',
            'weight' => 'required',
            'price' => 'required'
        ]);

        $datasend = [
            'product_name' => $request->product_name,
            'category_id' => $request->category,
            'description' => $request->description,
            'stock' => $request->stock,
            'weight' => $request->weight,
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
        $product = Product::findOrFail($id);
        if (file_exists(public_path('uploads').'/'.$product->photo)) {
            unlink(public_path('uploads').'/'.$product->photo);
        } 
        $product->delete();

        if ($product) {
            return redirect()
                ->route('product.index')
                ->with([
                    'success' => 'Sukses'
                ]);
        } else {
            return redirect()
                ->route('product.index')
                ->with([
                    'error' => 'Gagal'
                ]);
        }
    }

    public function productList(Request $request)
    {
        $products = $this->getProducts($request);
        $categories = Category::latest()->get();
        $product_name = $request->query('product_name');
        $category_id = $request->query('category_id');
        return view('product-list.index', compact('products', 'categories', 'product_name', 'category_id'));
    }

    public function productListAdmin(Request $request)
    {
        $products = $this->getProducts($request);
        $categories = Category::latest()->get();
        $product_name = $request->query('product_name');
        $category_id = $request->query('category_id');
        return view('product-list.product-list-admin', compact('products', 'categories', 'product_name', 'category_id'));
    }

    public function detailProduct($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::latest()->get();
        return view('home.product-detail', compact('product','categories'));
    }

}
