<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Posts;

class DashboardController extends Controller
{
    public function index()
    {
        $user = User::count();
        $post = Posts::count();
        $trashPost = Posts::onlyTrashed()->count();
        return view('pages.dashboard.index',compact('trashPost','user','post'));
    }
}
