<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TinyController extends Controller
{
    public function imageUpload(Request $request)
    {
        $fileName=$request->file('file')->getClientOriginalName();
        $path=$request->file('file')->storeAs('uploads', $fileName, 'public');
        return response()->json(['location'=>"/storage/$path"]);
    }
}
