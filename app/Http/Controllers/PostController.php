<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use App\Models\Category;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Cviebrock\EloquentSluggable\Services\SlugService;
use PhpParser\Node\Expr\AssignOp\Mod;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:super admin|admin');
    }

    public function createView()
    {
        $categories = Category::orderBy('nama', 'asc')->get();
        return view('pages.post.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $cover = null;
        $request->validate([
            'judul' => 'required|max:255',
            'cover' => 'mimes:jpg,jpeg,png|max:10000',
            'kategori' => 'required',
            'ringkasan' => 'required|max:255',
            'isi' => 'required|max:16000000',
            'keywords' => 'max:255'
        ]);
        if ($request->has('cover')) {
            $cover = time() . '-' . $request->cover->getClientOriginalName();
            $coverUpload = $request->file('cover')->storeAs('public/covers', $cover);
        }
        //$coverUpload = Storage::putFileAs('covers', $request->file('cover'), $cover,'public');
        //$slug = Str::slug($request->input('judul') . '-' . time(), '-');
        $slug = SlugService::createSlug(Posts::class, 'slug', $request->input('judul'));
        try {
            $postRequest = [
                'user_id' => Auth::id(),
                'category_id' => $request->input('kategori'),
                'slug' => $slug,
                'judul' => $request->input('judul'),
                'cover' => $cover,
                'ringkasan' => $request->input('ringkasan'),
                'isi' => $request->input('isi'),
                'keywords' => $request->input('keywords')
            ];
            $post = new Posts;
            DB::beginTransaction();
            $post = Posts::create($postRequest);
            DB::commit();
            return redirect('/post/list')->with('success', 'Post created successfully.');
        } catch (ModelNotFoundException $ex) {
            //
        }
    }

    public function show($post)
    {
        $post = Posts::withTrashed()->find($post);
        return view('pages.post.show', compact('post'));
    }

    public function list()
    {
        $posts = Posts::with('user')->latest()->paginate(50);
        return view('pages.post.list', compact('posts'));
    }

    public function edit($post)
    {
        $post = Posts::withTrashed()->find($post);
        $categories = Category::orderBy('nama', 'asc')->get();
        return view('pages.post.edit', compact('post', 'categories'));
    }

    public function update(Request $request, $post)
    {
        $request->validate([
            'judul' => 'required|max:255',
            'kategori' => 'required',
            'ringkasan' => 'required|max:255',
            'isi' => 'required|max:16000000',
            'keywords' => 'max:255'
        ]);
        $slug = SlugService::createSlug(Posts::class, 'slug', $request->input('judul'));
        try {
            $postUpdate = Posts::withTrashed()->find($post);
            if ($postUpdate->judul != $request->input('judul')) {
                $slug = SlugService::createSlug(Posts::class, 'slug', $request->input('judul'));
                $postUpdate->slug = $slug;
            }
            $postUpdate->judul = $request->input('judul');
            $postUpdate->category_id = $request->input('kategori');
            $postUpdate->ringkasan = $request->input('ringkasan');
            $postUpdate->isi = $request->input('isi');
            $postUpdate->keywords = $request->input('keywords');
            $postUpdate->save();
            return redirect('/post/list')->with('success', 'Post updated successfully.');
        } catch (ModelNotFoundException $e) {
            //
        }
    }

    public function delete(Posts $post)
    {
        try {
            $post->delete();
            return redirect('/post/list')->with('success', 'Post deleted successfully.');
        } catch (ModelNotFoundException $e) {
            return back()->withError($e->getMessage())->withInput();
        }
    }

    public function trash()
    {
        $posts = Posts::onlyTrashed()->with('user')->orderBy('created_at', 'desc')->paginate(50);
        return view('pages.post.trash', compact('posts'));
    }

    public function restore($post)
    {
        $restorePost = Posts::withTrashed()->find($post)->restore();
        return redirect('/post/trash')->with('success', 'Post restored successfully.');
    }
}
