<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\AssignOp\Mod;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:super admin|admin|writer');
    }

    public function createView()
    {
        return view('pages.post.create');
    }

    public function store(Request $request)
    {
        $cover = null;
        $request->validate([
            'judul' => 'required|max:255|unique:posts',
            'cover' => 'mimes:jpg,jpeg,png|max:10000',
            'ringkasan' => 'required|max:255',
            'isi' => 'required',
            'keywords' => 'max:255'
        ]);
        $cover = time() . '-' . $request->cover->getClientOriginalName();
        //$coverUpload = Storage::putFileAs('covers', $request->file('cover'), $cover,'public');
        $coverUpload = $request->file('cover')->storeAs('public/covers', $cover);
        $slug = Str::slug($request->input('judul') . '-' . time(), '-');
        try {
            $postRequest = [
                'user_id' => Auth::id(),
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
            return redirect('/dashboard')->with('postSuccess', 'Berhasil menambahkan post');
        } catch (ModelNotFoundException $ex) {
            //
        }
    }

    public function show(Posts $post)
    {
        return view('pages.post.show', compact('post'));
    }

    public function list()
    {
        $posts = Posts::orderBy('created_at', 'desc')->paginate(100);
        return view('pages.post.list', compact('posts'));
    }

    public function edit()
    {
        //
    }

    public function update()
    {
        //
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

    public function trash() {
        $posts = Posts::onlyTrashed()->orderBy('created_at', 'desc')->paginate(100);
        return view('pages.post.trash', compact('posts'));
    }

    public function restore(Posts $post)
    {
        $post->restore();
        return redirect('/post/trash')->with('success', 'Post restored successfully.');
    }
}
