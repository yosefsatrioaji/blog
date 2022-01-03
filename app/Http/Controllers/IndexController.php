<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Posts;
use App\Models\Category;
use App\Models\Contact;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function index()
    {
        $posts = Posts::with('user')->latest()->paginate(10);
        return view('index', compact('posts'));
    }

    public function show(Posts $post)
    {
        return view('show', compact('post'));
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        $posts = Posts::with('user')->where('judul', 'LIKE', '%' . $request->input('search') . '%')->paginate(10);
        return view('search', compact('posts', 'search'));
    }

    public function category(Category $category)
    {
        $nama = $category->nama;
        $category = $category->posts->load('user');
        return view('category', compact('category', 'nama'));
    }

    public function categoryIndex()
    {
        $categories = Category::with('posts')->orderBy('nama', 'asc')->get();
        return view('indexc', compact('categories'));
    }

    public function contact()
    {
        return view('contact');
    }

    public function submitContact(Request $request)
    {
        $request->validate([
            'email' => 'required|email:dns|max:255',
            'nama' => 'required|max:255',
            'isi' => 'required|max:1000'
        ]);

        if (Auth::check()) {
            try {
                $contactRequest = [
                    'email' => $request->input('email'),
                    'actual_email' => Auth::user()->email,
                    'nama' => $request->input('nama'),
                    'isi' => $request->input('isi')
                ];
                DB::beginTransaction();
                $contact = Contact::create($contactRequest);
                DB::commit();
            } catch (ModelNotFoundException $e) {
                //
            }
        } else {
            try {
                $contactRequest = [
                    'email' => $request->input('email'),
                    'nama' => $request->input('nama'),
                    'isi' => $request->input('isi')
                ];
                DB::beginTransaction();
                $contact = Contact::create($contactRequest);
                DB::commit();
            } catch (ModelNotFoundException $e) {
                //
            }
        }
        return redirect('/contact')->with('success', 'Contact sent successfully.');
    }

    public function author(User $users)
    {
        $user_profile = $users->userProfile;
        $posts = $users->posts->load('user');
        return view('author', compact('user_profile', 'posts', 'users'));
    }
}
