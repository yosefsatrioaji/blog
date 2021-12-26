<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function signin(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required'
        ]);
        $remember = false;
        if($request->has('remember_me'))
        {
            $remember = true;
        }
        try {

            if (Auth::attempt($credentials, $remember)) {
                $request->session()->regenerate();
                return redirect()->intended('/');
            }

            return back()->with('LoginErrors', 'Login failed!');
        } catch (ModelNotFoundException $exception) {
            //
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function registerView()
    {
        return view('auth.register');
    }

    public function signup(Request $request)
    {
        $request->validate([
            'email' => 'required|email:dns|max:255|unique:users',
            'name' => 'required|max:255',
            'password' => 'required|min:6|max:255',
            'password_confirm' => 'required|min:6|max:255|same:password'
        ]);

        try{
            $requestUser = [
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
            ];
            DB::beginTransaction();
            $user = User::create($requestUser);
            $user->assignRole('visitor');
            DB::commit();
            return redirect('/login')->with('signup_success','Signup successfuly, please login');
        }catch(ModelNotFoundException $exception){

        }
    }
}
