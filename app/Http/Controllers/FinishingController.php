<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Finishing;
use Illuminate\Http\Request;

class FinishingController extends Controller
{
    public function index()
    {
        $finishings = Finishing::latest()->get();
        return view('finishing.index', compact('finishings'));
    }
    public function create()
    {
        $categories = Category::latest()->get();
        return view('finishing.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'finishing' => 'required',
            'finishing_price' => 'required',
            'category_id' => 'required'
        ]);

        $finishing = Finishing::create([
            'finishing' => $request->finishing,
            'finishing_price' => $request->finishing_price,
            'category_id' => $request->category_id
        ]);

        if ($finishing) {
            return redirect()
                ->route('finishing.index')
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
        $finishing = Finishing::findOrFail($id);
        $categories = Category::latest()->get();
        return view('finishing.edit', compact('finishing', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'finishing' => 'required',
            'finishing_price' => 'required',
            'category_id' => 'required'
        ]);

        $finishing = Finishing::findOrFail($id);

        $finishing->update([
            'finishing' => $request->finishing,
            'finishing_price' => $request->finishing_price,
            'category_id' => $request->category_id
        ]);

        if ($finishing) {
            return redirect()
                ->route('finishing.index')
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
        $finishing = Finishing::findOrFail($id);
        $finishing->delete();

        if ($finishing) {
            return redirect()
                ->route('finishing.index')
                ->with([
                    'success' => 'Sukses'
                ]);
        } else {
            return redirect()
                ->route('finishing.index')
                ->with([
                    'error' => 'Gagal'
                ]);
        }
    }
}
