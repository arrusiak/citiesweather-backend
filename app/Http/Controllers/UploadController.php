<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadController extends Controller
{

    public function upload(Request $request): bool|string
    {
        return $request->file('file')->store('docs');
//        return response()->json($contactFormData);
    }
}
