<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function image($file)
    {
        $path = public_path('uploads') . '/' . $file;
        return response()->download($path);
    }
}
