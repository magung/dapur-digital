<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::latest()->get();
        return view('banner.index', compact('banners'));
    }
    public function create()
    {
        return view('banner.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'description' => 'required',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $photo = 'BANNER-'.time().'.'.$request->photo->extension();

        $request->photo->move(public_path('uploads'), $photo);


        $banner = Banner::create([
            'link' => $request->link,
            'description' => $request->description,
            'photo' => $photo
        ]);

        if ($banner) {
            return redirect()
                ->route('banner.index')
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
        $banner = Banner::findOrFail($id);
        return view('banner.edit', compact('banner'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'description' => 'required',
        ]);

        $datasend = [
            'link' => $request->link,
            'description' => $request->description,
        ];

        $banner = Banner::findOrFail($id);

        if(isset($request->photo)) {
            $photo = 'BANNER-'.time().'.'.$request->photo->extension();
            $request->photo->move(public_path('uploads'), $photo);
            $datasend['photo'] = $photo;
        }
        

        $banner->update($datasend);

        if ($banner) {
            return redirect()
                ->route('banner.index')
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
        $banner = Banner::findOrFail($id);
        if (file_exists(public_path('uploads').'/'.$banner->photo)) {
            unlink(public_path('uploads').'/'.$banner->photo);
        } 
        $banner->delete();

        if ($banner) {
            return redirect()
                ->route('banner.index')
                ->with([
                    'success' => 'Sukses'
                ]);
        } else {
            return redirect()
                ->route('banner.index')
                ->with([
                    'error' => 'Gagal'
                ]);
        }
    }
}
