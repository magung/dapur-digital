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
            'branch_name' => 'required|string',
            'branch_address' => 'required',
            'email' => 'required',
            'sosial_media' => 'required'
        ]);

        $store = Store::create([
            'branch_name' => $request->branch_name,
            'branch_address' => $request->branch_address,
            'email' => $request->email,
            'sosial_media' => $request->sosial_media
        ]);

        if ($store) {
            return redirect()
                ->route('store.index')
                ->with([
                    'success' => 'New Store has been created successfully'
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
            'branch_name' => 'required|string',
            'branch_address' => 'required',
            'email' => 'required',
            'sosial_media' => 'required'
        ]);
         

        $store = Store::findOrFail($id);
        // var_dump($store);
        // die();
        $store->update([
            'branch_name' => $request->branch_name,
            'branch_address' => $request->branch_address,
            'email' => $request->email,
            'sosial_media' => $request->sosial_media
        ]);

        if ($store) {
            return redirect()
                ->route('store.index')
                ->with([
                    'success' => 'Store has been updated successfully'
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
        $store = Store::findOrFail($id);
        $store->delete();

        if ($store) {
            return redirect()
                ->route('store.index')
                ->with([
                    'success' => 'store has been deleted successfully'
                ]);
        } else {
            return redirect()
                ->route('store.index')
                ->with([
                    'error' => 'Some problem has occurred, please try again'
                ]);
        }
    }
}
