<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Posts;
use App\Models\Contact;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:super admin|admin');
    }

    public function index()
    {
        $user = User::count();
        $post = Posts::count();
        $trashPost = Posts::onlyTrashed()->count();
        return view('pages.dashboard.index', compact('trashPost', 'user', 'post'));
    }

    public function contact()
    {
        $contacts = Contact::orderBy('created_at', 'asc')->paginate(50);
        return view('pages.dashboard.contact', compact('contacts'));
    }

    public function contactDelete(Contact $contact)
    {
        $contact->delete();
        return redirect('/dashboard/contact')->with('success', 'Berhasil menghapus kontak');
    }

    public function phpinfo()
    {
        return view('pages.dashboard.phpinfo');
    }

    public function userDelete(User $user)
    {
        try {
            $user->delete();
            return redirect('/dashboard/users')->with('success', 'Berhasil menghapus user');
        } catch (ModelNotFoundException $e) {
            //
        }
    }

    public function userRestore($user)
    {
        try {
            $restoreUser = User::withTrashed()->find($user)->restore();
            return redirect('/dashboard/users')->with('success', 'Berhasil mengembalikan user');
        } catch (ModelNotFoundException $e) {
            //
        }
    }

    public function userEdit(User $user)
    {
        return view('pages.dashboard.useredit', compact('user'));
    }

    public function userUpdate(User $user, Request $request)
    {
        $request->validate([
            'nama' => 'required|max:255',
            'email' => 'required|max:255|email:dns|unique:users,email,' . $user->id,
        ]);
        try {
            if (!($user->email == $request->input('email'))) {
                $user->email_verified_at = null;
            }
            if ($request->has('verif')) {
                $user->verif = true;
            } else {
                $user->verif = false;
            }
            $user->email = $request->input('email');
            $user->name = $request->input('nama');
            $user->save();
            return redirect('/dashboard/users')->with('success', 'Berhasil mengedit user');
        } catch (ModelNotFoundException $e) {
            //
        }
    }

    public function users()
    {
        $users = User::withTrashed()->orderBy('id', 'asc')->paginate(100);
        return view('pages.dashboard.users', compact('users'));
    }
}
