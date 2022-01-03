<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\UserProfiles;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Laravel\Socialite\Facades\Socialite;

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
        if ($request->has('remember_me')) {
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
        $slug = SlugService::createSlug(User::class, 'slug', $request->input('name'));
        try {
            $requestUser = [
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'slug' => $slug,
                'password' => Hash::make($request->input('password')),
            ];
            DB::beginTransaction();
            $user = User::create($requestUser);
            $user->assignRole('visitor');
            $user->userProfile()->create();
            DB::commit();
            return redirect('/login')->with('signup_success', 'Signup successfuly, please login');
        } catch (ModelNotFoundException $exception) {
        }
    }

    public function profile()
    {
        $user = User::find(Auth::id());
        return view('profile', compact('user'));
    }

    public function updateUser(Request $request)
    {
        $request->validate([
            'email' => 'required|max:255|email:dns|unique:users,email,' . Auth::id(),
            'nama' => 'required|max:255'
        ]);
        try {
            $user = User::find(Auth::id());
            if (!(Auth::user()->email == $request->input('email'))) {
                $user->email_verified_at = null;
            }
            $user->email = $request->input('email');
            $user->name = $request->input('nama');
            $user->save();
            return redirect('/profile')->with('success', 'Berhasil mengedit profile');
        } catch (ModelNotFoundException $e) {
            //
        }
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|min:6|max:255',
            'password_confirm' => 'required|min:6|max:255|same:password'
        ]);
        try {
            $user = User::find(Auth::id());
            $user->password = Hash::make($request->input('password'));
            $user->save();
            return redirect('/profile')->with('success', 'Berhasil mengedit password');
        } catch (ModelNotFoundException $e) {
            //
        }
    }

    public function emailVerif()
    {
        Auth::user()->sendEmailVerificationNotification();
        return redirect('/profile')->with('success', 'Berhasil mengirimkan link verifikasi ke email kamu');
    }

    public function forgetPassword()
    {
        return view('auth.forgot');
    }

    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleProviderCallback(Request $request)
    {
        try {
            $user_google    = Socialite::driver('google')->user();
            $user           = User::where('email', $user_google->getEmail())->first();

            //jika user ada maka langsung di redirect ke halaman home
            //jika user tidak ada maka simpan ke database
            //$user_google menyimpan data google account seperti email, foto, dsb

            if ($user != null) {
                \auth()->login($user, true);
                return redirect()->route('/');
            } else {
                $slug = SlugService::createSlug(User::class, 'slug', $user_google->getName());
                $user = User::Create([
                    'email'             => $user_google->getEmail(),
                    'name'              => $user_google->getName(),
                    'password'          => 0,
                    'email_verified_at' => now(),
                    'slug' => $slug
                ]);
                $user->assignRole('visitor');
                $user->userProfile()->create();

                \auth()->login($user, true);
                return redirect()->route('/');
            }
        } catch (\Exception $e) {
            return redirect()->route('login');
        }
    }
}
