<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function index()
    {
        $stores = Store::latest()->get();
        return view('store.index', compact('stores'));
    }


    // public function show()
    // {
    //     $stores = Store::latest()->get();
    //     return view('store.index', compact('stores'));
    // }
    public function create()
    {
        return view('store.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'store_name' => 'required|string',
            'store_address' => 'required',
            'email' => 'required',
            'sosial_media' => 'required'
        ]);

        $store = Store::create([
            'store_name' => $request->store_name,
            'store_address' => $request->store_address,
            'email' => $request->email,
            'sosial_media' => $request->sosial_media
        ]);

        if ($store) {
            return redirect()
                ->route('store.index')
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

    public function show($id)
    {
        $store = Store::findOrFail($id);
        return view('store.edit', compact('store'));
    }

    public function edit($id)
    {
        $store = Store::findOrFail($id);
        return view('store.edit', compact('store'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'store_name' => 'required|string',
            'store_address' => 'required',
            'email' => 'required',
            'sosial_media' => 'required'
        ]);
         

        $store = Store::findOrFail($id);
        // var_dump($store);
        // die();
        $store->update([
            'store_name' => $request->store_name,
            'store_address' => $request->store_address,
            'email' => $request->email,
            'sosial_media' => $request->sosial_media
        ]);

        if ($store) {
            return redirect()
                ->route('store.index')
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
        $store = Store::findOrFail($id);
        $store->delete();

        if ($store) {
            return redirect()
                ->route('store.index')
                ->with([
                    'success' => 'Sukses'
                ]);
        } else {
            return redirect()
                ->route('store.index')
                ->with([
                    'error' => 'Gagal'
                ]);
        }
    }
}
