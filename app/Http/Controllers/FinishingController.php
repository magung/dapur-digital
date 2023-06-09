<?php

namespace App\Http\Controllers;

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
        return view('finishing.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'finishing' => 'required',
            'finishing_price' => 'required'
        ]);

        $finishing = Finishing::create([
            'finishing' => $request->finishing,
            'finishing_price' => $request->finishing_price
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
        return view('finishing.edit', compact('finishing'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'finishing' => 'required',
            'finishing_price' => 'required'
        ]);

        $finishing = Finishing::findOrFail($id);

        $finishing->update([
            'finishing' => $request->finishing,
            'finishing_price' => $request->finishing_price
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
                    'error' => 'Some problem has occurred, please try again'
                ]);
        }
    }
}
