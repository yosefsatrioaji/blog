<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Posts;
use App\Models\Contact;

class DashboardController extends Controller
{
    public function index()
    {
        $user = User::count();
        $post = Posts::count();
        $trashPost = Posts::onlyTrashed()->count();
        return view('pages.dashboard.index', compact('trashPost', 'user', 'post'));
    }

    public function contact()
    {
        $contacts = Contact::orderBy('created_at','asc')->paginate(50);
        return view('pages.dashboard.contact',compact('contacts'));
    }

    public function contactDelete(Contact $contact){
        $contact->delete();
        return redirect('/dashboard/contact')->with('success','Berhasil menghapus kontak');
    }
}
