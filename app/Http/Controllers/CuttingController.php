<?php

namespace App\Http\Controllers;

use App\Models\Cutting;
use Illuminate\Http\Request;

class CuttingController extends Controller
{
    public function index()
    {
        $cuttings = Cutting::latest()->get();
        return view('cutting.index', compact('cuttings'));
    }
    public function create()
    {
        return view('cutting.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'cutting' => 'required',
            'cutting_price' => 'required'
        ]);

        $cutting = Cutting::create([
            'cutting' => $request->cutting,
            'cutting_price' => $request->cutting_price
        ]);

        if ($cutting) {
            return redirect()
                ->route('cutting.index')
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
        $cutting = Cutting::findOrFail($id);
        return view('cutting.edit', compact('cutting'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'cutting' => 'required',
            'cutting_price' => 'required'
        ]);

        $cutting = Cutting::findOrFail($id);

        $cutting->update([
            'cutting' => $request->cutting,
            'cutting_price' => $request->cutting_price
        ]);

        if ($cutting) {
            return redirect()
                ->route('cutting.index')
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
        $cutting = Cutting::findOrFail($id);
        $cutting->delete();

        if ($cutting) {
            return redirect()
                ->route('cutting.index')
                ->with([
                    'success' => 'Sukses'
                ]);
        } else {
            return redirect()
                ->route('cutting.index')
                ->with([
                    'error' => 'Some problem has occurred, please try again'
                ]);
        }
    }
}
