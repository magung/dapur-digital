<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function image($file)
    {
        $path = public_path('uploads') . '/' . $file;
        return response()->download($path);
    }

    public function downloadFile(Request $request)
    {
        $filename = $request->query('file');
        $path = public_path('files-cetak') . '/' . $filename;

        if (!File::exists($path)) {
            abort(404);
        }

        $headers = [
            'Content-Type' => 'image/jpeg', // Replace with the appropriate file type
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        return response()->download($path, $filename, $headers);
    }
}
