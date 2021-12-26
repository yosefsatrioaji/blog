<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Posts;

class IndexController extends Controller
{
    public function index()
    {
        $posts = Posts::orderBy('created_at','desc')->paginate(10);
        return view('index',compact('posts'));
    }

    public function show(Posts $post)
    {
        return view('show',compact('post'));
    }
}
