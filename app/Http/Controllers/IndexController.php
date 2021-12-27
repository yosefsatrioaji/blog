<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Posts;
use App\Models\Category;
use App\Models\Contact;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function index()
    {
        $posts = Posts::orderBy('created_at', 'desc')->paginate(10);
        return view('index', compact('posts'));
    }

    public function show(Posts $post)
    {
        return view('show', compact('post'));
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        $posts = Posts::where('judul', 'LIKE', '%' . $request->input('search') . '%')->paginate(10);
        return view('search', compact('posts', 'search'));
    }

    public function category(Category $category)
    {
        return view('category', compact('category'));
    }

    public function categoryIndex()
    {
        $categories = Category::orderBy('nama', 'asc')->get();
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

    public function author()
    {
        //
    }
}
