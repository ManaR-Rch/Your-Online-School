<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:mp4,avi,mov,pdf,doc,docx,txt,png,jpg,jpeg,zip',
        ]);

        $path = $request->file('file')->store('uploads', 'public');
        $url = asset('storage/' . $path);

        return response()->json(['url' => $url], 201);
    }
}
